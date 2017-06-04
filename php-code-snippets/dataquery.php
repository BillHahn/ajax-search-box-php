<?php
  //The mysqli constructor can take in the following parameters:
  //$con = mysqli_connect($hostname, $username, $password, $database, $port, $socket);
  //$db = new pdo('mysql:unix_socket=/cloudsql/bill-hahn-sandbox:us-central1:myinstance;dbname=prodcat', 'root', 'gcp2@cloud');
  //$con = mysqli_connect(getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PW'), getenv('MYSQL_DB'), getenv('MYSQL_PORT'), getenv('MYSQL_SOCKET'));
  //$con = mysqli_connect( null, 'root', 'gcp2@cloud', 'prodcat', null, '/cloudsql/bill-hahn-sandbox:us-central1:myinstance');
  $con = mysqli_connect( null, getenv('MYSQL_USER'), getenv('MYSQL_PW'), getenv('MYSQL_DB'), null, getenv('MYSQL_SOCKET'));
  //if (mysqli_connect_errno()) {
  //  echo "<br><br>Error codes from mysqli_connect_errno() >>> ";
  //  echo mysqli_connect_errno();
  //  echo "<br><br>Error message from mysqli_connect_error() >>> ";
  //  echo mysqli_connect_error();
  //}

  //Not needed because mysqli_connect specifies the default database name
  //$db = mysqli_select_db("prodcat",$con);

  //Get key from Post/Request
  $key = $_GET['key'];  //e.g. hardcoded: $key = "apple - macbook pro";
  
  //Build querystring using key to find rows that include key string using SQL LIKE
  $querystring = "select name from products where name LIKE '%{$key}%'";
  //echo "<br><br>Query String >>> ";
  //echo $querystring;

  //SQL Query database using connection and querystring
  $queryresult = mysqli_query($con, $querystring);
  //echo "<br><br>Number of rows returned from the mysqli_query() >>> ";
  //echo mysqli_num_rows($queryresult);

  //Iterate through queryresult, building an array of each row returned from db 
  $array = array();
  while( $row = mysqli_fetch_assoc($queryresult) )
  {
    $array[] = $row['name'];
  }
  
  //You can use print_r to create a human readable version of almost any variable
  //echo "<br><br> Array built from mysqli_query \$queryresult: <br> ";
  //echo print_r($array, true);

  //echo JSON structure to return as the result of this query
  //echo "<br><br>JSON Result: <br> ";
  echo json_encode($array);