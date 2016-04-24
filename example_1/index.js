/* โหลด Express มาใช้งาน */
var app = require('express')();
var bodyParser = require('body-parser'); // READ DATA FROM BROWSER
var users = require('./user');
 
/* ใช้ port 1234 หรือจะส่งเข้ามาตอนรัน app ก็ได้ */
var port = process.env.PORT || 1234;

// parse application/json
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
    extended: true
}));

/* สั่งให้ server ทำการรัน Web Server ด้วย port ที่เรากำหนด */
app.listen(port, function() {
    console.log('Starting node.js on port ' + port);
});
 
/* Routing */

app.get('/index', function (req, res) {
    res.send('<h1>This is index page</h1>');
});

// GET USER EXAMPLE

app.get('/', function (req, res) {
    res.send('<h1>Hello Node.js</h1>');
});
 
app.get('/user', function (req, res) {
    res.json(users.findAll());
});
 
app.get('/user/:id', function (req, res) {
    var id = req.params.id; // req.params.id GET ":id" From Route
    res.json(users.findById(id));
});
 
app.post('/newuser', function (req, res) {
    var json = req.body;
    res.send('Add new ' + json.name + ' Completed!');
});

// GET USER EXAMPLE