<?php
session_start();

require_once 'banco.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usr = $_POST['usr'];
    $pwd = $_POST['pwd'];

    // Buscar usuário
    $busca = buscarUsuario($usr);

    if ($busca->num_rows == 0) {
        echo "<br> Usuário não existe";
    } else {    
        $obj = $busca->fetch_object();

        if (password_verify($pwd, $obj->usr_password)) {
            $_SESSION['usr'] = $obj->usr_name; // Corrigido para usr_name
            $_SESSION['usr_id'] = $obj->usr_id; //pegando id para mostrar postagens
            $_SESSION['logged_in'] = true;
            header("Location: index.php");
            exit();
        } else {
            echo "<br> Falha de Login";
        }
    }
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estouro de Pilha Login</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <header>
        <div class="container">
            <h1>Estouro de Pilha</h1>
            <nav>
                <ul>
                    <li>Bem-vindo!</li>
                    <li><a href="index.php">Inicio</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="form">
            <?php require_once 'form-login.php'; ?>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Estouro de Pilha. Todos os direitos reservados.</p>
        </div>
    </footer>
    
</body>
</html>
