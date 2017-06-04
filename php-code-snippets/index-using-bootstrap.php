<!DOCTYPE html>
<html lang="en">
  <head>
  
    <!-- Latest compiled and minified Bootstrap CSS and JS below, from http://getbootstrap.com/getting-started/#download -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"> -->

    <!-- Javascript libraries (JQuery, Bootstrap and bootstrap-3-typeahead) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function() {
        $('input.typeahead').typeahead({
          source: function (query, process) {
            $.ajax({
              url: 'data.php',
              type: 'POST',
              dataType: 'JSON',
              data: 'query=' + query,
              success: function(data) {
                console.log(data);
                process(data);
              }
            });
          }
        });
      });
    </script>
  </head>
  <body>
    <!-- The Typeahead Input Field on web page bound to Bootstrap Typeahead to query MySQL for autocomplete results. -->
    <div class="container">
      <input class="typeahead" type="text" data-provide="typeahead" autocomplete="off">
      <!-- <input class="typeahead" type="text" data-provide="typeahead tt-query" autocomplete="off"> -->
      <?php echo $_SERVER['MYSQL_SOCKET']; ?>
    </div><!-- /.container -->
  </body>
</html>