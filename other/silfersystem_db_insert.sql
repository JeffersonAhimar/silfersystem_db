-- CREATE DATABASE IF NOT EXISTS silfersystem_db;
-- CLIENTE
INSERT INTO
    cliente(`codigo`, `nombre`, `ruc`, `link`)
VALUES
    ('cliente1', 'Cliente 1', '1', 'link1'),
    ('cliente2', 'Cliente 2', '2', 'link2'),
    ('cliente3', 'Cliente 3', '3', 'link3'),
    ('cliente4', 'Cliente 4', '4', 'link4'),
    ('cliente5', 'Cliente 5', '5', 'link5'),
    ('cliente6', 'Cliente 6', '6', 'link6'),
    ('cliente7', 'Cliente 7', '7', 'link7'),
    ('cliente8', 'Cliente 8', '8', 'link8'),
    ('cliente9', 'Cliente 9', '9', 'link9'),
    ('cliente10', 'Cliente 10', '10', 'link10'),
    ('cliente11', 'Cliente 11', '11', 'link11'),
    ('cliente12', 'Cliente 12', '12', 'link12'),
    ('cliente13', 'Cliente 13', '13', 'link13'),
    ('cliente14', 'Cliente 14', '14', 'link14'),
    ('cliente15', 'Cliente 15', '15', 'link15'),
    ('cliente16', 'Cliente 16', '16', 'link16'),
    ('cliente17', 'Cliente 17', '17', 'link17'),
    ('cliente18', 'Cliente 18', '18', 'link18'),
    ('cliente19', 'Cliente 19', '19', 'link19'),
    ('cliente20', 'Cliente 20', '20', 'link20'),
    -- servicio
INSERT INTO
    servicio(
        `codigo`,
        `descripcion`,
        `bases`,
        `moneda`,
        `monto`,
        `fecha`,
        `link`,
        `idCliente`
    )
VALUES
    (
        'serv',
        'desc',
        'http://silfersystem.com/',
        'S',
        '00',
        '',
        '',
        ''
    );

-- 
-- cliente
INSERT INTO
    cliente (codigo, nombre, ruc, link)
VALUES
    (
        'UNAC',
        'Universidad Nacional del Callao',
        '20138705944',
        ''
    ),
    (
        'UNMSM',
        'Universidad Nacional Mayor de San Marcos',
        '',
        ''
    ),
    (
        'UNSA',
        'Universidad Nacional de San Agustin de Arequipa',
        '',
        ''
    );

-- servicio
INSERT INTO
    servicio (
        codigo,
        descripcion,
        bases,
        moneda,
        monto,
        fecha,
        link,
        idCliente
    )
VALUES
    (
        'AS-015-2022',
        'ADQUISICIÓN DE UN SOFTWARE DE VIGILANCIA TECNOLÓGICA E INTELIGENCIA COMPETITIVA',
        'https://drive.google.com/file/d/1aqDDSvZ6DHHTtcxOu2ZiBeyclqL62FSG/view',
        'S',
        '226000',
        '2022-07-12',
        'https://drive.google.com/drive/folders/1k5JEcxkagIw4SjFo9wCg8Ze2tkG3tf0A?usp=share_link',
        '1'
    );

-- s_registro
INSERT INTO
    s_registro(
        fecha,
        fec_buena_pro,
        fec_consentimiento,
        fec_perfeccionamiento,
        link,
        idServicio
    )
VALUES
    (
        '2022-07-05',
        '2022-07-11',
        '2022-07-12',
        '2022-07-21',
        '',
        '1'
    );

-- s_orden
INSERT INTO
    s_orden(
        numero,
        fec_emision,
        numero_siaf,
        link,
        idServicio
    )
VALUES
    ('0000100', '2022-08-22', '0000002733', '', '1');

-- s_contrato
INSERT INTO
    s_contrato(
        numero,
        fec_ejecucion,
        link,
        idServicio
    )
VALUES
    ('0015-2022', '2022-07-26', '', '1');

-- s_entregable
INSERT INTO
    s_entregable(
        numero,
        fec_maxima,
        fec_entrega,
        forma_pago,
        plazo_entregable,
        link,
        idServicio
    )
VALUES
    (
        '1',
        '',
        '',
        '60',
        '30 días calendarios',
        '',
        '1'
    ),
    (
        '2',
        '',
        '',
        '40',
        '120 días calendarios',
        '',
        '1'
    );

-- s_conformidad
INSERT INTO
    s_conformidad(fecha, link, idEntregable)
VALUES
    ('2022-08-18', '', '1'),
    ('2022-09-26', '', '2');

-- s_factura
INSERT INTO
    s_factura(
        numero,
        moneda,
        monto,
        fec_emision,
        detraccion,
        fec_detraccion,
        link,
        idConformidad
    )
VALUES
    (
        'F001-00000040',
        'S',
        '135600',
        '2022-08-18',
        '',
        '',
        '',
        '1'
    ),
    (
        'F001-00000047',
        'S',
        '90400',
        '2022-09-26',
        '',
        '',
        '',
        '1'
    );

-- s_deposito
-- INSERT INTO
--     s_deposito(moneda, monto, fecha, link, idFactura)
-- VALUES
--     ();