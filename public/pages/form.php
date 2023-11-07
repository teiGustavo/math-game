<?php

$answers = [];

if (isset($_POST['answers'])) {
    $answers = $_POST['answers'];
}

$solves = $_POST['solves'];

$solved = [];

for ($i = 0; $i < sizeof($answers); $i++) {
    $solved[$i] = 0;

    if ($answers[$i] == $solves[$i]) {
        $solved[$i] = 1;
    }
}

echo json_encode($solved);