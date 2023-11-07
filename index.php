<?php
require __DIR__ . "/vendor/autoload.php";

use MathGame\Models\Game;

$games = (new Game())->find()->order('acertos DESC')->limit(3)->fetch(true);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">

    <title>Página Inicial | Math Game</title>
</head>

<body class="d-flex align-items-center justify-content-center bg-dark" style="height: 100vh;">

    <div class="container-sm d-flex flex-column justify-content-center p-4 shadow"
         style="max-width: 500px; max-height: 800px;">

        <div class="container-sm mb-4">
            <p class="text-light text-center mb-0">Por favor,</p>
            <p class="text-light text-center">Insira seus dados para começar!</p>
        </div>

        <form class="align-items-center d-flex flex-column" id="formNewGame" method="POST"
              action="public/pages/mathgame.php">

            <div class="mb-3 w-75">
                <label for="nome" class="text-light">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Seu nome">
            </div>

            <div class="mb-3 w-75">
                <label for="email" class="text-light">Email:</label>
                 <input type="text" id="email" name="email" class="form-control" placeholder="nome@exemplo.com">
            </div>

            <div class="mb-3 w-75">
                <label for="telefone" class="text-light">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control" placeholder="(32) 9 1234-5678">
            </div>

            <button type="submit" class="btn btn-outline-light mt-3">COMEÇAR</button>
        </form>

    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast d-block" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="public/assets/img/trofeu.svg" class="rounded me-2" style="height: 20px" alt="Troféu">
                <strong class="me-auto">Placar</strong>
            </div>
            <div class="toast-body">
                <p class="text-uppercase">1º: <?= $games[0]->nome ?? 'A Definir!'; ?></p>
                <p class="text-uppercase">2º: <?= $games[1]->nome ?? 'A Definir!'; ?></p>
                <p class="mb-0 text-uppercase">3º: <?= $games[2]->nome ?? 'A Definir!'; ?></p>
            </div>
        </div>
    </div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>