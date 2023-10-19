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

    $con = mysqli_connect ($host, $user, $pass, $base);


    if ($con->connect_error) {
        die("Erro na conexão com o banco de dados: " . $con->connect_error);
    }
    else
    {

        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmar_senha = $_POST['confirmar_senha'];

        $emailExistente = "SELECT id_user FROM usuarios WHERE usuario = '$email'";
        $result = $con->query($emailExistente);


        if ($result->num_rows > 0)
        {
            header("Location: cadastro.php?erro=6");
            exit;  
        }

            if (strlen($senha) < 8) {
                header("Location: cadastro.php?erro=1");
                exit;    
            } 
            else
            {
                if (!preg_match("/[0-9]/", $senha)) {
                header("Location: cadastro.php?erro=2");
                exit;                
                } 
                else
                {
                    if (!preg_match("/[A-Z]/", $senha) || !preg_match("/[a-z]/", $senha))
                    {
                        header("Location: cadastro.php?erro=3");
                        exit;   
                    } 
                    else
                    {
                        if (!preg_match("/[!@#\$%^&*()\-_=+{};:,<.>]/", $senha)) 
                        {
                            header("Location: cadastro.php?erro=4");
                            exit;   
                        }
                    }
                }
            }

            if ($senha !== $confirmar_senha)
            {
                header("Location: cadastro.php?erro=5");
                exit;  
            } 

            
            if ($emailErro == "" && $senhaIgualErro == "") {
                $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

                $consulta = $con->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
                $consulta->bind_param("ss", $email, $senha);
                if ($consulta->execute()) {
                    header("Location: index.php?sucessoCad=1");                  
                    exit;
                } else {
                    echo "Erro ao cadastrar o usuário: " . $consulta->error;
                }
            }
            

    $con->close();
    }
?>