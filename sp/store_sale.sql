CREATE PROCEDURE store_sale(
in _sale JSON,
in _client_id INT
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
	DECLARE _amount DECIMAL(20,2);
	DECLARE _total DECIMAL(10, 2) DEFAULT 0;
	DECLARE _quantity DECIMAL(10, 2) DEFAULT 0;
	DECLARE msg text;
 	DECLARE error_found INT DEFAULT 0;
 	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
 	
 	BEGIN        
    	ROLLBACK;
   		SELECT msg AS message, 'error' `type`;
    	SET error_found = 1;
    END;
               
 
	START TRANSACTION;

	SET _transaction_id = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].id')) );
	SET _sale_status = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].status'))); 
	SET _purchase_units = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].purchase_units'))); 
	SET _payer = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].payer')));
	SET _links = JSON_UNQUOTE( JSON_EXTRACT(_sale, CONCAT('$[0].links'))); 
	
	IF(_sale_status = "COMPLETED") THEN
	
	WHILE x < JSON_LENGTH(_purchase_units) DO
	SET _product_id = JSON_UNQUOTE(JSON_EXTRACT(_purchase_units,concat('$[',x,'].reference_id')));
	SET _payments = JSON_UNQUOTE(JSON_EXTRACT(_purchase_units,concat('$[',x,'].payments')));
	SET _captures = JSON_EXTRACT(_payments, '$.captures[0]');
	SET _amount = JSON_EXTRACT(_captures, '$.amount.value');
	SET _total = _total + CAST(_amount AS DECIMAL(20, 2));
	SELECT x + 1 INTO x;
	END WHILE;

	INSERT INTO venta (ID_Cliente,Fecha_Venta,Estado_Venta,Igv_Venta,Total_Venta,SubTotal_Venta)
	values (_client_id, now(), 1, 0.18, _total, _total);

	SET _sale_id = LAST_INSERT_ID();
	
	WHILE z < JSON_LENGTH(_purchase_units) DO
	SET _product_id = JSON_UNQUOTE(JSON_EXTRACT(_purchase_units,concat('$[',z,'].reference_id')));
	SET _payments = JSON_UNQUOTE(JSON_EXTRACT(_purchase_units,concat('$[',z,'].payments')));
	SET _captures = JSON_EXTRACT(_payments, '$.captures[0]');
	SET _amount = JSON_EXTRACT(_captures, '$.amount.value');
	SET _total = _total + CAST(_amount AS DECIMAL(20, 2));
	SELECT p.Precio_Producto into @price from producto p where p.ID_Producto = _product_id;
	SET _quantity = (_amount/@price);
	INSERT INTO detalle_venta (ID_Venta , ID_Producto , Cantidad_DetalleVenta , Precio_DetalleVenta )
	values(_sale_id, _product_id, _quantity, @price);

	SELECT z + 1 INTO z;
	END WHILE;
	END IF;

	IF error_found = 1 THEN
    	ROLLBACK;
        SELECT 'error' `type`, msg message;
    ELSE
    	COMMIT;
    	SELECT 'success' `type`, msg message;
    END IF;
END