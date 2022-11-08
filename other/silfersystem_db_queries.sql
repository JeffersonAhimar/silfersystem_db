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