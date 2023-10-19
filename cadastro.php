<?php
session_start();

if (isset($_SESSION['email'])) {
    
    header("Location: index.php?erroLogin=1");
    exit;
}

$emailErro = $senhaErro = $senhaIgualErro = "";

if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];

    if ($erro == 1)
    {
        $senhaErro = "* A senha deve conter pelo menos 8 caracteres.";
    }
    elseif ($erro == 2) 
    {
        $senhaErro = "* A senha deve conter pelo menos um número.";
    }
    elseif ($erro == 3)
    {
        $senhaErro = "* A senha deve conter pelo menos uma letra maiúscula e uma letra minúscula.";
    }
    elseif ($erro == 4)
    {
        $senhaErro = "* A senha deve conter pelo menos um caractere especial.";
    }
    elseif ($erro == 5)
    {
        $senhaIgualErro = "* As senhas não coincidem. Tente novamente.";
    }
    elseif ($erro == 6)
    {
        $emailErro = "* Este e-mail já está cadastrado. Escolha outro.";
    }
}   
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
    
</head>
<body>

<a href='index.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaHome'>Home</button></a>

<video class="fundo-video" src="./chain.mp4" autoplay muted loop></video>

    <div class="wrapper">
        <h3>Cadastre-se</h3>
        <p>Preencha com as suas informações para criar uma conta.</p>
        <form action="autenticaCadastro.php" method="post">
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
            <span class="erro">
                <?php echo isset($emailErro) ? $emailErro : ''; ?>
                </span><br>  
            </div>  
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" name="senha">
            </div>
            <div class="form-group">
            <span class="erro">
                <?php echo isset($senhaErro) ? $senhaErro : ''; ?>
                </span><br>  
            </div>  
            <div class="form-group">
                <label>Confirme a Senha</label>
                <input type="password" class="form-control" name="confirmar_senha">
            </div>
            <div class="form-group">
            <span class="erro">
                <?php echo isset($senhaIgualErro) ? $senhaIgualErro : ''; ?>
                </span><br>  
            </div>  
            <div class="form-group">
                <input type="submit" class="btnCad btn-outline-light btn-lg" value="Cadastrar">
                <input type="reset" class="btnApagar btn-outline-light btn-lg" value="Apagar Dados">
            </div>
            <p>Você já tem uma conta? <a href="login.php">Faça o Login aqui</a></p>
        </form>
    </div> 

    <style>
        body{ 
            font: 14px sans-serif; 
        }  

    .fundo-video {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          object-fit: cover;
          z-index: -1;
      }

      p{
        margin-left: 8%;
      }

      .wrapper{
        position: absolute; 
        top: 3%; 
        width: 350px;
        right: 38%;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        font-family: 'Press Start 2P', cursive;
      }

      .btnCad{
        margin-left: 20%;
        margin-top: 1%;
      }

      .btnApagar{
        margin-left: 12%;
        margin-top: 5%;
      }

      .btnAreaHome{
        position: absolute; 
        top: 1%; 
        right: 2%;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        font-family: 'Press Start 2P', cursive;
      }

</style>

</body>
</html>