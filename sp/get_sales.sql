CREATE PROCEDURE get_sales(
in _client_id int
)
BEGIN

SELECT 
c.ID_Cliente,
v.ID_Venta,
concat(c.Nombre_Cliente, ' ', c.Apellido_Cliente) cliente,

v.ID_Venta ,
cast(v.Total_Venta as decimal(20,2)) Total_Venta
FROM venta v 
left join detalle_venta dv on v.ID_Venta = dv.ID_DetalleVenta
join cliente c on c.ID_Cliente = _client_id
where v.ID_Cliente = _client_id;

END