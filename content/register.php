<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor entre com um login.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM usuarios WHERE nome = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $username);
            
            // Set parameters
            $username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO usuarios (nome, senha) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            
            // Set parameters
            $username = $username;
            $password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Registre-se</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link rel= "stylesheet" href = "css/register.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>     
    
</head>
<body>
    <div class="container">
        
        <form class ="form-signin white z-depth-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1 class="center-align">Criar Conta</h1>
            <p>Por favor preencha o formulário com seus dados.</p>
            <div class="input-field <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" value="<?php echo $username; ?>">
                <label>Username</label>
                <span class="helper-text red-text"><?php echo $username_err; ?></span>
            </div>    
            <div class="input-field <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" value="<?php echo $password; ?>">
                <label>Password</label>
                <span class="helper-text red-text"><?php echo $password_err; ?></span>
            </div>
            <div class="input-field <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password"  value="<?php echo $confirm_password; ?>">
                <label>Confirm Password</label>
                <span class="helper-text red-text"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="input-field">
                <div class="row">
                    <input type="submit" class="btn col s4 push-s1 left" value="Registrar">
                    <input type="reset" class="btn col s4 pull-s1 right" value="Limpar">
                </div>
            </div>
            <p class="center-align">Você ja tem uma conta? <a href="login.php">Entre Aqui</a>.</p>
        </form>
    </div>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
</body>
</html>