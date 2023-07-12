DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sale_detail`(
    IN _purchase_id INT
)
BEGIN
    SELECT
        dv.*,
        p.Nombre_Producto,
        p.Imagen_Producto
    FROM
        detalle_venta dv
        LEFT JOIN producto p ON dv.ID_Producto = p.ID_Producto
    WHERE
        dv.ID_Venta = _purchase_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sales`(
    IN _client_id INT
)
BEGIN
    SELECT 
        c.ID_Cliente,
        v.ID_Venta,
        CONCAT(c.Nombre_Cliente, ' ', c.Apellido_Cliente) AS cliente,
        v.ID_Venta,
        CAST(v.Total_Venta AS DECIMAL(20,2)) AS Total_Venta
    FROM 
        venta v 
        LEFT JOIN detalle_venta dv ON v.ID_Venta = dv.ID_DetalleVenta
        JOIN cliente c ON c.ID_Cliente = _client_id
    WHERE 
        v.ID_Cliente = _client_id
    ORDER BY 
        v.ID_Venta DESC;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `search_products`(
    IN _brands TEXT,
    IN _min_range INT,
    IN _max_range INT,
    IN _sort_by INT,
    IN _offset INT
)
BEGIN
    DECLARE _total_rows INT;
	
    SELECT COUNT(*) INTO _total_rows
    FROM producto p
    LEFT JOIN (
        SELECT x.ID_Producto, SUM(dv.Cantidad_DetalleVenta) AS total
        FROM producto x
        JOIN detalle_venta dv ON x.ID_Producto = dv.ID_Producto
        GROUP BY x.ID_Producto
    ) sub ON p.ID_Producto = sub.ID_Producto
    WHERE 
        IF(_brands IS NULL OR _brands = '', TRUE, FIND_IN_SET(p.Marca_Producto, _brands) > 0)
        AND (
            (_max_range IS NOT NULL AND _min_range IS NOT NULL) OR (_max_range != '' AND _min_range != '') OR
            (_max_range IS NOT NULL OR _max_range != '') OR (_min_range IS NOT NULL OR _min_range != '')
            OR TRUE
        );
    
    SELECT  
        p.*, _total_rows, COALESCE(sub.total, 0) AS total_quantity
    FROM 
        producto p
    LEFT JOIN (
        SELECT x.ID_Producto, SUM(dv.Cantidad_DetalleVenta) AS total
        FROM producto x
        JOIN detalle_venta dv ON x.ID_Producto = dv.ID_Producto
        GROUP BY x.ID_Producto
    ) sub ON p.ID_Producto = sub.ID_Producto
    WHERE 
        IF(_brands IS NULL OR _brands = '', TRUE, FIND_IN_SET(p.Marca_Producto, _brands) > 0)
        AND (
            (_max_range IS NOT NULL AND _min_range IS NOT NULL) OR (_max_range != '' AND _min_range != '') OR
            (_max_range IS NOT NULL OR _max_range != '') OR (_min_range IS NOT NULL OR _min_range != '')
            OR TRUE
        )
    ORDER BY
        CASE
            WHEN _sort_by = 0 THEN p.ID_Producto
            WHEN _sort_by = 1 THEN total_quantity
            WHEN _sort_by = 3 THEN p.Precio_Producto
        END DESC,
        CASE
            WHEN _sort_by = 2 THEN p.Precio_Producto
        END ASC
    LIMIT 10
    OFFSET _offset;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `store_sale`(
    IN _sale JSON,
    IN _client_id INT
)
BEGIN
    DECLARE _transaction_id VARCHAR(255);
    DECLARE _sale_id INT;
    DECLARE _sale_status VARCHAR(255);
    DECLARE _purchase_units JSON;
    DECLARE _payer JSON;
    DECLARE _links JSON;
    DECLARE _payments JSON;
    DECLARE _captures JSON;
    DECLARE x INT DEFAULT 0;
    DECLARE z INT DEFAULT 0;
    DECLARE _product_id INT;
    DECLARE _amount DECIMAL(11,2);
    DECLARE _total DECIMAL(11, 2) DEFAULT 0;
    DECLARE _quantity DECIMAL(11, 2) DEFAULT 0;
    DECLARE msg TEXT;
    DECLARE error_found INT DEFAULT 0;
    DECLARE _total2 DECIMAL(11,2);
    DECLARE _total1 DECIMAL(11,2) DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    BEGIN        
        ROLLBACK;
        SELECT msg AS message, 'error' AS `type`;
        SET error_found = 1;
    END;
    
    START TRANSACTION;
    
    SET _transaction_id = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].id')) );
    SET _sale_status = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].status'))); 
    SET _purchase_units = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].purchase_units'))); 
    SET _payer = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].payer')));
    SET _links = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].links'))); 
    
    IF (_sale_status = "COMPLETED") THEN
    
        WHILE x < JSON_LENGTH(_purchase_units) DO
    SET _product_id = JSON_UNQUOTE(JSON_EXTRACT(_purchase_units,concat('$[',x,'].reference_id')));
    SET _payments = JSON_UNQUOTE(JSON_EXTRACT(_purchase_units,concat('$[',x,'].payments')));
    SET _captures = JSON_EXTRACT(_payments, '$.captures[0]');
    SET _amount = JSON_EXTRACT(_captures, '$.amount.value');
    SET @id_1 = JSON_UNQUOTE(JSON_EXTRACT(_captures,concat('$.amount')));
    SET @id_2 = JSON_UNQUOTE(JSON_EXTRACT(@id_1,concat('$.value')));
    SET _total = _total + CAST(_amount AS DECIMAL(20, 2));
    
        SET _total1 = _total1 + @id_2;
            SELECT x + 1 INTO x;
        END WHILE;
    
         SET @igv = (0.18 * _total1);
    SET @total3 = (@igv +_total1);
    INSERT INTO venta (ID_Cliente,Fecha_Venta,Estado_Venta,Igv_Venta,Total_Venta,SubTotal_Venta,codigo_venta)
    values (_client_id, now(), 1, @igv, @total3,_total1, (SELECT generar_codigo_venta()) );
    
        SET _sale_id = LAST_INSERT_ID();
        
    WHILE z < JSON_LENGTH(_purchase_units) DO
    SET _product_id = JSON_UNQUOTE(JSON_EXTRACT(_purchase_units,concat('$[',z,'].reference_id')));
    SET _payments = JSON_UNQUOTE(JSON_EXTRACT(_purchase_units,concat('$[',z,'].payments')));
    SET _captures = JSON_EXTRACT(_payments, '$.captures[0]');
    SET _amount = JSON_EXTRACT(_captures, '$.amount.value');
    SET _total = _total + CAST(_amount AS DECIMAL(20, 2));
    SET @id_1 = JSON_UNQUOTE(JSON_EXTRACT(_captures,concat('$.amount')));
    SET @id_2 = JSON_UNQUOTE(JSON_EXTRACT(@id_1,concat('$.value')));
    SELECT p.Precio_Producto into @price from producto p where p.ID_Producto = _product_id;
    SET _quantity = (@id_2/@price);
    INSERT INTO detalle_venta (ID_Venta , ID_Producto , Cantidad_DetalleVenta , Precio_DetalleVenta )
    values(_sale_id, _product_id, _quantity, @price);
    
            SELECT z + 1 INTO z;
        END WHILE;
    END IF;
    
    IF error_found = 1 THEN
        ROLLBACK;
        SELECT 'error' AS `type`, msg AS message;
    ELSE
        COMMIT;
        SELECT 'success' AS `type`, msg AS message;
    END IF;
