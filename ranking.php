<?php
session_start();

if (isset($_SESSION['email']))
{
    $email = $_SESSION['email'];

    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) 
    {

      echo "<div style='font: 10px sans-serif; background-color: dark; color: white; text-align: center; justify-content: center; 
      z-Index: 5; display: flex; align-items: center;'><h6 class='boasVindas'>Boas-vindas, <br/>" . $email ."</h6>
      <a href='admin.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaAdm'>Área do Administrador</button></a>
      <a href='logout.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaSair'>Sair</button></a><br>
      <a href='index.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaHome'>Home</button></a></div>";
    }
    else {
      echo "<div style='font: 10px sans-serif; background-color: dark; color: white; text-align: center; justify-content: center; 
      z-Index: 5; display: flex; align-items: center;'><h6 class='boasVindas'>Boas-vindas, <br/>" . $email ."</h6>
      <a href='index.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaHome'>Home</button></a>
      <a href='logout.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaSair'>Sair</button></a></div>";
    
    }
} 
else 
{
    header("Location: login.php?erro=3");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Ranking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
    
    <style>    
      body{ 
        font-family: 'Press Start 2P', cursive;
        text-align: center; 
        color: whitesmoke;
      }

      table, td, td{
        position: flex;
        border: 2px solid whitesmoke;
        color: whitesmoke;
        transform: translate (-50%, -50%);
        font-family: 'Press Start 2P', cursive;
        font-size: 20px;
        margin-left: 29%;
        text-align: center;
        margin-bottom: 10%;
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

      .imagem {
          height: 70%;
      }

      .btnAreaHome{
            position: absolute; 
            top: 1%; 
            right: 11%;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            font-family: 'Press Start 2P', cursive;
        }

        .btnAreaAdm{
            position: absolute; 
            top: 1%; 
            right: 20%;
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

        .boasVindas{
            position: absolute; 
            top: 1%; 
            left: 2%;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            font-family: 'Press Start 2P', cursive;
        }

        .ranking{
            position: absolute; 
            top: 13%; 
            left: 29%;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            font-family: 'Press Start 2P', cursive;
        }
        
        h3{
            margin-top: 15%;
        }

    </style>
</head>

<body>
    <video class="fundo-video" src="./hexagon.mp4" autoplay muted loop></video>

<h1 class="ranking">Ranking dos Jogos</h1>

<?php

$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "portal_jogos";

$con = mysqli_connect ($host, $user, $pass, $base);


$jogos = ["Adivinhe o Número", "Jokenpô", "Par ou Ímpar", "Jogo dos Três Copos"];

foreach ($jogos as $jogo) {

    $sqlRanking = "SELECT fk_usuario, pontos FROM pontos_jogos WHERE nome_jogo = ? ORDER BY pontos DESC";
    $consulta = $con->prepare($sqlRanking);
    $consulta->bind_param("s", $jogo);
    $consulta->execute();
    $resultado = $consulta->get_result();


    echo "<h3>Ranking do {$jogo}</h3><br><br>";
    echo "<table>";
    echo "<tr><td>Posição</td><th>Usuário</td><td>Pontos</td></tr>";

    $posicao = 1;
    while ($row = $resultado->fetch_assoc()) {
        $usuario = $row['fk_usuario'];
        $pontos = $row['pontos'];
        echo "<tr><td>{$posicao}</td><td>{$usuario}</td><td>{$pontos}</td></tr>";
        $posicao++;
    }

    echo "</table>";
}

$con->close();
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>