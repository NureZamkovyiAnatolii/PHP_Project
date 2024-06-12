<?php
require "../Model/get3Rows.php";
$codesArray = fetchLastCodesFromDB();

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