END$$
DELIMITER ;


-------FUNCIÓN GENERAR CODIGO -------------------------------
DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `generar_codigo_venta`() RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
    DECLARE total INT;
    DECLARE generar_codigo VARCHAR(20);

    SET total = (SELECT COUNT(*) + 1 FROM venta); -- Reemplaza "tabla" por el nombre de tu tabla

    IF total < 10 AND total > 0 THEN
        SET generar_codigo = CONCAT('V-00000', total, '-', DATE_FORMAT(NOW(), '%b-%y'));
    ELSEIF total >= 10 AND total < 100 THEN
        SET generar_codigo = CONCAT('V-0000', total, '-', DATE_FORMAT(NOW(), '%b-%y'));
    ELSEIF total >= 100 AND total < 1000 THEN
        SET generar_codigo = CONCAT('V-000', total, '-', DATE_FORMAT(NOW(), '%b-%y'));
    ELSEIF total >= 1000 AND total < 10000 THEN
        SET generar_codigo = CONCAT('V-00', total, '-', DATE_FORMAT(NOW(), '%b-%y'));
    ELSEIF total >= 10000 AND total < 100000 THEN
        SET generar_codigo = CONCAT('V-0', total, '-', DATE_FORMAT(NOW(), '%b-%y'));
    ELSE
        SET generar_codigo = CONCAT('V-', total, '-', DATE_FORMAT(NOW(), '%b-%y'));
    END IF;

    RETURN generar_codigo;
END$$
DELIMITER ;