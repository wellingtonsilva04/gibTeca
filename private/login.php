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
        $username_err = 'Por favor entre com seu username.';
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
        $sql = "SELECT id, nome, senha FROM usuarios WHERE nome= ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // checa se username existe, se sim então checa password
                if(mysqli_stmt_num_rows($stmt) == 1){ /*verifica o tamanho do resultado. 
                    Como o login é unico então é retornado apenas 1 resultado*/                      
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id,$username, $hashed_password);// Instrução de onde  salvar o resultado
                    if(mysqli_stmt_fetch($stmt)){/* Obtém o resultado de um preparado comando e coloca nas variáveis 
                        determinadas por mysqli_stmt_bind_result().*/
                        if(password_verify($password, $hashed_password)){//compara a password passada com a obotido do banco
                            /* Se a senha for correta, então inicia uma nova sessão e
                            salva o  username da sessão */
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['id']=$id;
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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel= "stylesheet" href = "css/login.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        
        <form class ="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2 class = "form-signin-heading">Login</h2>
            <p>Por favor entre com suas credencias para fazer o login.</p>    
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Nome de Usuário</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Senha</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block" value="Login">Acessar</button>
            <p>Você não tem uma conta? <a href="register.php">Registre-se agora</a>.</p>
        </form>
    </div><!--/container>    
</body>
</html>