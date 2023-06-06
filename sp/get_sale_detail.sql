CREATE PROCEDURE get_sale_detail(
in _purchase_id int
)
BEGIN

SELECT dv.*, p.Nombre_Producto, p.Imagen_Producto

from detalle_venta dv
left join producto p on dv.ID_Producto = p.ID_Producto 

where dv.ID_Venta  = _purchase_id;

END