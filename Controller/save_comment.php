<?php
session_start();
// Підключення до бази даних SQLite3
$db = new SQLite3('sql/users.db');
//echo isset($_SESSION['user_id']);
if (isset($_SESSION['user_id']) && $_SESSION['user_id']>0) {
  if (isset($_GET['id']) ) {
    // Отримання даних з форми коментарів
    $user_id = $_SESSION['user_id'];
    $comment = $_POST['comment'];

    // Перевірка та збереження коментаря в базі даних
    $stmt = $db->prepare('INSERT INTO Comments (user_id, com_text,code_id) VALUES (:user_id, :com_text, :code_id)');
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':com_text', $comment);
    $id = $_GET['id']; // Отримати значення параметра "id" з URL
    $stmt->bindValue(':code_id', $id);
    $stmt->execute();

    // Повідомлення про успішне збереження коментаря
    echo 'Коментар успішно збережено!';
  } else {
    // Обробка відсутності параметра "id"
    echo "Параметр 'id' не був переданий в URL.";
  }
} else {
  echo 'Error, please log in to live a comment!';
}

// Закриття з'єднання з базою даних
$db->close();
