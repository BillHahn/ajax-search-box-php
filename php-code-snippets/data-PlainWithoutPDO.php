<?php

// Make sure the data.php file only prints out the json!
// If you have other things echoing/printing out,
// it will mess the json response up and you will not get the return you want for the typeahead!!

  //The mysqli constructor can take in the following parameters:
  //$mysqli = mysqli($hostname, $username, $password, $database, $port, $socket);
//  $mysqli = new mysqli(getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PW'), getenv('MYSQL_DB'), getenv('MYSQL_PORT'), getenv('MYSQL_SOCKET'));

  $con = mysqli_connect(null, 'root', 'gcp2@cloud', 'prodcat', null , '/cloudsql/bill-hahn-sandbox:us-central1:myinstance');
  //Clarification: Yu can pass null for the database name. In the query you'd need to use the fully qualified table name
  // For example: prodcat.products in my case here. Or you can use the mysqli_select_db() function to select the database to use.

  // Set DB
  $db = mysqli_select_db("prodcat",$con);

  // Get Key
  $key = $_GET['key'];
  
  // Set Selet Statement using LIKE and create query obj
  //$query = "SELECT name FROM products WHERE name LIKE '%{$key}%'";
  $query = mysqli_query("select name from prodcat.products where name LIKE '%{$key}%'");
  
  // Iterate through query row results and save in an array
  $array = array();
  while( $row = mysql_fetch_assoc($query) )
  {
    $array[] = $row['name'];
  }
  
  // Send results of query back to typeahead as JSON formatted results
  echo json_encode($array);