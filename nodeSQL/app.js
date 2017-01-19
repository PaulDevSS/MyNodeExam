var mysql = require("mysql");

// First you need to create a connection to the db
// var con = mysql.createConnection({
//   host: "111.235.138.158",
//   user: "remote_exo",
//   password: "rem2011ote!",
//   database: "exotissi_intranet"
// });

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "realtime"
});

con.connect(function(err){
  if(err){
    console.log('Error connecting to Db');
    return;
  }
  console.log('Connection established');
});

var counter = 0;
var numOfData = 0;
setInterval(function(){ 

  con.query('SELECT COUNT(*) AS count FROM data_test',function(err,rows){
    if(err) throw err;

    console.log("*********************************************** "+counter++);
    console.log("***********************************************");
    console.log("Current DATA : "+numOfData);
    console.log("Query DATA "+rows[0].count);
    numOfData = rows[0].count;
  });

}, 5000);

// Query

// con.query('SELECT * FROM data_test',function(err,rows){
//   if(err) throw err;

//   console.log('Data received from Db:\n');
//   console.log(rows);
// });


// function testQuery(con, numOfData) {

//   con.query('SELECT COUNT(*) AS count FROM data_test',function(err,rows){
//     if(err) throw err;

//     console.log("***********************************************");
//     console.log("***********************************************");
//     console.log("Current DATA : "+numOfData);
//     console.log("Query DATA "+rows[0].count);
//     numOfData = rows[0].count;
//     console.log("***********************************************");
//     console.log("***********************************************");
//   });
// }



// con.end(function(err) {
//   // The connection is terminated gracefully
//   // Ensures all previously enqueued queries are still
//   // before sending a COM_QUIT packet to the MySQL server.
// });