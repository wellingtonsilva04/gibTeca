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
                            header("location:welcome.php");
                        } else{
                            // Mostra uma mensagem de error se a senha não for valida
                            $password_err = 'A senha que você digitou não era válida.';
                        }
                    }
                } else{
                    // Mostra uma mensagem se username não existir
                    $username_err = 'Nenhuma conta encontrada com esse nome.';
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

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="../public/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>     
    <link rel= "stylesheet" href = "css/login.css">
    </head>
<body>
    <div class="container">
        
        <form class ="form-signin white z-depth-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2 class = "center-align">Login</h2>
            <p>Por favor entre com suas credencias para fazer o login.</p>    
            <div class="input-field <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" id = "nome" name="username" class="validate" value="<?php echo $username; ?>">
                <label for= "nome">Nome de Usuário</label>
                <span class="helper-text red-text"><?php echo $username_err; ?></span>
            </div>    
            <div class="input-field <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Senha</label>
                <input type="password" name="password" class="validate">
                <span class="helper-text red-text"><?php echo $password_err; ?></span>
            </div>
            <button type="submit" class="btn waves-effect waves-light" value="Login">Acessar</button>
            <p>Você não tem uma conta? <a href="register.php">Registre-se agora</a>.</p>
        </form>
    </div><!--/container-->
    <!-- Compiled and minified JavaScript -->
    <script src="../public/js/materialize.min.js"></script>
</body>
</html>