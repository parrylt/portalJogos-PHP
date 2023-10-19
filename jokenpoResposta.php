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
      <a href='index.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaHome'>Home</button></a>
      <a href='jokenpo.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaJogarDeNovo'>Jogar de Novo</button></a></div>";
    }
    else {
      echo "<div style='font: 10px sans-serif; background-color: dark; color: white; text-align: center; justify-content: center; 
      z-Index: 5; display: flex; align-items: center;'><h6 class='boasVindas'>Boas-vindas, <br/>" . $email ."</h6>
      <a href='index.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaHome'>Home</button></a><br>
      <a href='jokenpo.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaJogarDeNovo'>Jogar de Novo</button></a>
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
    <title>Jokenpô</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
    </head>

<body>
    <h1>Resultado:</h1>

    <video class="fundo-video" src="./glitch.mp4" autoplay muted loop></video>

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

      img {
        width: 15%;
        height: 45%;
        margin-top: 5%;
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
          right: 42%;
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

      .btnAreaJogarDeNovo{
            position: absolute; 
            top: 1%; 
            right: 20%;
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

        h1{
            margin-top: 5%;
        }

    </style>
    
    <?php

    if (isset($_POST['escolha'])) {
        $escolhaUsuario = $_POST['escolha'];
        

        $opcoes = ["Pedra", "Papel", "Tesoura"];
        $escolhaComputador = $opcoes[array_rand($opcoes)];
        

        echo "<p>Sua escolha: $escolhaUsuario</p>";
        echo "<p>Escolha do Computador: $escolhaComputador</p>";

        if ($escolhaUsuario == "Pedra") {
        
            if ($escolhaComputador == "Pedra")
            {
                echo 'Você empatou. O computador também escolheu pedra. Você não ganhou nenhum ponto.<br><img src="pedra.png" alt="Pedra">   vs    <img src="pedra.png" alt="Pedra">';

                $jogo = "Jokenpô";
                $pontosPartida = 0;
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
            else if ($escolhaComputador == "Papel") {
                echo 'Você perdeu. O computador escolheu papel. Você perdeu 1 ponto.<br><img src="pedra.png" alt="Pedra">   vs    <img src="papel.png" alt="Papel">';

                $jogo = "Jokenpô";
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
            else if ($escolhaComputador == "Tesoura") {
                echo 'Você ganhou. O computador escolheu tesoura. Você ganhou 1 ponto.<br><img src="pedra.png" alt="Pedra">   vs    <img src="tesoura.png" alt="Tesoura">';

                $jogo = "Jokenpô";
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
        }
        
        if ($escolhaUsuario == "Papel") {      
                
            if ($escolhaComputador == "Pedra")
            {
                echo 'Você ganhou. O computador escolheu pedra. Você ganhou 1 ponto.<br><img src="papel.png" alt="Papel">   vs    <img src="pedra.png" alt="Pedra">';

                $jogo = "Jokenpô";
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
            else if ($escolhaComputador == "Papel") {
                echo 'Você empatou. O computador também escolheu papel. Você não ganhou nenhum ponto.<br><img src="papel.png" alt="Papel">   vs    <img src="papel.png" alt="Papel">';

                $jogo = "Jokenpô";
                $pontosPartida = 0;
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
            else if ($escolhaComputador == "Tesoura") {
                echo 'Você perdeu. O computador escolheu tesoura. Você perdeu 1 ponto.<br><img src="papel.png" alt="Papel">   vs    <img src="tesoura.png" alt="Tesoura">';

                $jogo = "Jokenpô";
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
        }
        
        
        if ($escolhaUsuario == "Tesoura") {
              
            if ($escolhaComputador == "Pedra")
            {
                echo 'Você perdeu. O computador escolheu pedra. Você perdeu 1 ponto.<br><img src="tesoura.png" alt="Tesoura">   vs    <img src="pedra.png" alt="Pedra">';

                $jogo = "Jokenpô";
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
            else if ($escolhaComputador == "Papel") {
                echo 'Você ganhou. O computador escolheu papel. Você ganhou 1 ponto.<br><img src="tesoura.png" alt="Tesoura">    vs    <img src="papel.png" alt="Papel">';

                $jogo = "Jokenpô";
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
            else if ($escolhaComputador == "Tesoura") {
                echo 'Você empatou. O computador também escolheu tesoura. Você não ganhou nenhum ponto.<br><img src="tesoura.png" alt="Tesoura">    vs    <img src="tesoura.png" alt="Tesoura">';

                $jogo = "Jokenpô";
                $pontosPartida = 0;
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
        }

}
else 
{
    echo "<p>Deu ruim no jogo.</p>";
}

mysqli_close ($con);
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>