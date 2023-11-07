<?php
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Gteixeira\MathExpressionGenerator\QuestionsGenerator;
use MathGame\Models\Game;

$generator = QuestionsGenerator::generate(15);

if (empty($_POST)) {
    header("Location: ../../index.php");
}

if (isset($_POST)) {
    foreach ($_POST as $post) {
        if (empty($post) || $post == '') {
            header("Location: ../../index.php");
        }
    }

    $game = (new Game());
    $game->nome = $_POST['nome'];
    $game->email = $_POST['email'];
    $game->telefone = $_POST['telefone'];

    $find = (new Game())->find('nome = :nome', "nome=$game->nome")->count();

    if ($find == 0) {
        $game->save();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Game | Math Game</title>
</head>
<body style="display: flex; justify-content: center; height: max-content; align-content: center" class="bg-dark">
    <div class="game bg-dark shadow text-light">
        <form method="POST">
            <?php
            // Iniciando o Jogo
            echo "<p style='text-align: center'>Bem-vindo ao Math Game!</p>";
            echo "<br>";

            // Jogabilidade
            echo "<div style='text-align: start;'>";
            foreach ($generator->questions as $number => $question) {
                $questionNumber = $number + 1;

                include "fragments/question.php";
            }
            echo "</div>";
            ?>

            <button type="button" id="btnClear" class="botao" style="margin-top: 25px;">LIMPAR</button>
            <button type="submit" id="btnSubmit" name="submit" class="botao d-none" style="margin-top: 25px;">CORRIGIR</button>

            <button type="button" id="btnShow" class="botao d-none" data-bs-target="#modal"
                    style="margin-top: 25px;" data-bs-toggle="modal">EXIBIR CORREÇÃO</button>
        </form>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" id="btnModal" data-bs-toggle="modal"
            data-bs-target="#modal"> Launch demo modal </button>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
         data-bs-theme="light">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Resultado:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="questions">
                        <?php foreach ($generator->questions as $number => $question):
                            ?>

                            <p><?= ($number + 1); ?>) <?= $question->solved; ?></p>

                        <?php endforeach; ?>
                    </div>

                    <p id="correctly" style="margin-top: 35px;"></p>
                    <p id="media"></p>
                    <p id="reward"></p>

                    <input type="hidden" id="nome" value="<?= $game->nome; ?>">
                </div>

                <div class="modal-footer align-self-center">
                    <button type="button" class="btn btn-primary d-none" data-bs-dismiss="modal" disabled>Jogar Novamente</button>
                    <button type="button" class="btn btn-primary" id="btnNewGame">Iniciar Novo Jogo</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/mathgame.js"></script>
</body>
</html>