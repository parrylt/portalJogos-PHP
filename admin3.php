<?php

session_start();

if (isset($_SESSION['email']))
{
    $email = $_SESSION['email'];

    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) 
    {
    echo "<div style='font: 10px sans-serif; background-color: dark; color: white; text-align: center; justify-content: center; 
    z-Index: 5; display: flex; align-items: center;'><h6 class='boasVindas'>Boas-vindas, <br/>" . $email ."</h6>
    <a href='index.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaHome'>Home</button></a></h5>
    <a href='logout.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaSair'>Sair</button></a></div>";
    } 
    else 
    {
    header("Location: index.php?erroAdmin=1");
    exit;
    }
}
else 
{
    header("Location: login.php?erro=2");
    exit;
}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Admnistrador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
   

</head>
<body>
<video class="fundo-video" src="./hexagon.mp4" autoplay muted loop></video>

    <a href="cadastrados.php"><button class="btnCadastrados btn-outline-light btn-lg">Ver cadastrados</button></a>
    <a href="admin.php"><button class="btnCadastros btn-outline-light btn-lg">Ver cadastros</button></a>

    <style> 

    body{ 
        font: 14px sans-serif;
        text-align: center; 
    }
    table,th,td{
        padding: 10px; 
        justify-content: center; 
        border: 1px solid whitesmoke; 
        border-collapse: collapse; 
        text-align: center;
        color: whitesmoke;
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

    .btnCadastrados{
        font-family: 'Press Start 2P', cursive;
        position: absolute;
        transform: translate (-50%, -50%);
        width: 25%;
        top: 35%;
        left: 37%;
    }

    .btnCadastros{
        font-family: 'Press Start 2P', cursive;
        position: absolute;
        transform: translate (-50%, -50%);
        width: 25%;
        top: 45%;
        left: 37%;
    }

    h5{
        font-family: 'Press Start 2P', cursive;
        position: flex;
        transform: translate (-50%, -50%);
        color: whitesmoke;
    }

    h3{
        font-family: 'Press Start 2P', cursive;
        position: flex;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        margin-top: 8%;
    }

    .btnAreaHome{
        position: absolute; 
        top: 1%; 
        right: 11%;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        font-family: 'Press Start 2P', cursive;
        }

    .btnAreaSair{
        position: absolute; 
        top: 1%; 
        right: 2%;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        font-family: 'Press Start 2P', cursive;
    }

    .btnAreaAdm{
        position: absolute; 
        top: 1%; 
        right: 23%;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        font-family: 'Press Start 2P', cursive;
    }

    .boasVindas{
        position: absolute; 
        top: 1%; 
        left: 2%;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        font-family: 'Press Start 2P', cursive;
    }

    </style>

<?php


$id = $_POST['id'];
$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "portal_jogos";
$con   = mysqli_connect($host, $user, $pass, $base);

$validar = mysqli_query($con, "update usuarios set cad_valido = 1 where id_user = $id ;"); 

$cadastro = mysqli_query ($con, 'SELECT * FROM usuarios WHERE cad_valido = 0');

    if (mysqli_num_rows($cadastro) === 0) 
    {
    echo "<h3>Nenhum cadastro para ser revisado!</h3>";
    
    } 
    else
    {
        echo '<h3>Você tem cadastro para revisar!';
    }



    mysqli_close ($con);
?>

</body>
</html>