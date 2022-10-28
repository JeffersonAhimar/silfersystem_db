<?php
require_once '../src/util/config.php';

require_once server_root . 'models/dao/clienteDao.php';

if (!empty($_POST['op'])) {
    $op = $_POST['op'];
} else {
    echo 'No hay op';
}

//RECUPERANDO DATOS
if (!empty($_POST['var1'])) {
    $var1 = $_POST['var1'];
}
if (!empty($_POST['var2'])) {
    $var2 = $_POST['var2'];
}
if (!empty($_POST['var3'])) {
    $var3 = $_POST['var3'];
}
if (!empty($_POST['var4'])) {
    $var4 = $_POST['var4'];
}
if (!empty($_POST['var5'])) {
    $var5 = $_POST['var5'];
} else {
    $var5 = 0; //puede ser 0
}



switch ($op) {
        //LISTAR
    case 1: {
            $objDao = new clienteDao();
            $tabla = $objDao->Read();
            echo $tabla;
            break;
        }

        //INSERTAR
    case 3: {
            //VERIFICANDO SI ESTAN VACIOS LOS CAMPOS
            if ($var2 == '' || $var3 == '' || $var4 == '' || $var5 == '') {
                $mensajes = array('2', 'Faltan llenar campos');
            } else {
                //CREANDO OBJETO E INSERTANDOLE LOS DATOS RECUPERADOS
                $objBean = new clienteBean();
                $objBean->setCodigo($var2);
                $objBean->setNombre($var3);
                $objBean->setRuc($var4);
                $objBean->setLink($var5);
                //CREANDO EL REGISTRO EN LA BASE DE DATOS
                $objDao = new clienteDao();
                $mensajes = $objDao->Create($objBean);
            }
            //DEVOLVIENDO MENSAJES
            foreach ($mensajes as $m) {
                echo $m . ",";
            }
            break;
        }

        //MODIFICAR
    case 4: {
            //VERIFICANDO SI ESTAN VACIOS LOS CAMPOS
            if ($var2 == '' || $var3 == '' || $var4 == '' || $var5 == '') {
                $mensajes = array('2', 'Faltan llenar campos');
            } else {
                //CREANDO OBJETO E INSERTANDOLE LOS DATOS RECUPERADOS
                $objBean = new clienteBean();
                $objBean->setIdCliente($var1);
                $objBean->setCodigo($var2);
                $objBean->setNombre($var3);
                $objBean->setRuc($var4);
                $objBean->setLink($var5);
                //CREANDO EL REGISTRO EN LA BASE DE DATOS
                $objDao = new clienteDao();
                $mensajes = $objDao->Update($objBean);
            }
            //DEVOLVIENDO MENSAJES
            foreach ($mensajes as $m) {
                echo $m . ",";
            }
            break;
        }

        //ELIMINAR
    case 5: {
            //CREANDO OBJETO E INSERTANDOLE LOS DATOS RECUPERADOS
            $objBean = new clienteBean();
            $objBean->setIdCliente($var1);
            //ELIMINANDO EL REGISTRO DE LA BASE DE DATOS
            $objDao = new clienteDao();
            $mensajes = $objDao->Delete($objBean);
            //DEVOLVIENDO MENSAJES
            foreach ($mensajes as $m) {
                echo $m . ",";
            }
            break;
        }
}
