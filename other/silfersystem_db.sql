-- CREATE DATABASE IF NOT EXISTS silfersystem_db;


-- CLIENTE
CREATE TABLE IF NOT EXISTS cliente(
    idCliente INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(100) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    ruc CHAR(11) NOT NULL,
    link VARCHAR(512)
);

-- SERVICIO
CREATE TABLE IF NOT EXISTS servicio(
    idServicio INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    bases VARCHAR(250) NOT NULL,
    monto DOUBLE,
    moneda ENUM('S','D','ND'),
    fecha DATE NOT NULL,
    link VARCHAR(512),
    idCliente INT,
    CONSTRAINT FK_servicio_idCliente FOREIGN KEY (idCliente) REFERENCES cliente(idCliente)
);

-- REGISTRO
CREATE TABLE IF NOT EXISTS s_registro(
    idRegistro INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE NOT NULL,
    fec_buena_pro DATE,
    fec_consentimiento DATE,
    fec_perfeccionamiento DATE,
    link VARCHAR(512),
    idServicio INT,
    CONSTRAINT FK_registro_idServicio FOREIGN KEY (idServicio) REFERENCES servicio(idServicio)
);

-- ORDEN
CREATE TABLE IF NOT EXISTS s_orden(
    idOrden INT PRIMARY KEY AUTO_INCREMENT,
    numero VARCHAR(50) NOT NULL,
    fec_emision DATE NOT NULL,
    monto DOUBLE NOT NULL,
    numero_siaf VARCHAR(50) NOT NULL,
    link VARCHAR(512),
    idServicio INT,
    CONSTRAINT FK_orden_idServicio FOREIGN KEY (idServicio) REFERENCES servicio(idServicio)
);

-- CONTRATO
CREATE TABLE IF NOT EXISTS s_contrato(
    idContrato INT PRIMARY KEY AUTO_INCREMENT,
    numero VARCHAR(50) NOT NULL,
    fec_ejecucion DATE,
    link VARCHAR(512),
    idServicio INT,
    CONSTRAINT FK_contrato_idServicio FOREIGN KEY (idServicio) REFERENCES servicio(idServicio)
);

-- ENTREGABLE
CREATE TABLE IF NOT EXISTS s_entregable(
    idEntregable INT PRIMARY KEY AUTO_INCREMENT,
    fec_maxima DATE,
    fec_entrega DATE,
    forma_pago INT,
    plazo_entregable VARCHAR(250),
    link VARCHAR(512),
    idServicio INT,
    CONSTRAINT FK_entregable_idServicio FOREIGN KEY (idServicio) REFERENCES servicio(idServicio)
);

-- CONFORMIDAD
CREATE TABLE IF NOT EXISTS s_conformidad(
    idConformidad INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE,
    link VARCHAR(512),
    idEntregable INT,
    CONSTRAINT FK_conformidad_idEntregable FOREIGN KEY (idEntregable) REFERENCES entregable(idEntregable)
);

-- FACTURA
CREATE TABLE IF NOT EXISTS s_factura(
    idFactura INT PRIMARY KEY AUTO_INCREMENT,
    numero VARCHAR (50) NOT NULL,
    monto DOUBLE,
    moneda ENUM('S','D','ND'),
    fec_emision DATE,
    fec_deposito DATE,
    monto_abonado DOUBLE,
    fec_detraccion DATE,
    detraccion DOUBLE,
    link VARCHAR(512),
    idConformidad INT,
    CONSTRAINT FK_factura_idConformidad FOREIGN KEY (idConformidad) REFERENCES conformidad(idConformidad)
);

-- DEPOSITO
CREATE TABLE IF NOT EXISTS s_deposito(
    idDeposito INT PRIMARY KEY AUTO_INCREMENT,
    monto DOUBLE,
    moneda ENUM('S','D','ND'),
    fecha DATE,
    link VARCHAR(512),
    idFactura INT,
    CONSTRAINT FK_deposito_idFactura FOREIGN KEY (idFactura) REFERENCES factura(idFactura)
)