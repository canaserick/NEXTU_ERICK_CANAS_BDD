<?php
/* Procedimiento para eliminar un evento seleccionado en el front-end */

/* conexion con la base de datos */
require('./conector.php');
$con = new ConectorBD('localhost','canaserick','JulianAndres2001.');
$response['conexion'] = $con->initConexion('agenda');

/* si la conexion fue exitosa se ejecuta el query para eliminar el evento */
if($response['conexion'] == 'OK'){
   $retorno['conexion'] = 'OK';
   $condicion = 'id ='.$_POST['id'];
   /* Ejecuto la eliminacion */
   $return = $con->eliminarRegistro('evento', $condicion);
   if ($return == 'true'){
      $retorno['msg'] = 'Eliminacion OK';
   }
   else {
     $retorno['msg'] = 'Error en la eliminacion';
   }
}
/* devuelvo el resultado de la eliminacion al front-end */
echo json_encode($retorno);
$con->cerrarConexion();

 ?>
