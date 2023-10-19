<?php
session_start();

if (isset($_SESSION['email'])) {
    
    header("Location: index.php?erroLogin=1");
    exit;
}


$mensagemErro = '';

if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];

if ($erro == 1) {
    $mensagemErro = '<h5>Erro: Credenciais de login incorretas ou o administrador não liberou o seu cadastro. 
    Tente novamente ou comunique o administrador.</h5>';

}
elseif ($erro == 2)
{
    $mensagemErro = "A sessão expirou ou você não se conectou. Faça o login nesta página.";
}
elseif ($erro == 3)
{
    $mensagemErro = "É necessário estar conectado para jogar. Faça o login nesta página.";
}

}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styleAdivinhe.css">
    <style>

      .wrapper{ 
        width: 340px; 
        margin-top: 10%; 
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

      .login{
        position: absolute; 
        top: 30%; 
        right: 45%;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        font-family: 'Press Start 2P', cursive;
      }

      .btn{
        margin-left: 75px;
        margin-top: 2px;
      }

      .erro{
        position: flex; 
        margin-top: 1%; 
        margin-left: 25%;
        margin-right: 20%;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        font-family: 'Press Start 2P', cursive;
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
</head>
<body>

<a href='index.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaHome'>Home</button></a><br>

<video class="fundo-video" src="./chain.mp4" autoplay muted loop></video>

<div class="erro">
<span>              
      <?php echo isset($mensagemErro) ? $mensagemErro : ''; ?>
    </span><br>
</div>
<div class="login">
    <h2> &nbsp &nbsp &nbsp Login</h2><br><br><br><br>
    <form action="autenticaLogin.php" method="post">
        E-mail: <input type="email" name="email" required><br><br>
        Senha: <input type="password" name="senha" required><br><br>  
        <input class="btn btn-outline-light btn-lg" type="submit" value="Entrar">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>