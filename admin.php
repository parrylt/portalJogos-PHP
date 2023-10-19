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
    <a href='logout.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaSair'>Sair</button></a>
    <a href='cadastrados.php'><button class='btn btn-outline-light btn-lg btnAreaCadastrados'>Ver cadastrados</button></a></div>";
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


<?php

require_once "config.php";


$res = mysqli_query ($con, 'SELECT * FROM usuarios WHERE cad_valido = 0;');
$cadastro = mysqli_query ($con, 'SELECT * FROM usuarios WHERE cad_valido = 0');

    if (mysqli_num_rows($cadastro) === 0) 
    {
    echo "<h2 class='titulo'>Nenhum cadastro para ser revisado!</h2>";
    } 
    else
    {
        $pegaCad = "select id_user, usuario FROM usuarios WHERE cad_valido = 0;";
        $tabela = mysqli_query($con, $pegaCad);

        echo '<h2 class="titulo">Você tem cadastro para revisar!<br><br>';

        echo "<div class='table'><table><tr><th>ID do Usuário</th><th>Nome do Usuário</th></tr>";

            while ($escrever = mysqli_fetch_array ($res))
            {
            echo "</td><td>" . $escrever['id_user'] . "</td><td>" . $escrever['usuario'] . "</td></tr>";
            }
        echo '</table></div>';

        echo '<br><h5>Digite o ID do usuário que você gostaria de aceitar ou cancelar:<h5><br>
        <form class="row g-3" method="POST" action="admin3.php">
            <input class="AceitarCad" type="number" name="id" min="1" max="9999999999" placeholder="ID do Usuário..." required><br><br>
        <input  class="btn btn-outline-light btn-lg btnAceitarCad" type="submit" name="aceitar" value="Aceitar Cadastro"><br><br>
        <br>
        
        </form>
        <h5> OU DIGITE O ID PARA DELETAR O USUÁRIO</h5><br>
        <form class="row g-3" method="POST" action="admin2.php">
            <input class="deletarCad" type="number" name="id" min="1" max="9999999999" placeholder="ID do Usuário..." required><br><br>
        <input  class="btn btn-outline-light btn-lg btnDeletarCad" type="submit" name="aceitar" value="Deletar Cadastro"><br><br>
        </form>';
        mysqli_close ($con);
    }

?>


<style>    

      body{ 
          font: 14px sans-serif;
          text-align: center; 
      }
      table {
      padding: 10px;
      border: 1px solid whitesmoke;
      border-collapse: collapse;
      text-align: center;
      color: whitesmoke;
      margin-left: 20rem;
    }
      th,td{
        padding: 10px; 
        justify-content: center;
        border: 1px solid whitesmoke; 
        border-collapse: collapse; 
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

      .btnAreaCadastrados{
        position: absolute; 
        top: 1%; 
        right: 20%;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        font-family: 'Press Start 2P', cursive;
      }

      .aceitarCad{
        font-family: 'Press Start 2P', cursive;
        position: relative;
        transform: translate (-50%, -50%);
        left: 25%;
        width: 25%;
        height: 47px;
        color: black;
        font-size: 20px;
      }

      .btnAceitarCad{
        font-family: 'Press Start 2P', cursive;
        position: relative;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        left: 27%;
        width: 25%;
        height: 15%;
      }

      .deletarCad{
        font-family: 'Press Start 2P', cursive;
        position: relative;
        transform: translate (-50%, -50%);
        left: 25%;
        width: 25%;
        height: 47px;
        color: black;
        font-size: 20px;
      }

      .btnDeletarCad{
        font-family: 'Press Start 2P', cursive;
        position: relative;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        left: 27%;
        width: 25%;
        height: 25%;
        margin-bottom: 5%;
      }

      .titulo{
        font-family: 'Press Start 2P', cursive;
        position: flex;
        transform: translate (-50%, -50%);
        color: whitesmoke;
        margin-top: 8%;
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
      }

      .table{
        position: flex;
        transform: translate (-50%, -50%);
        margin-left: 430px;
        color: whitesmoke;
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

      .btnAreaRanking{
        position: absolute; 
        top: 1%; 
        right: 10.5%;
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
</head>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>