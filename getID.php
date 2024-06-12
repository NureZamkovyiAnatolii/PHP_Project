<?php
 session_start();
 // Підключення до бази даних SQLite3
 $db = new SQLite3('SQL/users.db');
 //echo isset($_SESSION['user_id']);
 if (isset($_SESSION['user_id'])) {
   // Отримання даних з форми коментарів
   $user_id = $_SESSION['user_id'];
   echo $user_id;
 } 
 else{
  echo -1;
 }
 // Закриття з'єднання з базою даних
 $db->close();
