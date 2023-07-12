CREATE PROCEDURE search_products(
in _brands TEXT,
in _categories TEXT,
in _min_range int,
in _max_range int,
in _sort_by int,
in _offset int
)
BEGIN

DECLARE _total_rows INT;
	
SELECT  count(*) into _total_rows
FROM producto p
LEFT JOIN (
    SELECT x.ID_Producto, SUM(dv.Cantidad_DetalleVenta) AS total
    FROM producto x
    JOIN detalle_venta dv ON x.ID_Producto = dv.ID_Producto
    GROUP BY x.ID_Producto
) sub ON p.ID_Producto = sub.ID_Producto
WHERE 

IF(_brands is null or _brands = '', true, FIND_IN_SET(p.Marca_Producto, _brands) > 0)
and IF(_categories is null or _categories = '', true, FIND_IN_SET(p.ID_Categoria, _categories) > 0)
AND
CASE
	WHEN (_max_range is not null and _min_range is not null or _max_range != '' and _min_range != '') THEN
		p.Precio_Producto  between _min_range and _max_range
	WHEN (_max_range is not null or _max_range != '') THEN
		p.Precio_Producto <= _max_range
	WHEN (_min_range is not null or _min_range != '') THEN
		p.Precio_Producto >= _min_range
	ELSE
	TRUE
END;

	
SELECT  p.*, _total_rows, COALESCE(sub.total, 0) AS total_quantity
FROM producto p
LEFT JOIN (
    SELECT x.ID_Producto, SUM(dv.Cantidad_DetalleVenta) AS total
    FROM producto x
    JOIN detalle_venta dv ON x.ID_Producto = dv.ID_Producto
    GROUP BY x.ID_Producto
) sub ON p.ID_Producto = sub.ID_Producto
WHERE 

IF(_brands is null or _brands = '', true, FIND_IN_SET(p.Marca_Producto, _brands) > 0)
and IF(_categories is null or _categories = '', true, FIND_IN_SET(p.ID_Categoria, _categories) > 0)
AND
CASE
	WHEN (_max_range is not null and _min_range is not null or _max_range != '' and _min_range != '') THEN
		p.Precio_Producto  between _min_range and _max_range
	WHEN (_max_range is not null or _max_range != '') THEN
		p.Precio_Producto <= _max_range
	WHEN (_min_range is not null or _min_range != '') THEN
		p.Precio_Producto >= _min_range
	ELSE
	TRUE
END

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
END