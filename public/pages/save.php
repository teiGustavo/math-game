<?php

require dirname(__DIR__, 2) . "/vendor/autoload.php";

use MathGame\Models\Game;

if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];

    $game = (new Game())->find("nome = :nome", "nome=$nome")->fetch();

    $game->acertos = $_POST['acertos'];

    $game->save();
}
