const mongoose = require('mongoose')

mongoose.connect('mongodb://localhost/agenda')

const db = mongoose.connection;

const Schema = mongoose.Schema

  let UserSchema = new Schema({
    login: { type: String, required: true, unique: true},
    nombre: { type: String, required: true },
    passwd: { type: String, required: true},
    fecha_nac: { type: String, required: true},
    events: { type: Array, required: false}
  })

  let Usuario = mongoose.model('usuarios', UserSchema)

  module.exports = Usuario
