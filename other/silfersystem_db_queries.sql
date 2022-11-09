-- GET SERVICES SUMMARY
SELECT
    -- servicio
    s.idServicio AS 's.idServicio',
    s.codigo AS 's.codigo',
    s.descripcion AS 's.descripcion',
    s.bases AS 's.bases',
    s.moneda AS 's.moneda',
    s.monto AS 's.monto',
    s.fecha AS 's.fecha',
    s.link AS 's.link',
    -- s_registro
    sr.fecha AS 'sr.fecha',
    sr.fec_buena_pro AS 'sr.fec_buena_pro',
    sr.fec_perfeccionamiento AS 'sr.fec_perfeccionamiento',
    sr.link AS 'sr.link',
    -- s_orden
    so.numero AS 'so.numero',
    so.fec_emision AS 'so.fec_emision',
    so.numero_siaf AS 'so.numero_siaf',
    so.link AS 'so.link',
    -- s_contrato
    sc.numero AS 'sc.numero',
    sc.fec_ejecucion AS 'sc.fec_ejecucion',
    sc.link AS 'sc.link'
FROM
    servicio s
    INNER JOIN s_registro sr ON sr.idServicio = s.idServicio
    INNER JOIN s_orden so ON so.idServicio = s.idServicio
    INNER JOIN s_contrato sc ON sc.idServicio = s.idServicio;

-- GET CLIENTE,SERVICIO
SELECT
    s.idServicio AS 's.idServicio',
    s.codigo AS 's.codigo',
    s.descripcion AS 's.descripcion',
    s.bases AS 's.bases',
    s.moneda AS 's.moneda',
    s.monto AS 's.monto',
    s.link AS 's.link',
    s.idCliente AS 's.idCliente',
    c.codigo AS 'c.codigo',
    c.nombre AS 'c.nombre',
    c.ruc AS 'c.ruc',
    c.link AS 'c.link'
FROM
    servicio s
    INNER JOIN cliente c ON c.idCliente = s.idCliente
WHERE
    idServicio = '1';

-- GET ENTREGABLES
SELECT
    se.idEntregable AS 'se.idEntregable',
    se.numero AS 'se.numero',
    se.fec_maxima AS 'se.fec_maxima',
    se.fec_entrega AS 'se.fec_entrega',
    se.forma_pago AS 'se.forma_pago',
    se.plazo_entregable AS 'se.plazo_entregable',
    se.link AS 'se.link'
FROM
    s_entregable se
WHERE
    se.idServicio = 1;

-- GET CONFORMIDADES
SELECT
    sc.idConformidad AS 'sc.idConformidad',
    sc.fecha AS 'sc.fecha',
    sc.link AS 'sc.link'
FROM
    s_conformidad sc
WHERE
    sc.idEntregable =;

-- GET FACTURAS
SELECT
    sf.idFactura AS 'sf.idFactura',
    sf.numero AS 'sf.numero',
    sf.moneda AS 'sf.moneda',
    sf.monto AS 'sf.monto',
    sf.fec_emision AS 'sf.fec_emision',
    sf.detraccion AS 'sf.detraccion',
    sf.fec_detraccion AS 'sf.fec_detraccion',
    sf.link AS 'sf.link'
FROM
    s_factura sf
WHERE
    sf.idConformidad =;

-- GET DEPOSITOS
SELECT
    sd.idDeposito AS 'sd.idDeposito',
    sd.moneda AS 'sd.moneda',
    sd.monto AS 'sd.monto',
    sd.fecha AS 'sd.fecha',
    sd.link AS 'sd.link'
FROM
    s_deposito sd
WHERE
    sd.idFactura = 1
LIMIT 1;