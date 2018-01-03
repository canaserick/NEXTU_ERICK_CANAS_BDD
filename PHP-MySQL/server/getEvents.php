<?php
  /* Procedimiento para obtener los eventos grabados en la base de datos */

  /* conexion con la base de datos */
  require('./conector.php');
  $con = new ConectorBD('localhost','canaserick','JulianAndres2001.');
  $response['conexion'] = $con->initConexion('agenda');

  /* si la conexion fue exitosa se consultan los eventos del usuario logeado */
  if($response['conexion'] == 'OK'){
    $response["msg"] = 'OK';
    $username = $_COOKIE["username"];
    /* Ejecuta la consulta */
    $resultado_consulta = $con->consultarEventos($username);
    $response["count"] = $resultado_consulta->num_rows;
    /* Procesar los resultados de la consulta */
    if($resultado_consulta->num_rows > 0){
      $rows = array();
      $cont = 0;
      while($row = $resultado_consulta->fetch_assoc()) {
        if ($row["dia_completo"] == 0){
            $inicio = $row["fecha_ini"];
            $inicio .= " ";
            $inicio .= $row["hora_ini"];
            $fin    = $row["fecha_fin"];
            $fin    .= " " ;
            $fin    .= $row["hora_fin"];
            $diaCompleto = false;
        } else {
            $inicio = $row["fecha_ini"];
            $fin    = "";
            $diaCompleto = true;
        }
        /* Armo el arreglo con los resultados requeridos por el front-end */
        $jsonArrayObject = (array('title'=>$row["titulo"], 'start'=>$inicio, 'end'=>$fin, 'allDay'=>$diaCompleto, 'id'=>$row["id"]));
        $rows[$cont] = $jsonArrayObject;
        $cont++;
      }
    }
    $response["usuario"] = $username;
    $response["eventos"] = json_encode($rows);
  }
  /* devuelvo los resultados al front-end */
  echo json_encode($rows);
  $con->cerrarConexion();
 ?>
