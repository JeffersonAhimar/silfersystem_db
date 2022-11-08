-- CREATE DATABASE IF NOT EXISTS silfersystem_db;
/*
 
 DROP TABLE s_deposito;
 DROP TABLE s_factura;
 DROP TABLE s_conformidad;
 DROP TABLE s_entregable;
 DROP TABLE s_contrato;
 DROP TABLE s_orden;
 DROP TABLE s_registro;
 DROP TABLE servicio;
 DROP TABLE cliente; 
 
 */
-- CLIENTE
CREATE TABLE IF NOT EXISTS cliente(
    idCliente INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(100) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    ruc CHAR(11),
    link VARCHAR(512)
);

-- SERVICIO
CREATE TABLE IF NOT EXISTS servicio(
    idServicio INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(100) NOT NULL UNIQUE,
    descripcion VARCHAR(250) NOT NULL,
    bases VARCHAR(250) NOT NULL,
    moneda ENUM('S', 'D', 'ND'),
    monto DOUBLE,
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
    CONSTRAINT FK_s_registro_idServicio FOREIGN KEY (idServicio) REFERENCES servicio(idServicio)
);

-- ORDEN
CREATE TABLE IF NOT EXISTS s_orden(
    idOrden INT PRIMARY KEY AUTO_INCREMENT,
    numero VARCHAR(50) NOT NULL,
    fec_emision DATE NOT NULL,
    numero_siaf VARCHAR(50) NOT NULL,
    link VARCHAR(512),
    idServicio INT,
    CONSTRAINT FK_s_orden_idServicio FOREIGN KEY (idServicio) REFERENCES servicio(idServicio)
);

-- CONTRATO
CREATE TABLE IF NOT EXISTS s_contrato(
    idContrato INT PRIMARY KEY AUTO_INCREMENT,
    numero VARCHAR(50) NOT NULL,
    fec_ejecucion DATE,
    link VARCHAR(512),
    idServicio INT,
    CONSTRAINT FK_s_contrato_idServicio FOREIGN KEY (idServicio) REFERENCES servicio(idServicio)
);

-- ENTREGABLE
CREATE TABLE IF NOT EXISTS s_entregable(
    idEntregable INT PRIMARY KEY AUTO_INCREMENT,
    numero INT NOT NULL,
    fec_maxima DATE,
    fec_entrega DATE,
    forma_pago INT,
    plazo_entregable VARCHAR(250),
    link VARCHAR(512),
    idServicio INT,
    CONSTRAINT FK_s_entregable_idServicio FOREIGN KEY (idServicio) REFERENCES servicio(idServicio)
);

-- CONFORMIDAD
CREATE TABLE IF NOT EXISTS s_conformidad(
    idConformidad INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE,
    link VARCHAR(512),
    idEntregable INT,
    CONSTRAINT FK_s_conformidad_idEntregable FOREIGN KEY (idEntregable) REFERENCES s_entregable(idEntregable)
);

-- FACTURA
CREATE TABLE IF NOT EXISTS s_factura(
    idFactura INT PRIMARY KEY AUTO_INCREMENT,
    numero VARCHAR (50) NOT NULL,
    moneda ENUM('S', 'D', 'ND'),
    monto DOUBLE,
    fec_emision DATE,
    detraccion DOUBLE,
    fec_detraccion DATE,
    link VARCHAR(512),
    idConformidad INT,
    CONSTRAINT FK_s_factura_idConformidad FOREIGN KEY (idConformidad) REFERENCES s_conformidad(idConformidad)
);

-- DEPOSITO
CREATE TABLE IF NOT EXISTS s_deposito(
    idDeposito INT PRIMARY KEY AUTO_INCREMENT,
    moneda ENUM('S', 'D', 'ND'),
    monto DOUBLE,
    fecha DATE,
    link VARCHAR(512),
    idFactura INT,
    CONSTRAINT FK_s_deposito_idFactura FOREIGN KEY (idFactura) REFERENCES s_factura(idFactura)
);