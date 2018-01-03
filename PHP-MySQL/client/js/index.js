// funcion para obtener una cookie del servidor
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
          c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
      }
  }
  return "";
}

// funcion principal, crea la clase login
$(function(){
  var l = new Login();
})

// definicion de la calses login
class Login {
  constructor() {
    this.submitEvent()
  }

  submitEvent(){
    $('form').submit((event)=>{
      event.preventDefault()
      this.sendForm()
    })
  }

//valida el login en el bdd, a través de checklogin.php
  sendForm(){
    let form_data = new FormData();
    form_data.append('username', $('#user').val())
    form_data.append('passwd', $('#password').val())
    $.ajax({
      url: '../server/check_login.php',
      dataType: "json",
      cache: false,
      processData: false,
      contentType: false,
      data: form_data,
      type: 'POST',
      success: function(php_response){
        if (php_response.conexion == "OK") {
          if(php_response.acceso == 'OK'){
            window.location.href = 'main.html';
          }else {
            alert(php_response.acceso)
          }

        }else {
          alert("Error en la conexión")
        }
      },
      error: function(){
        alert(" Error en la comunicación con el servidor");
      }
    })
  }
}
