<!DOCTYPE html>
<html>
<head>
<title> GIBTECA </title>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="public/css/materialize.min.css">
<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel= "atylesheet" href= "public/css/index.css">
<!-- Compiled and minified JavaScript -->

        
</head>
<body>
  <div class="container">  
    <header>
      <nav>
        <div class="nav-wrapper row">
          <div class="col s4">
          <a href="index.php" class="brand-logo">Logo</a>
          </div>

          <form class= "col s4">
            <div class="input-field">
              <input id="search" type="search" required>
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
            </div>
          </form>
          <div class= "col s4">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href= "login.php"><i class="material-icons">account_circle</i></a></li>
              <li><a href="teste.php">Teste</a></li>
            </ul>
          </div>
          
        </div>
      </nav>
    </header>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, options);
      });
    </script>
  </div>
  <script src="js/materialize.min.js"></script>
</body>
</html>



