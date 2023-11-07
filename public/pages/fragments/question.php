<div id="question-<?= $questionNumber; ?>" style="border-radius: 5px; margin-bottom: 10px">
    <p> QUESTION <?= $questionNumber; ?>: (<?= $question->expression; ?>)</p>

    <?php for ($i = 1; $i <= sizeof($question->answers); $i++):
        ?>

        <div id="answer">
            <input type='checkbox' id="<?= 'answer-' . $i; ?>" name='' class=""
                   value="<?= $question->answers[($i - 1)]; ?>" style='cursor: pointer'>

            <label for='<?= 'answer-' . $i; ?>'> <?= $question->answers[($i - 1)]; ?> </label>
        </div>

    <?php endfor; ?>

    <input type="hidden" id="solved" value="<?= $question->solved; ?>">
</div>
