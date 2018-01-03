<?php

  $con = new ConectorBD('localhost','canaserick','JulianAndres2001.');
  $response['conexion'] = $con->initConexion('agenda');

  $sql = 'SELECT login from usuario where login = ';
  $sql .= form_data[username]
  $con->ejecutarQuery($sql);

 ?>
