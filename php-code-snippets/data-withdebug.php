<html>
<head>
    <title>GCP Autocomplete Ajax UI: GAE + Node.js + MySQL Backend!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://storage.googleapis.com/bh-js/typeahead.min.js"></script>
       <!-- <script src="/js/typeahead.min.js"></script> -->

<!--
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'data-hardcoded.php?key=%QUERY',
        limit : 10
    });
});
    </script>
-->


</style>
</head>
<body>
<?php echo "<h1> Hello top of body! </h1>"; ?>
  <!--
  <div class="page-image">
    <a href="http://localhost:8081" target="_blank"><img src="https://storage.googleapis.com/bh-images/Node.js-DevLogo.jpg"
    alt="This App developed with Node.js + Ajax JQuery + MySQL + GCP + GAE"
    style="width:100px;height:50px;cursor:pointer;cursor:hand;">
  -->
  </div>
   <div class="page-header">
     <a href="">
       <img id="Node.js-DevLogo"
       src="https://storage.cloud.google.com/bh-images/php-mysql-js-logos.jpg"
       alt="Node.js version of Autocomplete - in GCP with GAE and MySQL backend!"
       width="100" height="50"
       style="cursor:pointer; cursor:hand; border:0"
       />
     </a>
        <h1>INDEX.PHP: GCP Autocomplete Ajax UI: GAE + Node.js + MySQL Backend!
        </h1>
    </div>
<!--
    <div class="bs-example">
        <input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Type your Query">
        <iframe width="800" height="450" src="https://m.google.com" frameborder="1" allowfullscreen></iframe>
    </div>
    <div class="bh-php-code">
-->
        <!-- https://www.youtube.com/embed/0xTyGtu-Ryo?autoplay=1 -->
        <!-- https://www.youtube.com/embed/0xTyGtu-Ryo?t=0s&loop=1&autoplay=1&rel=0&controls=0 -->

<?php
  //The mysqli constructor can take in the following parameters:
  //$con = mysqli_connect($hostname, $username, $password, $database, $port, $socket);
  //$db = new pdo('mysql:unix_socket=/cloudsql/bill-hahn-sandbox:us-central1:myinstance;dbname=prodcat', 'root', 'gcp2@cloud');
  //$con = mysqli_connect(getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PW'), getenv('MYSQL_DB'), getenv('MYSQL_PORT'), getenv('MYSQL_SOCKET'));
  //$con = mysqli_connect( null, 'root', 'gcp2@cloud', 'prodcat', null, '/cloudsql/bill-hahn-sandbox:us-central1:myinstance');
  $con = mysqli_connect( null, getenv('MYSQL_USER'), getenv('MYSQL_PW'), getenv('MYSQL_DB'), null, getenv('MYSQL_SOCKET'));
  if (mysqli_connect_errno()) {
    echo "<br><br>Error codes from mysqli_connect_errno() >>> ";
    echo mysqli_connect_errno();
    echo "<br><br>Error message from mysqli_connect_error() >>> ";
    echo mysqli_connect_error();
  }

  //I don't think this is needed because mysqli_connect specifies the default database name
  //$db = mysqli_select_db("prodcat",$con);

  //Get key from Post/Request
  //$key = $_GET['key'];
  $key = "apple - macbook pro";
  
  //Build querystring using key to find rows that include key string using SQL LIKE
  $querystring = "select name from products where name LIKE '%{$key}%'";
  echo "<br><br>Query String >>> ";
  echo $querystring;

  //SQL Query database using connection and querystring
  $queryresult = mysqli_query($con, $querystring);
  echo "<br><br>Number of rows returned from the mysqli_query() >>> ";
  echo mysqli_num_rows($queryresult);

  //Iterate through queryresult, building an array of each row returned from db 
  $array = array();
  while( $row = mysqli_fetch_assoc($queryresult) )
  {
    $array[] = $row['name'];
  }
  
  //echo "<br><br> Array built from mysqli_query \$queryresult: <br> ";
  //You can use print_r to create a human readable version of almost any variable
  //echo print_r($array, true);

  //echo JSON structure to return as the result of this query
  echo "<br><br>JSON Result: <br> ";
  echo json_encode($array);
  //$json = json_encode($array);
  //print_r($json);
?>

</body>
</html>
