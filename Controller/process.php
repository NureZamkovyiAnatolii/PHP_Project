<?php

require '../Model/User.php';

$user_email = $_POST['my_html_input_email'];
$user_login = $_POST['my_html_input_login'];
$user_password = $_POST['my_html_input_password'];
$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&-_]{8,}$/';


$user1 = new User($user_login, $user_email, $user_password);
echo ($user_email);
$user1->signUp(new SQLite3('../SQL/users.db'));









// Возвращаем ответ на запрос



  // Получаем значение куки
  //$username = $_COOKIE['username'];
 // echo $username;
 /*
    $u = new User("Kola", "kola@gmail.com", "140140140");
    $t = new User("Anna", "anna@gmail.com", "anna");
    $k = new User("Joonny", "Vart@gmail.com", "111");
    $clone = new User("", "", "");
    $clone->clone($k);
    
    $u->getInfo();
    $clone->getInfo();
    $t->getInfo();
    
    $clone->getInfo();

    $Anatolii = new SuperUser("Anatolii", "zamochek9120@gmail.com", "140140140");
    $Anatolii->character = "adminka";

    $Anatolii->getInfo();
    
    echo $Anatolii->character;

    echo nl2br("\n");
    $Anatolii->getSuperInfo();
    
    //  $conn = new Connection('SQL/users.db');
    // $conn->sqlite_query();
    //get();
    // phpinfo();


    //$ver = SQLite3::version();

    /////echo $ver['versionString'] . "\n";
    //echo $ver['versionNumber'] . "\n";

    //var_dump($ver);}


    
    
    
    /*
    $user1 = new User($user_login, $user_email, $user_password);
$p = $user1->insert(new SQLite3('SQL/users.db'));
if ($p == 1) {
  echo ("This email is already registred!");
}
if ($p == 2) {
  echo ("This login is already registred!");
}
if ($p == 3) {
  echo ("3");
    exit();
  } // Сохраняем хеш в базу данных
      $u = new User("Kola", "kola@gmail.com", "140140140");
    $u->getInfo();
    $t = new User("Anna", "anna@gmail.com", "anna");
    $t->getInfo();
    $clone = new User("", "", "");
    $clone->clone($k);
    $clone->getInfo();
    $Anatolii = new SuperUser("Anatolii", "zamochek9120@gmail.com", "140140140");
    $Anatolii->getInfo();
    $Anatolii->character = "adminka";
    echo $Anatolii->character;

    echo nl2br("\n");
    $Anatolii->getSuperInfo();*/
    //  $conn = new Connection('SQL/users.db');
    // $conn->sqlite_query();
    //get();
    // phpinfo();


    //$ver = SQLite3::version();

    /////echo $ver['versionString'] . "\n";
    //echo $ver['versionNumber'] . "\n";

    //var_dump($ver);
