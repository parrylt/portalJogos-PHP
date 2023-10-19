<?php

session_start();

if (isset($_SESSION['email']))
{
    $email = $_SESSION['email'];

    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) 
    {

      echo "<div style='font: 10px sans-serif; background-color: dark; color: white; text-align: center; justify-content: center; 
      z-Index: 5; display: flex; align-items: center;'><h6 class='boasVindas'>Boas-vindas, <br/>" . $email ."</h6>
      <a href='admin.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaAdm'>Área do Administrador</button></a><br>
      <a href='ranking.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaRanking'>Ranking</button></a>
      <a href='logout.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaSair'>Sair</button></a></div>";
    }
    else {
      echo "<div style='font: 10px sans-serif; background-color: dark; color: white; text-align: center; justify-content: center; 
      z-Index: 5; display: flex; align-items: center;'><h6 class='boasVindas'>Boas-vindas, <br/>" . $email ."</h6>
      <a href='ranking.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaRanking'>Ranking</button></a>
      <a href='logout.php'><button type='button' class='btn btn-outline-light btn-lg btnAreaSair'>Sair</button></a></div>";
    }
} 
else 
{
  echo '<div>
  <a href="cadastro.php"><button type="button" class="btn btn-outline-light btn-lg btnAreaCadastro">Cadastro</button></a>
  <a href="login.php"><button type="button" class="btn btn-outline-light btn-lg btnAreaLogin">Login</button></a>
  </div>';
}


if (isset($_GET['sucessoCad']) && $_GET['sucessoCad'] == 1) {
  echo "<div background-color: dark; color: whitesmoke; text-align: center; 
  justify-content: center; z-Index: 5; display: flex; align-items: center;'> <h5 class='CadSucesso'>Cadastro realizado com sucesso! 
  Agora, é só o <br> administrador validar o seu cadastro.</h5></div>";
  echo '<div>
  <a href="cadastro.php"><button type="button" class="btn btn-outline-light btn-lg btnAreaCadastro">Cadastro</button></a>
  <a href="login.php"><button type="button" class="btn btn-outline-light btn-lg btnAreaLogin">Login</button></a>
  </div>';
}  



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Portal de Jogos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&family=Press+Start+2P&family=Sora:wght@600&display=swap" rel="stylesheet">
    
    <style>
        
      body{ 
        font: 14px sans-serif; 
        text-align: center;
        font-size: 14px;
      }
        
      .card-deck{
          position: absolute; 
          width: 80%;
          height: 50%;
          left: 10%;
          top: 20%;
          transform: translate (-50%, -50%);
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

      .boasVindas{
          position: absolute; 
          top: 1%; 
          left: 2%;
          transform: translate (-50%, -50%);
          color: whitesmoke;
          font-family: 'Press Start 2P', cursive;
      }

      .imagem {
          height: 70%;
      }

      .h5{
          position: absolute; 
          top: 1%; 
          left: 2%;
          transform: translate (-50%, -50%);
      }

      .cadSucesso{
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

      .btnAreaSair{
          position: absolute; 
          top: 1%; 
          right: 2%;
          transform: translate (-50%, -50%);
          color: whitesmoke;
          font-family: 'Press Start 2P', cursive;
      }

      .btnAreaCadastro{
          position: absolute; 
          top: 1%; 
          right: 12%;
          transform: translate (-50%, -50%);
          color: whitesmoke;
          font-family: 'Press Start 2P', cursive;
      }

      .btnAreaLogin{
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
          right: 24.2%;
          transform: translate (-50%, -50%);
          color: whitesmoke;
          font-family: 'Press Start 2P', cursive;
      }

      .btnAreaRanking{
          position: absolute; 
          top: 1%; 
          right: 11%;
          transform: translate (-50%, -50%);
          color: whitesmoke;
          font-family: 'Press Start 2P', cursive;
      }

    </style>
</head>

<body>
    <video class="fundo-video" src="./jogo.mp4" autoplay muted loop></video>


    <div class="card-deck">
  <div class="card img1">
    <a href="./adivinhe.php"><img class="card-img-top" src="adivinhe.png" alt="Jogo adivinhe o número"></a>
    <div class="card-body">
      <h7 class="card-title">No jogo "Adivinhe o Número", um jogador pensa em um número e o mantém em segredo. 
        Outro jogador faz suposições sobre qual é o número, e o primeiro jogador responde com dicas, como "maior" 
        ou "menor", indicando se o número pensado é maior ou menor do que a suposição. O segundo jogador continua 
        a fazer suposições até adivinhar corretamente o número ou desistir. O objetivo é adivinhar o número com o 
        menor número possível de tentativas.</h7>
    </div>
  </div>
  <div class="card img2">
    <a href="./jokenpo.php"><img class="card-img-top jokenpo" src="jokenpo.png" alt="Jogo jokenpo"></a>
    <div class="card-body">
      <h7 class="card-title">O jogo "Jokenpô" é jogado por duas pessoas. Cada jogador escolhe uma das três opções: 
        "pedra," "papel," ou "tesoura." Em seguida, ambos revelam suas escolhas simultaneamente. As regras são 
        simples: pedra vence tesoura, tesoura vence papel, e papel vence pedra. O jogador cuja escolha derrota a 
        escolha do oponente vence a rodada. É um jogo de sorte e rapidez, geralmente jogado em melhores de três 
        ou em séries para determinar um vencedor.</h7>
    </div>
  </div>
<div class="card img3">
    <a href="./parOuImpar.php"><img class="card-img-top" src="par-impar.png" alt="Jogo par ou ímpar"></a>
    <div class="card-body">
      <h7 class="card-title">O jogo "Par ou Ímpar" é simples e geralmente jogado por duas pessoas. Cada jogador escolhe 
        entre "par" ou "ímpar". Em seguida, eles fazem uma contagem, geralmente com os dedos, moedas ou qualquer objeto 
        pequeno. Após a contagem, verifica-se se o número total de objetos é par ou ímpar. Se o jogador que escolheu 
        "par" tiver razão sobre o número, ele ganha; caso contrário, o outro jogador 
        vence. É um jogo de sorte e escolha, geralmente usado para tomar decisões simples.</h7>
    </div>
  </div>
  <div class="card img4">
    <a href="./jogoCopos.php"><img class="card-img-top" src="3copos.png" alt="Jogo par ou ímpar"></a>
    <div class="card-body">
      <h7 class="card-title">O jogo dos 3 copos é um truque ou ilusão de mágica em que um jogador esconde uma pequena 
        bola ou objeto sob um dos três copos e, em seguida, os mistura rapidamente. O desafio para o espectador é 
        acompanhar o copo sob o qual o objeto foi escondido e adivinhar onde ele está no final da mistura. O jogo é 
        frequentemente usado por trapaceiros em truques de rua para enganar as pessoas a perderem dinheiro em apostas, 
        já que o jogador trapaceiro é habilidoso em manipular os copos para esconder o objeto de forma enganosa.</h7>
    </div>
  </div>
</div>

<?php
if (isset($_GET['erroLogin']) && $_GET['erroLogin'] == 1) {
    echo "<script> alert ('Erro: Você já está logado.');";
}
if (isset($_GET['erroAdmin']) && $_GET['erroAdmin'] == 1) {
  echo "<script> alert ('Acesso não permitido.');";
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>