// Make sure the data.php file only prints out the json!
// If you have other things echoing/printing out,
// it will mess the json response up and you will not get the return you want for the typeahead!!

<?php
  $mysqli = new mysqli(getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PW'), getenv('MYSQL_DB'));

  // check connection
  if ($mysqli->connect_errno){
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
      $return[] = $obj->title;
    }

    // free result set
    $result->close();
  }

  // close connection
  $mysqli->close();

  $json = json_encode($return);
  print_r($json);
  exit();
