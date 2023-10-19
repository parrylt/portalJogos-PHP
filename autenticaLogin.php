<?php

session_start();


if (isset($_SESSION['email'])) {
    
    header("Location: index.php?erroLogin=1");
    exit;
}


$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "portal_jogos";

$conn = new mysqli($host, $user, $pass, $base);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sqlAdmin = "SELECT usuario, senha FROM usuarios WHERE usuario = ? AND cad_valido = 1 AND administrador = 1";
    $consulta = $conn->prepare($sqlAdmin);
    $consulta->bind_param("s", $email);
    $consulta->execute();
    $resultAdmin = $consulta->get_result();


    $sql = "SELECT usuario, senha FROM usuarios WHERE usuario = ? AND cad_valido = 1 AND administrador = 0";
    $consulta = $conn->prepare($sql);
    $consulta->bind_param("s", $email);
    $consulta->execute();
    $result = $consulta->get_result();

        if ($resultAdmin->num_rows > 0)
        {
            $row = $resultAdmin->fetch_assoc();
            if (password_verify($senha, $row['senha'])) 
            {

                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['Admin'] = true;
                header("Location: index.php?sucessoLogin=1");
                exit;
            }
            else{
                header("Location: login.php?erro=1");
                exit; 
            }
        }
        elseif ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();
            if (password_verify($senha, $row['senha']))
            {

                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['Admin'] = false;
                header("Location: index.php?sucessoLogin=1");
                exit;
            }
            else{
                header("Location: login.php?erro=1");
                exit; 
            }
        } 
        elseif ($resultAdmin->num_rows == 0 && $result->num_rows == 0)
        {
            header("Location: login.php?erro=1");
            exit;
        }
}

$conn->close();

?>