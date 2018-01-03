<?php

// clase conector: define los metodos para conectarse a la base de datos y ejecutar los diferentes queries requeridos
  class ConectorBD
  {
    private $host;
    private $user;
    private $password;
    private $conexion;
// constructor
    function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }
// Realiza conexion
    function initConexion($nombre_db){
      $this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
      if ($this->conexion->connect_error) {
        return "Error:" . $this->conexion->connect_error;
      }else {
        return "OK";
      }
    }
// funcion generica para ejecutar un query
    function ejecutarQuery($query){
      return $this->conexion->query($query);
    }
// cerrar conexion
    function cerrarConexion(){
      $this->conexion->close();
    }
// consultar un login (para validacion de usuario)
    function consultarLogin($login){
      $sql = 'SELECT login, passwd FROM usuario WHERE login="'.$login.'"';
      return $this->ejecutarQuery($sql);
    }
// consultar los eventos definidos para un usuario
    function consultarEventos($login){
      $sql = 'SELECT titulo, fecha_ini, hora_ini, fecha_fin, hora_fin, dia_completo, id FROM evento WHERE usuario="'.$login.'"';
      return $this->ejecutarQuery($sql);
      //return $sql;
    }
// funcion generica para insertar datos en un tabla
    function insertData($tabla, $data){
      $sql = 'INSERT INTO '.$tabla.' (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ')';
        $i++;
      }
      $sql .= ' VALUES (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= '"';
        $sql .= $value;
        $sql .= '"';
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ');';
        $i++;
      }
      return $this->ejecutarQuery($sql);

    }
// obtener la conexion
    function getConexion(){
      return $this->conexion;
    }
// funcion generica para actualizar registros en una tabla
    function actualizarRegistro($tabla, $data, $condicion){
      $sql = 'UPDATE '.$tabla.' SET ';
      $i=1;
      foreach ($data as $key => $value) {
        $sql .= $key.'='.$value;
        if ($i<sizeof($data)) {
          $sql .= ', ';
        }else $sql .= ' WHERE '.$condicion.';';
        $i++;
      }
      return $this->ejecutarQuery($sql);
    }
// funcion generica para eliminar registros de una tabla
    function eliminarRegistro($tabla, $condicion){
      $sql = "DELETE FROM ".$tabla." WHERE ".$condicion.";";
      return $this->ejecutarQuery($sql);
    }
// consulta generica en una tabla
    function consultar($tablas, $campos, $condicion = ""){
      $sql = "SELECT ";
      $ultima_key = end(array_keys($campos));
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }

      $ultima_key = end(array_keys($tablas));
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }

      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }

      return $this->ejecutarQuery($sql);
    }
// consulta generica de varias tablas
    function consultaCompuesta($tablas, $campos, $relaciones, $condicion = ""){
      $sql = "SELECT ";
      $ultima_key = end(array_keys($campos));
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }
      $sql .= $tablas[0]." ";
      $ultima_key = end(array_keys($tablas));
      foreach ($tablas as $key => $value) {
        if ($key != 0) {
          $sql .= "JOIN ".$value." ON ".$relaciones[$key-1]." \n";
        }
      }
      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
      return $this->ejecutarQuery($sql);
    }


  }





 ?>
