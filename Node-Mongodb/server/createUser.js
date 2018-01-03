const Usuario = require('./model.js')

let user = new Usuario({
    login: "soniasiguenza@hotamil.com",
    nombre: "Sonia Siguenza",
    passwd: "sonia123456",
    fecha_nac: "1968-09-22"
})
user.save(function(error) {
    if (error) {
        console.log(error)
    }
    console.log("Registro guardado")
})
