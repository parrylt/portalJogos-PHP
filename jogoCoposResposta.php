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
      <a href='jogoCopos.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaJogarDeNovo'>Jogar de Novo</button></a></div>";
    }
    else {
      echo "<div style='font: 10px sans-serif; background-color: dark; color: white; text-align: center; justify-content: center; 
      z-Index: 5; display: flex; align-items: center;'><h6 class='boasVindas'>Boas-vindas, <br/>" . $email ."</h6>
      <a href='index.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaHome'>Home</button></a><br>
      <a href='jogoCopos.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaJogarDeNovo'>Jogar de Novo</button></a>
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
    <title>Jogo dos Três Copos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
    </head>

    <style>    
      body{ 
        font-family: 'Press Start 2P', cursive;
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

      img {

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

<body>
    <h1>Resultado:</h1>
    <video class="fundo-video" src="./lines.mp4" autoplay muted loop></video>
    
    <?php

if (isset($_POST['escolha']))
{
        $escolhaUsuario = $_POST['escolha'];
        

        $opcoes = ["copo1", "copo2", "copo3"];
        $escolhaComputador = $opcoes[array_rand($opcoes)];
        

        if ($escolhaUsuario == $escolhaComputador)
        {
                echo 'Você encontrou a bolinha. Parabéns. Você ganhou um ponto.<br>';

                    if ($escolhaUsuario == "copo1")
                    {
                        echo '<img src="copoBola1.png" alt="Copo com Bola">';
                    }
                    elseif ($escolhaUsuario == "copo2")
                    {
                        echo '<img src="copoBola2.png" alt="Copo com Bola">';
                    }
                    elseif ($escolhaUsuario == "copo3")
                    {
                        echo '<img src="copoBola3.png" alt="Copo com Bola">';
                    }

                $jogo = "Jogo dos Três Copos";
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

                    }
                    else
                    {
                        $sqlEntrada = "INSERT INTO pontos_jogos (fk_usuario, nome_jogo, pontos) VALUES (?, ?, ?)";
                        $entra = $con->prepare($sqlEntrada);
                        $entra->bind_param("ssi", $email, $jogo, $pontosPartida);
                        $entra->execute();
                    }
    }
    else
    {
        echo 'Você não encontrou a bolinha. Você perdeu um ponto.<br>';

            if ($escolhaUsuario == "copo1")
            {
                echo '<img src="copoSemBola1.png" alt="Copo sem Bola">';
            }
            elseif ($escolhaUsuario == "copo2")
            {
                echo '<img src="copoSemBola2.png" alt="Copo sem Bola">';
            }
            elseif ($escolhaUsuario == "copo3")
            {
                echo '<img src="copoSemBola3.png" alt="Copo sem Bola">';
            }

        $jogo = "Jogo dos Três Copos";
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

            }
            else
            {
                $sqlEntrada = "INSERT INTO pontos_jogos (fk_usuario, nome_jogo, pontos) VALUES (?, ?, ?)";
                $entra = $con->prepare($sqlEntrada);
                $entra->bind_param("ssi", $email, $jogo, $pontosPartida);
                $entra->execute();

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