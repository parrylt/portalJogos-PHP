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
    <a href='index.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaHome'>Home</button></a></h5>
      <a href='logout.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaSair'>Sair</button></a><br>";
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

<style>   

    body{ 
          font-family: 14px 'Press Start 2P', cursive;
          text-align: center; 
      }

    table, td, td{
        position: flex;
        border: 2px solid whitesmoke;
        color: whitesmoke;
        transform: translate (-50%, -50%);
        font-family: 'Press Start 2P', cursive;
        font-size: 25px;
        text-align: center;
        margin-top: 18%;
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

    h5{
        font-family: 'Press Start 2P', cursive;
        position: flex;
        transform: translate (-50%, -50%);
        color: whitesmoke;
      }

    .msg{
        font-family: 'Press Start 2P', cursive;
        position: absolute;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        margin-top: -10%;
        margin-right: 10%;
        margin-left: 10%;
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

    </style>

<?php

require_once "config.php";

        $res = mysqli_query ($con, 'SELECT * FROM usuarios;');
        $pegaCad = "select id_user, usuario, administrador FROM usuarios";
        $tabela = mysqli_query($con, $pegaCad);

        echo " <table><tr><th>ID do Usuário</th><th>Nome do Usuário</th><th>Administrador?</th></tr>";

            while ($escrever = mysqli_fetch_array ($res))
            {
                echo "</td><td>" . $escrever['id_user'] . "</td><td>" . $escrever['usuario'] . "</td><td>";

                if ($escrever['administrador'] == 1) {
                    echo "Sim";
                } else {
                    echo "Não";
                }

                echo "</td></tr>";

            }


    echo "</table>";
    echo "</br></br>";

    $cadastro = mysqli_query ($con, 'SELECT * FROM usuarios WHERE cad_valido = 0');

    if (mysqli_num_rows($cadastro) === 0) 
    {
    echo "<div class='msg'><h3>Nenhum cadastro para ser revisado!</h3></div>";

    } 
    else
    {
        echo "<div class='msg'><h3>Você tem cadastro para revisar!</h3></div>";

    }
mysqli_close ($con);
?>

</body>
</html>