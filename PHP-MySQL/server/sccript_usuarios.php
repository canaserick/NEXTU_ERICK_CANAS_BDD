
<?php
  // Script para la creación de usuarios del sistema
  include('conector.php');

  $con = new ConectorBD('localhost','canaserick','JulianAndres2001.');
  $response['conexion'] = $con->initConexion('agenda');

  if($response['conexion']=='OK') {
    //inserto el primer dato
    $data["login"] = "canaserick@hotmail.com";
    $data["nombre"] = "Erick Canas";
    $data["passwd"] = password_hash("erick123456", PASSWORD_DEFAULT);
    $data["fecha_nac"] = "1970/01/16";
    if($con->insertData('usuario', $data)){
      $response['msg']="exito en la inserción: ";
      $response['msg'] .= $data["login"];
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados: ";
      $response['msg'] .= + $data["login"];
    }
    echo json_encode($response);
    //inserto el segundo dato
    $data["login"] = "soniasiguenza@hotmail.com";
    $data["nombre"] = "Sonia Siguenza";
    $data["passwd"] = password_hash("sonia123456", PASSWORD_DEFAULT);
    $data["fecha_nac"] = "1968/09/22";
    if($con->insertData('usuario', $data)){
      $response['msg']="exito en la inserción: ";
      $response['msg'] .= $data["login"];
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados: ";
      $response['msg'] .= + $data["login"];
    }
    echo json_encode($response);
    //inserto el tercer dato
    $data["login"] = "julicanas@hotmail.com";
    $data["nombre"] = "Julian Canas";
    $data["passwd"] = password_hash("juli123456", PASSWORD_DEFAULT);
    $data["fecha_nac"] = "2001/09/23";
    if($con->insertData('usuario', $data)){
      $response['msg']="exito en la inserción: ";
      $response['msg'] .= $data["login"];
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados: ";
      $response['msg'] .= + $data["login"];
    }
    echo json_encode($response);

  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }
  $con->cerrarConexion();

 ?>
