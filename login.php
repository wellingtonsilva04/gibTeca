<?php
// Include config file
require_once 'config.php';
 
// Define as variáveis e as inicialza com valores vazios
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Checa se o username é vazio
    if(empty(trim($_POST["username"]))){
        $username_err = 'Por favor entre com seu login.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Checa se o password é vazio
    if(empty(trim($_POST['password']))){
        $password_err = 'Por favor entre com sua senha.';
    } else{
        $password = trim($_POST['password']);
    }
    
    /* Validar credenciais. Se password e usarname não forem vazios. 
    As variaveis username_err e password_err ficam vazias*/
    if(empty($username_err) && empty($password_err)){
        // Prepara o select statement para buscar pelo usuario no banco
        $sql = "SELECT nome, password FROM usuarios WHERE nome= ?";
        
        if($stmt = mysqli_prepare($link, $sql)){//
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // checa se username existe, se sim então checa password
                if(mysqli_stmt_num_rows($stmt) == 1){/*verifica o tamanho do resultado. 
                    Como o login é unico então é retornado apenas 1 resultado*/                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password); // Instrução de onde  salvar o resultado
                    if(mysqli_stmt_fetch($stmt)){/* Obtém o resultado de um preparado comando e coloca nas variáveis 
                        determinadas por mysqli_stmt_bind_result().*/
                        if(password_verify($password, $hashed_password)){//compara a password passada com a obotido do banco
                            /* Se a senha for correta, então inicia uma nova sessão e
                            salva o  username da sessão */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: welcome.php");
                        } else{
                            // Mostra uma mensagem de error se a senha não for valida
                            $password_err = 'A senha que você digitou não era válida.';
                        }
                    }
                } else{
                    // Mostra uma mensagem se username não existir
                    $username_err = 'Nenhuma conta encotrada com esse nome.';
                }
            } else{
                echo "Oops! Algo deu errado ao tentar pesquisar no bando de dados. Por favor tente novamente mais tarde.";
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
<html>
  <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
        <link href="css/login_style.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="jquery/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
  </head>
  <body>
    <div id="wrapper">
      <div id="login_div">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="input-field <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" >
            <i class="mdi-social-person-outline prefix"></i>
            <input class="validate" id="email" type="email">
            <label for="email" data-error="wrong" data-success="right" class="center-align">Entre com seu Email</label>  
          </div>
          <div class="input-field <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password">
            <label for="password">Password</label>
          </div>
          <div class="input-field">
            <button class="btn waves-effect waves-light" type="submit" name="action">Entrar</button>
            </div>
          <p>
            <a href="#" id="register">Registre-se!</a>
            <a href="#" id="forgot">Esqueceu sua senha?</a>
          </p>
          <br>
          <br>
        </form>
      </div>
    </div>
  </body>
  
</html>