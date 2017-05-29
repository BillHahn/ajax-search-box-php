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


<style type="text/css">
.bs-example{
	font-family: sans-serif;
	position: relative;
	margin: 50px;
}
.typeahead, .tt-query, .tt-hint {
	width: 790px;
  border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 18px;
	height: 24px;
	line-height: 24px;
	outline: medium none;
	padding: 4px 6px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
/*	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset; */
-webkit-box-shadow: inset 0 5px 5px rgba(0, 0, 0, 0.075);
   -moz-box-shadow: inset 0 5px 5px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 5px 5px rgba(0, 0, 0, 0.075);
}
.tt-hint {
/*	color: #999999;*/
width: 800px;
height: 24px;
padding: 4px 6px;
font-size: 18px;
line-height: 24px;
border: 2px solid #ccc;
-webkit-border-radius: 8px;
   -moz-border-radius: 8px;
        border-radius: 8px;
outline: none;
}
.tt-dropdown-menu {
  width: 800px;
  margin-top: 4px;
  padding: 1px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
}
.tt-suggestion {
	font-size: 18px;
	line-height: 18px;
	padding: .1px 0px;
	margin: 0;
}
.tt-suggestion.tt-is-under-cursor {
/*	background-color: #0097CF;
	color: #FFFFFF;*/
  color: #fff;
  background-color: #0087cf;
}

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
       src="https://storage.googleapis.com/bh-images/php-logo.jpg"
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
