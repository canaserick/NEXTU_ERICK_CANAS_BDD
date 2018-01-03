<?php


  require('./conector.php');

  $con = new ConectorBD('localhost','canaserick','JulianAndres2001.');
  $response['conexion'] = $con->initConexion('agenda');
  if($response['conexion'] == 'OK'){
      $resultado_consulta = $con->consultarLogin($_POST['username']);
      if($resultado_consulta->num_rows!=0){
        $response['acceso'] = "login correcto";
        $fila = $resultado_consulta->fetch_assoc();
        if(password_verify($_POST['passwd'], $fila['passwd'])){
          $response['acceso'] = 'OK';
          setcookie('username', $_POST['username'], false);
        } else {
          $response['acceso'] = "Acceso denegado - Password incorrecto";
        }
      } else {
        $response['acceso'] = "Acceso denegado - Login incorrecto";
      }
  }

  echo json_encode($response);
  $con->cerrarConexion();
 ?>
