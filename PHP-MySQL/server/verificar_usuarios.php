
<?php

  $hash = '$2y$10$VJfuQSgQ6FcOBVGsVmWGbufn2XF9m0Zn2UCF4gwNuQ3Rs5sYKUFr2';

    if(password_verify('erick123456', $hash)){
      $response = 'ok';
    } else {
        $response = 'mal';
    }
      echo json_encode($response);
 ?>
