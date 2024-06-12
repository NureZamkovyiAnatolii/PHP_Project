<?php
$files = glob('../images/*');
$maxNumber = 0;
foreach ($files as $file) {
    $fileName = basename($file);
    $fileNumber = intval($fileName);
    if ($fileNumber > $maxNumber) {
        $maxNumber = $fileNumber;
    }
}
$newNumber = $maxNumber + 1;
$newFileName = $newNumber . '.png'; // Замініть '.jpg' на розширення файлу, яке ви використовуєте.
$targetDir = '../images/';
$targetPath = $targetDir . $newFileName;
if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
    // Файл успішно збережено
    echo "Файл успішно збережено з новим ім'ям: " . $newFileName;
} else {
    // Помилка збереження файлу
    echo "Помилка збереження файлу.";
}