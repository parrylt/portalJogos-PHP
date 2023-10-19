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
    <title>Jogo dos Três Copos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
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

        .titulo{
            font-family: 'Press Start 2P', cursive;
            color: aliceblue;
            margin-top: 7%;
        }

        .subTitulo{
            font-family: 'Press Start 2P', cursive;
            color: aliceblue;
            margin-top: 5%;
        }

        Img:hover {
            cursor: pointer;
        }

        #copo1{
            position: absolute; 
            top: 50%; 
            left: 30%;
            transform: translate (-50%, -50%);
        }

        #copo2{
            position: absolute; 
            top: 50%; 
            left: 45%;
            transform: translate (-50%, -50%);
        }

        #copo3{
            position: absolute; 
            top: 50%; 
            left: 60%;
            transform: translate (-50%, -50%);
        }
    
    </style>

<body>

    <div class="global">
    <h1 class="titulo">JOGO DOS TRÊS COPOS</h1>
    <div class="resultado">
    <p class="subTitulo">Adivinhe onde está escondida a bolinha.</p>
    <img src="copo1.png" id="copo1" alt="Copo Vermelho">
    <img src="copo2.png" id="copo2" alt="Copo Vermelho">
    <img src="copo3.png" id="copo3" alt="Copo Vermelho">


<script>
        function escolhaCopo(escolha) {

            var formulario = document.createElement("form");
            formulario.setAttribute("method", "post");
            formulario.setAttribute("action", "jogoCoposResposta.php");
            

            var campoEscolha = document.createElement("input");
            campoEscolha.setAttribute("type", "hidden");
            campoEscolha.setAttribute("name", "escolha");
            campoEscolha.setAttribute("value", escolha);
            

            formulario.appendChild(campoEscolha);
            

            document.body.appendChild(formulario);
            formulario.submit();
        }
        

        document.getElementById("copo1").addEventListener("click", function() {
            escolhaCopo("copo1");
        });
        
        document.getElementById("copo2").addEventListener("click", function() {
            escolhaCopo("copo2");
        });
        
        document.getElementById("copo3").addEventListener("click", function() {
            escolhaCopo("copo3");
        });
</script>



    <video class="fundo-video" src="./lines.mp4" autoplay muted loop></video>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>