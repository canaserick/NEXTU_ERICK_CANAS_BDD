<?php
/* Procedimiento para grabar un nuevo evento con los datos enviados desde el front-end */

/* conexion con la base de datos */
require('./conector.php');
$con = new ConectorBD('localhost','canaserick','JulianAndres2001.');
$response['conexion'] = $con->initConexion('agenda');

/* si la conexion fue exitosa se ejecuta el query para insertar los datos del evento */
if($response['conexion'] == 'OK'){
   $retorno['conexion'] = 'OK';
   $_POST['usuario'] = $_COOKIE["username"];
   /* Ejecuto la insercion */
   $return = $con->insertData('evento', $_POST);
   if ($return == 'true'){
      $retorno['msg'] = 'Insercion OK';
   }
   else {
     $retorno['msg'] = 'Error en la insercion';
   }
}
/* devuelvo el resultado de la insercion al front-end */
echo json_encode($retorno);
$con->cerrarConexion();

 ?>
