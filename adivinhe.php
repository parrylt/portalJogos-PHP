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
      <a href='logout.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaSair'>Sair</button></a>";
    }
    else {
      echo "<div style='font: 10px sans-serif; background-color: dark; color: white; text-align: center; justify-content: center; 
      z-Index: 5; display: flex; align-items: center;'><h6 class='boasVindas'>Boas-vindas, <br/>" . $email ."</h6>
      <a href='logout.php'><button type='button'class='btn btn-outline-light btn-lg btnAreaSair'>Sair</button></a></div>";
    
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
    <title>Adivinhe o Número</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
    
    <style>
        body{ 
            font: 14px sans-serif; 
            text-align: center; 
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

        h1{
            position: absolute; 
            top: 16%; 
            left: 9.5%;
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

        form{
            position: absolute; 
            top: 50%; 
            left: 40%;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            font-family: 'Press Start 2P', cursive;
        }
        
        .entrada{
            font-family: 'Press Start 2P', cursive;
            position: relative;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            left: 28%;
            width: 25%;
            height: 47px;
            color: black;
            font-size: 20px;
            text-align: center;
        }

        .btnTentar{
            font-family: 'Press Start 2P', cursive;
            position: relative;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            left: 30%;
            height: 15%;
        }

        .resultado{
            position: absolute; 
            top: 40%; 
            right: 21%;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            font-family: 'Press Start 2P', cursive;
        }

    </style>
</head>

<body>
    <video class="fundo-video" src="./blue.mp4" autoplay muted loop></video>

    <div>
      <a href="index.php" type="button" class="btn btn-outline-light btn-lg btnAreaHome">Home</a>
    </div>

    <h1>Adivinhe o Número entre 1 e 6</h1>

        <form action='#' method='post'>
            <input class="entrada" type='number' min='1' max='6' name='entrada' required>
            <input class="btnTentar btn-outline-light btn-lg" type='submit' value='Tentar'>
        </form><br/>
    
    <div>
    <?php 

        if ($_POST) {
            if (isset($_POST['entrada'])) {
                verAdiv();

        }}

function verAdiv(){

    $rand = rand(1, 6);

    $adivinha = $_POST['entrada'];

        if ($rand == $adivinha){
            echo "
            <h2 class='resultado shadow-lg p-3 mb-5 bg-dark rounded p-2 '>Parabéns, você acertou! <br/> O número era 
            <strong>". $rand ."</strong>. <br/> Você ganhou 1 ponto. <br/><br/><a href='adivinhe.php'><button type='button' 
            class='btn btn-outline-light btn-lg '>Jogar de Novo</button></a></h2>";

                $jogo = "Adivinhe o Número";
                $pontosPartida = 1;
                $email = $_SESSION['email'];

                $host  = "localhost:3306";
                $user  = "root";
                $pass  = "";
                $base  = "portal_jogos";
            
                $con = mysqli_connect ($host, $user, $pass, $base);

                $sqlConsulta = "SELECT pontos FROM pontos_jogos WHERE fk_usuario = ? AND nome_jogo = ?";
                $consulta = $con->prepare($sqlConsulta);
                $consulta->bind_param("ss", $email, $jogo);
                $consulta->execute();
                $resultado = $consulta->get_result();

                    if ($resultado->num_rows > 0)
                    {
                        $row = $resultado->fetch_assoc();
                        $pontosNoBD = $row['pontos'];                    
                        $pontosFeitos = $pontosNoBD + $pontosPartida;
                        

                        $sqlAtualizacao = "UPDATE pontos_jogos SET pontos = ? WHERE fk_usuario = ? AND nome_jogo = ?";
                        $atualizacao = $con->prepare($sqlAtualizacao);
                        $atualizacao->bind_param("iss", $pontosFeitos, $email, $jogo);
                        $atualizacao->execute();

                    } else {
                        $sqlEntrada = "INSERT INTO pontos_jogos (fk_usuario, nome_jogo, pontos) VALUES (?, ?, ?)";
                        $entra = $con->prepare($sqlEntrada);
                        $entra->bind_param("ssi", $email, $jogo, $pontosPartida);
                        $entra->execute();
                    }
        }
        else
        {
            echo "
            <h2 class='resultado shadow-lg p-3 mb-5 bg-dark rounded p-2'>
            Errooooooooooooooooooou!<br/> O número era <strong>". $rand ."</strong>.<br/> Você perdeu 1 ponto.<br/> <br/>
            <a href='adivinhe.php'><button type='button' class='btn btn-outline-light btn-lg '>
            Jogar de Novo</button></a></h2>";

                $jogo = "Adivinhe o Número";
                $pontosPartida = -1;
                $email = $_SESSION['email'];

                $host  = "localhost:3306";
                $user  = "root";
                $pass  = "";
                $base  = "portal_jogos";
            
                $con = mysqli_connect ($host, $user, $pass, $base);

                $sqlConsulta = "SELECT pontos FROM pontos_jogos WHERE fk_usuario = ? AND nome_jogo = ?";
                $consulta = $con->prepare($sqlConsulta);
                $consulta->bind_param("ss", $email, $jogo);
                $consulta->execute();
                $resultado = $consulta->get_result();

                    if ($resultado->num_rows > 0)
                    {
                        $row = $resultado->fetch_assoc();
                        $pontosNoBD = $row['pontos'];                    
                        $pontosFeitos = $pontosNoBD + $pontosPartida;
                        

                        $sqlAtualizacao = "UPDATE pontos_jogos SET pontos = ? WHERE fk_usuario = ? AND nome_jogo = ?";
                        $atualizacao = $con->prepare($sqlAtualizacao);
                        $atualizacao->bind_param("iss", $pontosFeitos, $email, $jogo);
                        $atualizacao->execute();

                    } else {
                        $sqlEntrada = "INSERT INTO pontos_jogos (fk_usuario, nome_jogo, pontos) VALUES (?, ?, ?)";
                        $entra = $con->prepare($sqlEntrada);
                        $entra->bind_param("ssi", $email, $jogo, $pontosPartida);
                        $entra->execute();
                    }
        }
        $con->close();
}

?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>