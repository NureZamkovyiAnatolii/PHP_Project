<?php
require "../Model/get3Rows.php";
if (isset($_GET['start'])) {

    $startValue = $_GET['start']; // Отримати значення параметра "id" з URL
    $codesArray = fetchCodesFromDB($startValue);

    // Виведення результатів
    if ($codesArray) {
        foreach ($codesArray as $code) {
            echo "code_id: " . $code['code_id'] . " ";
            echo "code_name: " . $code['code_name'] . " ";
            echo "code_description: " . $code['code_description'] . "\n";
        }
    } else {
        echo "Немає результатів для вказаного значення";
    }
}
else {
    // Обробка відсутності параметра "id"
    echo "Параметр 'start' не був переданий в URL.";
}

