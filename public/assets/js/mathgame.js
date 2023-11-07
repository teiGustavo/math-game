const NUMERO_DE_QUESTOES = 15;
let inputCheckboxSelector = $("input[type='checkbox']");
let checkedCount = 0;
let quantityCorrectly = 0;

$('#btnClear').on('click', function () {
    let divSelector = $('div');

    inputCheckboxSelector.prop('checked', false);

    divSelector.removeClass('error');
    divSelector.removeClass('success');
});

inputCheckboxSelector.on('click', function () {
    if ($(this).is(':checked')) {
        checkedCount++;
    } else if (checkedCount > 0) {
        checkedCount--;
    }

    if (checkedCount === NUMERO_DE_QUESTOES) {
        $('#btnSubmit').removeClass('d-none');
    } else {
        $('#btnSubmit').addClass('d-none');

    }
});

$('#btnNewGame').on('click', function () {
    let nome = $('#nome').val();

    $.ajax({
        url: "save.php",
        method: "POST",
        data: {
            nome: nome,
            acertos: quantityCorrectly
        },
        success: function () {
            window.location.href = '../../index.php';
        }
    });

});

$('form').submit(function (e){
    e.preventDefault();

    let pos = 0;
    let answers = [];
    let solves = [];

    $('input').each(function() {
        if ($(this).is(':checked')) {
            answers[pos] = $(this).val();
            pos += 1;
        }
    });

    $('input[type=hidden]').each(function(i) {
        solves[i] = $(this).val();
    });

    $.ajax({
        url: "form.php",
        method: "POST",
        data: {
            answers: answers,
            solves: solves
        },
        success: function (response) {
            response = response.replace('[', '')
            response = response.replace(']', '')
            response = response.split(',')

            console.log(response);

            for (let i = 0; i < response.length; i++) {
                let question = $("#question-" + (i + 1));

                question.addClass('error');

                if (response[i] === '1') {
                    question.removeClass('error');
                    question.addClass('success');

                    quantityCorrectly += 1;
                }
            }

            $('input').each(function() {
                $(this).prop('disabled', true);
            })

            $('#btnClear').hide();
            $('#btnSubmit').hide();

            $('#btnShow').removeClass('d-none');

            $('#correctly').text('Quantidade de Acertos: ' + quantityCorrectly);

            $('#media').text('Média de Acertos: ' + ((quantityCorrectly / NUMERO_DE_QUESTOES) * 100).toFixed(2) + '%');

            if (quantityCorrectly >= 5 && quantityCorrectly < 9) {
                $('#reward').text('Você ganhou: Três Balas!');
            } else if (quantityCorrectly >= 10 && quantityCorrectly < 15) {
                $('#reward').text('Você ganhou: Um Pirulito!');
            } else if (quantityCorrectly === 15) {
                $('#reward').text('Você ganhou: Um Bombom!');
            } else {
                $('#reward').text('Você não tem direito a prêmios :(');
            }

            $('#btnModal').trigger('click');
        }
    });
});