
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
    
         SET @igv = (0.18 * @id_2);
    -----SET @total3 = (@igv +_total1);
    INSERT INTO venta (ID_Cliente,Fecha_Venta,Estado_Venta,Igv_Venta,Total_Venta,SubTotal_Venta,codigo_venta)
    values (_client_id, now(), 1, @igv, @id_2,_total1, (SELECT generar_codigo_venta()) );
    
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


------------------------------------------------------------

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
    SET @subtotal = @id_2 / 1.18;
         SET @igv = (@id_2-@subtotal);
    
    INSERT INTO venta (ID_Cliente,Fecha_Venta,Estado_Venta,Igv_Venta,Total_Venta,SubTotal_Venta,codigo_venta)
    values (_client_id, now(), 1, @igv, @id_2,@subtotal, (SELECT generar_codigo_venta()) );
    
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
END








-----------------------FINAL------------------------
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
    SET @subtotal = _total1 / 1.18;
         SET @igv = (_total1-@subtotal);
    
    INSERT INTO venta (ID_Cliente,Fecha_Venta,Estado_Venta,Igv_Venta,Total_Venta,SubTotal_Venta,codigo_venta)
    values (_client_id, now(), 1, @igv, _total1,@subtotal, (SELECT generar_codigo_venta()) );
    
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
END