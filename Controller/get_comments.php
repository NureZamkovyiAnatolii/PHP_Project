<?php
if (isset($_GET['id'])) {

    // Підключення до бази даних SQLite3
    $db = new SQLite3('../sql/users.db');
    $id = $_GET['id']; // Отримати значення параметра "id" з URL
    // Отримання коментарів з таблиці Comments
    $query = 'SELECT com_text, login FROM Comments, USER WHERE USER.user_id = Comments.user_id AND code_id = :id';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, SQLITE3_INTEGER);
    
    // Виконання запиту
    $result = $stmt->execute();
    // Формування масиву коментарів з іменами користувачів
    $comments = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $comments[] = $row;
    }

    // Виведення результатів
    foreach ($comments as $comment) {
        echo $comment['login'] . ":" . $comment['com_text'] . "\n";
    }
    // Закриття з'єднання з базою даних
    $db->close();
} else {
    // Обробка відсутності параметра "id"
    echo "Параметр 'id' не був переданий в URL.";
}
