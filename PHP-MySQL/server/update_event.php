<?php
/* Procedimiento para actualizar la fecha de un evento con los datos enviados desde el front-end */

/* conexion con la base de datos */
require('./conector.php');
$con = new ConectorBD('localhost','canaserick','JulianAndres2001.');
$response['conexion'] = $con->initConexion('agenda');

/* si la conexion fue exitosa se ejecuta el query para las fechsa datos del evento */
if($response['conexion'] == 'OK'){
   $retorno['conexion'] = 'OK';
   $condicion = 'id = '.$_POST['id'];
   $rows = array();
   $rows['fecha_ini'] = '"'.$_POST['start_date'].'"';
   $rows['fecha_fin'] = '"'.$_POST['end_date'].'"';
   $rows['hora_ini']  = '"'.$_POST['start_hour'].'"';
   $rows['hora_fin']  = '"'.$_POST['end_hour'].'"';
   /* Ejecuto la insercion */
   $return = $con->actualizarRegistro('evento', $rows, $condicion);
   if ($return == 'true'){
      $retorno['msg'] = 'Actualizacion OK';
   }
   else {
     //$retorno['msg'] = 'Error en la actualizacion';
     $retorno['msg'] = $_POST['id'].$_POST['start_date'];
   }
}
/* devuelvo el resultado de la insercion al front-end */
echo json_encode($retorno);
$con->cerrarConexion();


 ?>
