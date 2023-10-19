<?php

session_start();


if (isset($_SESSION['email']))
{
    $email = $_SESSION['email'];

    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) 
    {

      echo "<div style='font: 10px sans-serif; background-color: dark; color: white; text-align: center; justify-content: center; 
      z-Index: 5; display: flex; align-items: center;'>

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
    <title>Jokenpô</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
    </head>

<body>

<video class="fundo-video" src="./glitch.mp4" autoplay muted loop></video>

<h1>Jokenpô</h1>
<h4 class="subTitulo1">Jogada contra o computador.</h4>
  <div>
    <h4 class="subTitulo2">Jogue aí o jokenpô. Escolha qual você quer.</h4>
	<br><br>
    <img src="pedra.png" id="pedra" alt="Pedra">
    <img src="papel.png" id="papel" alt="Papel">
    <img src="tesoura.png" id="tesoura" alt="Tesoura">
  </div>


  <script>
        function enviarEscolha(escolha) {

            var formulario = document.createElement("form");
            formulario.setAttribute("method", "post");
            formulario.setAttribute("action", "jokenpoResposta.php");
            

            var campoEscolha = document.createElement("input");
            campoEscolha.setAttribute("type", "hidden");
            campoEscolha.setAttribute("name", "escolha");
            campoEscolha.setAttribute("value", escolha);
            

            formulario.appendChild(campoEscolha);
            

            document.body.appendChild(formulario);
            formulario.submit();
        }
        

        document.getElementById("pedra").addEventListener("click", function() {
            enviarEscolha("Pedra");
        });
        
        document.getElementById("papel").addEventListener("click", function() {
            enviarEscolha("Papel");
        });
        
        document.getElementById("tesoura").addEventListener("click", function() {
            enviarEscolha("Tesoura");
        });
</script>

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

        h1{
            position: absolute; 
            top: 12%; 
            left: 40%;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            font-family: 'Press Start 2P', cursive;
        }

        .subTitulo1{
            position: absolute; 
            top: 25%; 
            left: 28%;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            font-family: 'Press Start 2P', cursive;
        }

        .subTitulo2{
            position: absolute; 
            top: 30%; 
            left: 15%;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            font-family: 'Press Start 2P', cursive;
        }

        Img:hover {
            cursor: pointer;
        }

        #pedra{
            position: absolute; 
            top: 40%; 
            left: 23%;
            transform: translate (-50%, -50%);
            width: 15%;
            height: 45%;
        }

        #papel{
            position: absolute; 
            top: 40%; 
            left: 43%;
            transform: translate (-50%, -50%);
            width: 15%;
            height: 45%;
        }

        #tesoura{
            position: absolute; 
            top: 40%; 
            left: 63.5%;
            transform: translate (-50%, -50%);
            width: 15%;
            height: 45%;
        }

        .boasVindas{
            position: absolute; 
            top: 1%; 
            left: 2%;
            transform: translate (-50%, -50%);
            color: whitesmoke;
            font-family: 'Press Start 2P', cursive;
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

</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>