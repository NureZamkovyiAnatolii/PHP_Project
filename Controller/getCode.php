<?php
require '../Model/Code.php';
if (isset($_GET['id'])) {
    $id = $_GET['id']; 

    $code = new Code($id);
} else {
    echo "Параметр 'id' не був переданий в URL.";
}
