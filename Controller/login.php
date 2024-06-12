<?php
require_once('../Model/User.php');

// создаем объект User
$user = new User( $_POST['my_html_input_login'], $_POST['my_html_input_email'], $_POST['my_html_input_password']);
//$message = $user->count();;
//echo "<script>alert('$message');</script>";
// получаем имя пользователя и пароль из POST-запроса
$username = $_POST['my_html_input_login'];
$password = $_POST['my_html_input_password'];
$db = new PDO('sqlite:../SQl/users.db');
//$db = new PDO('sqlite:' . __DIR__ . '/SQL/users.db');
//PDOException: SQLSTATE[HY000]
if (isset($_COOKIE['user'])) {
    // Пользователь авторизован
    // Получаем данные пользователя из куки
    echo json_decode($_COOKIE[$username], true);
    // Дальнейшие действия, например, вывод информации о пользователе
  }
if($user->isLoggedIn()){
    echo "You are logged in!";
    exit();
}
else{
// проверяем имя пользователя и пароль
if ($user->checkPassword(new SQLite3('../SQL/users.db'))) {
    // логин успешный, сохраняем пользователя в сессии и в куки
    $user->login(new SQLite3("../SQl/users.db"));
    $user->enter($_POST['my_html_input_login']);
    echo"3";
   // $user->count();
   // header('Location: index.html');
   // exit();
} else {
    // логин неуспешный, выводим сообщение об ошибке
    echo "Incorrect password or login!";
}}
?>
