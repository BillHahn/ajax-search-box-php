// Make sure the data.php file only prints out the json!
// If you have other things echoing/printing out,
// it will mess the json response up and you will not get the return you want for the typeahead!!

<?php

  //The mysqli constructor can take in the following parameters:
  //$mysqli = mysqli($hostname, $username, $password, $database, $port, $socket);
//  $mysqli = new mysqli(getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PW'), getenv('MYSQL_DB'), getenv('MYSQL_PORT'), getenv('MYSQL_SOCKET'));
  $mysqli = new mysqli('35.184.135.20', 'root', 'gcp2@cloud', 'prodcat', '3306', '/cloudsql/bill-hahn-sandbox:us-central1:myinstance');
  //Clarification: Yu can pass null for the database name. In the query you'd need to use the fully qualified table name
  // For example: prodcat.products in my case here. Or you can use the mysqli_select_db() function to select the database to use.

//debug_to_console( 'debug test hello!' );`
//error_log ( "This is logged only to the PHP log" );
//printf("Hello from data.php");

  // Just Connect
  //$mysqli->connect();

  // check connection
  if ($mysqli->connect_errno()){
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }


  $query = 'SELECT name FROM products';

  if(isset($_POST['query'])){
    // Now set the WHERE clause with LIKE query
    $query .= ' WHERE name LIKE "%' . $_POST['query'] . '%"';
  }

  $return = array();
  if($result = $mysqli->query($query)){
    // fetch object array
    while($obj = $result->fetch_object()) {
      $return[] = $obj->name;
    }

    // free result set
    $result->close();
  }

  // close connection
  $mysqli->close();

  //$json = json_encode($return);
  //print_r($json);

  echo json_encode($return);

  //echo '[{"name":"aaa"},{"name":"bbb"},{"name":"ccc"}]';
  //exit();
