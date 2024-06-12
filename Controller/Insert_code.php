<?php
require "../Model/Code.php";

// Отримати дані з полів вводу
$htmlCode = $_POST['htmlCode'];
$jsCode = $_POST['jsCode'];
$cssCode = $_POST['cssCode'];
$name = $_POST['codeName'];
$description = $_POST['codeDescription'];

// Створити новий об'єкт класу Code
$code = new Code(-1);
$code->htmlCode = $htmlCode;
$code->jsCode = $jsCode;
$code->cssCode = $cssCode;
$code->name = $name;
$code->description = $description;

// Викликати метод Insert()
$code->Insert();

// Відправити успішну відповідь
echo "Дані були успішно вставлені в базу даних.";
