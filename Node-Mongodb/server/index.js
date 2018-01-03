const http = require('http'),
      path = require('path'),
      Routing = require('./rutas.js'),
      express = require('express'),
      bodyParser = require('body-parser'),
      mongoose = require('mongoose'),
      cookieParser = require('cookie-parser');

const PORT = 3000
const app = express()

const Server = http.createServer(app)

mongoose.connect('mongodb://localhost/c7')


app.use(express.static('client'))
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: true}))
app.use(cookieParser())
app.use(Routing)

Server.listen(PORT, function() {
  console.log('Server is listeng on port: ' + PORT)
})
