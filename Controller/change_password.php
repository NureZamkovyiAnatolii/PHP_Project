<?php
session_start();
require "../Model/User.php";
// Підключення до бази даних SQLite3
$db = new SQLite3('../SQl/users.db');
$old = $_POST['old'];
$new = $_POST['new'];
echo $old;
//echo isset($_SESSION['user_id']);
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) {

    $user = new User(" ", " ", $old);
    if ($user->checkPasswordID($db, $_SESSION['user_id'])) {
        $db = new SQLite3("../SQL/users.db");
        $user_id = $_SESSION['user_id'];
        $query = "UPDATE user SET password = :new_password WHERE user_id = :user_id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':new_password', $new, SQLITE3_TEXT);
        $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        if ($result) {
            echo "Пароль оновлено успішно!";
        } else {
            echo "Помилка при оновленні пароля.";
        }
    } else {
        echo "Enter corerct password!";
    }
}
