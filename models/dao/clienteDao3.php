<?php
require_once '../src/util/config.php';

require_once server_root . 'models/bean/clienteBean.php';
require_once server_root . 'src/util/database.php';



class clienteDao
{
    private $tblname = "cliente";
    // 5 atributes
    private $idCliente;
    private $codigo;
    private $nombre;
    private $ruc;
    private $link;

    //OBTENIENDO DATOS DEL OBJETO
    public function GetData(clienteBean $objBean)
    {
        //5
        $this->idCliente = htmlspecialchars($objBean->getIdCliente());
        $this->codigo = htmlspecialchars($objBean->getCodigo());
        $this->nombre = htmlspecialchars($objBean->getNombre());
        $this->ruc = htmlspecialchars($objBean->getRuc());
        $this->link = htmlspecialchars($objBean->getLink());
    }

    //CREAR REGISTRO EN LA TABLA
    public function Create(clienteBean $objBean)
    {
        $this->GetData($objBean);
        $result = 0;
        $msg = 'Error al ingresar';
        try {
            $db = new Database();
            $con = $db->conectar();
            $sql = $con->prepare("INSERT INTO $this->tblname (
                codigo,
                nombre,
                ruc,
                link
                ) 
                VALUES (
                ?,
                ?,
                ?,
                ?
                )");
            $sql->execute(
                [
                    $this->codigo,
                    $this->nombre,
                    $this->ruc,
                    $this->link
                ]
            );
            $lastId = $con->lastInsertId();
            //
            if ($lastId > 0) {
                $result = 1;
                $msg = 'Ingresado correctamente';
            }
        } catch (PDOException $e) {
            $msg = 'Error conexion: ' . $e->getMessage();
        }
        $mensajes = array($result, $msg);
        return $mensajes;
    }

    //MODIFICAR UN REGISTRO DE LA TABLA
    public function Update(clienteBean $objBean)
    {
        $this->GetData($objBean);
        $result = 0;
        $msg = 'Error al modificar';
        try {
            $db = new Database();
            $con = $db->conectar();
            $sql = $con->prepare("UPDATE $this->tblname SET 
            codigo=?, 
            nombre=?,
            ruc=?,
            link=? 
            WHERE idCliente=?");
            $sql->execute([
                $this->codigo,
                $this->nombre,
                $this->ruc,
                $this->link,
                $this->idCliente
            ]);
            $result = 1;
            $msg = 'Modificado correctamente';
        } catch (PDOException $e) {
            $msg = 'Error conexion: ' . $e->getMessage();
        }
        $mensajes = array($result, $msg);
        return $mensajes;
    }

    //ELIMINAR UN REGISTRO DE LA TABLA
    public function Delete(clienteBean $objBean)
    {
        $id = $objBean->getIdCliente();    //GET ID
        $result = 0;
        $msg = 'Error al eliminar';
        try {
            $db = new Database();
            $con = $db->conectar();
            $sql = $con->prepare("DELETE FROM $this->tblname WHERE idCliente=?");
            $sql->execute([$id]);
            $result = 1;
            $msg = 'Eliminado correctamente';
        } catch (PDOException $e) {
            $msg = 'Error conexion: ' . $e->getMessage();
        }
        $mensajes = array($result, $msg);
        return $mensajes;
    }

    //LEER TODOS LOS REGISTROS DE LA TABLA
    public function Read()
    {
        $sql_text = "SELECT * FROM $this->tblname";
        $tabla = $this->ListarTablas($sql_text);
        return $tabla;
    }


    //OBTENER REGISTROS DE LA TABLA Y DARLES FORMATO HTML
    private function ListarTablas($sql_text)
    {
        try {
            $db = new Database();
            $con = $db->conectar();
            $tabla = "";
            // 

            // 
            $i = 1;
            foreach ($con->query($sql_text) as $row) {
                $tabla .= "<tr>";
                $tabla .= "<th scope='row'>" . $row[0] . "</th>";
                $tabla .= "<td>" . $row[1] . "</td>";
                $tabla .= "<td>" . $row[2] . "</td>";
                $tabla .= "<td>" . $row[3] . "</td>";
                $tabla .= "<td>" . $row[4] . "</td>";

                // MODIFICAR BTN
                $tabla .= "<td><button class='btn btn-outline-warning' id='btnUpdateModal'";
                for ($j = 0; $j < 5; $j++) {
                    /*if ($j === 5) {
                        //$tabla .= "var" . ($j + 1) . "='" . $row[$j]->format('Y-m-d H:j:s') . "'";
                        $tabla .= "var" . ($j + 1) . "='" . $row[$j]->format('Y-m-d') . "'";
                    } else {
                        $tabla .= "var" . ($j + 1) . "='" . $row[$j] . "'";
                    }*/
                    $tabla .= "var" . ($j + 1) . "='" . $row[$j] . "'";
                }
                $tabla .= ">Modificar</button></td>";
                // ELIMINAR BTN
                $tabla .= "<td><button class='btn btn-outline-danger' id='btnDeleteModal'"
                    . "var1='" . $row[0] . "'"
                    . ">"
                    . "Eliminar</button></td>";
                $tabla .= "</tr>";
                $i++;
            }
            // 

            // 
        } catch (Exception $ex) {
        }
        return $tabla;
    }
}
