const Router = require('express').Router();
const Users = require('./model.js');
const cookies = require('cookies');
const cookieParser = require('cookie-parser');

//Obtener todos los usuarios
Router.get('/all', function(req, res) {
    Users.find({}).exec(function(err, docs) {
        if (err) {
            res.status(500)
            res.json(err)
        }
        res.json(docs)
    })
})

// Obtener un usuario por su id
Router.get('/', function(req, res) {
    let nombre = req.query.nombre
    Users.findOne({nombres: nombre}).exec(function(err, doc){
        if (err) {
            res.status(500)
            res.json(err)
        }
        res.json(doc)
    })
})

// Validar el Login y password
Router.post('/login', function(req, res){
  let user = req.body.user
  let pass = req.body.pass
  console.log("en login")
  console.log(user)
  Users.findOne({login: user, passwd: pass}).exec(function(err, doc){
      if (err) {
        res.status(500)
        res.json(err)
      }
      if (doc != null){
        res.cookie('usuario', user)
        res.send("Validado")
      }
      else {
        res.send("Login o Password incorrecto")
      }
  })
})

// Obtener todos los eventos de un usuario
Router.get('/events/all', function(req, res){
  console.log("en events/all")
  let objCookies = req.cookies
  let user = objCookies.usuario
  console.log(objCookies.usuario)
  console.log(user)
  Users.find({ login: user}, { events:1, _id:1}).exec(function(err, doc){
    if (err) {
      res.status(500)
      res.json(err)
    }
    //let docArray = doc.toArray()
    res.send(doc[0].events)
  })
})

// Asociar un evento a un usuario
Router.post('/events/new/', function(req, res){
  console.log("en /events/new")
  console.log(req.body.title)
  let objCookies = req.cookies
  let user = objCookies.usuario
  console.log(objCookies.usuario)
  console.log(user)
  Users.updateOne(
    { login: user},
    { $push: {events: {title: req.body.title, start: req.body.start, end: req.body.end} } }
    ).exec(function(err, doc){
      if (err) {
          res.status(500)
          res.json(err)
      }
    res.json("Evento añadido")
  })
})

// Eliminar un evento de un usuario
Router.post('/events/delete/', function(req, res){
  console.log("en events/delete")
  let objCookies = req.cookies
  let user = objCookies.usuario
  console.log(req.body.title)
  console.log(req.body.start)
  Users.updateOne(
    { login: user},
    { $pull: { events: {title: req.body.title, start: req.body.start, end: req.body.end} } }
    ).exec(function (err, doc){
      if (err) {
          res.status(500)
          res.json(err)
      }
      res.json("Evento eliminado")
  })
})

//Actualizar un evento
Router.post('/events/update', function(req, res){
  console.log("en events/update")
  let user = req.cookies.usuario
  console.log(user)
  Users.update(
    { login: user, "events.title": req.body.title  },
    { $set : { "events.$" : { title: req.body.title, start: req.body.start, end : req.body.end } } }
  ).exec(function (err, doc){
    if (err){
      res.status(500)
      res.json(err)
    }
    res.json("Evento actualizado")
  })

})

// Agregar a un usuario
Router.post('/new', function(req, res) {
    console.log("en new")
    let user = new Users({
        userId: Math.floor(Math.random() * 50),
        nombres: req.body.nombres,
        apellidos: req.body.apellidos,
        edad: req.body.edad,
        sexo: req.body.sexo,
        estado: "Activo"
    })
    user.save(function(error) {
        if (error) {
            res.status(500)
            res.json(error)
        }
        res.send("Registro guardado")
    })
})

// Eliminar un usuario por su id
Router.get('/delete/:id', function(req, res) {
    let uid = req.params.id
    Users.remove({userId: uid}, function(error) {
        if(error) {
            res.status(500)
            res.json(error)
        }
        res.send("Registro eliminado")
    })
})

// Inactivar un usuario por su id
Router.post('/inactive/:id', function(req, res) {

})

// Activar un usuario por su id
Router.post('/active/:id', function(req, res) {

})

module.exports = Router
