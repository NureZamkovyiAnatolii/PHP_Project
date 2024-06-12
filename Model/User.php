<?php
class User
{
    public string $login;
    protected string $email;
    protected string $password;
    private $cookieName = "UserCookie";
    private string $userType;
    public function __construct(string $e, string $x, string $y)
    {
        $this->_startSession();
        $this->login = $e;
        $this->email = $x;
        $this->password = $y;
    }
    private function validatePassword()
    {
        return true;
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        if (preg_match($pattern, $this->password)) {
            return true;
        } else {
            return false;
        }
    }

    private function _startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function signUp(SQLite3 $db): void
    {
        $p = $this->validatePassword();

        if ($p == 0) {
            echo ("This password is not compext!");
            exit();
        }
        //Password_123


        if ($this->isLoggedIn()) {
            echo "Уже в системе";
            exit();
        } else {
            $p = $this->insert(($db));
            // echo "this->insert((db)=" . $this->insert(($db));
            if ($p == 0) {
                echo ("This email is wrong!");
            } else {
                if ($p == 1) {
                    echo ("This email is already registred!");
                } else {
                    if ($p == 2) {
                        echo ("This login is already registred!");
                    } else {
                        if ($p == 3) {
                            echo "3";
                        }
                    }
                }
            }
        }
    }
    public function checkPasswordPDOEx(PDO $db): bool
    {
        try {
            $stmt = $db->prepare("SELECT password FROM user WHERE login = :login");
            $stmt->execute([':login' => $this->login]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row || !password_verify($this->password, $row['password'])) {
                return false;
            }

            return true;
        } catch (PDOException $e) {
            echo "Error code: " . $db->errorCode() . "\n";
            print_r($db->errorInfo());
            return false;
        }
    }
    public function checkPassword(SQLite3 $db): bool
    {
        $query = "SELECT password FROM user WHERE login = '$this->login';";
        $row = $db->querySingle($query);

        if (!$row) {
            return false;
        }
       // echo ($row) . "\n";
        return password_verify($this->password, $row);
    }
    public function checkPasswordID(SQLite3 $db, int $id): bool
    {
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "SELECT password FROM user WHERE user_id = '$id' AND password = '$hashedPassword';";
        $row = $db->querySingle($query);
        if (!$row) {
            return false;
        }
        return true;
    }
    public function checkPasswordPDO(PDO $pdo): bool
    {
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("SELECT password FROM user WHERE login = :login AND password = :password");
        $stmt->execute([':login' => $this->login, ':password' => $hashedPassword]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false;
        }
        return true;
    }
    public function countChek()
    {
        $user1 = new User(
            $this->login,
            $this->email,
            $this->password
        );
        if (file_exists('count.txt')) {
            $filename = "count.txt";
            $file = fopen($filename, "r+");

            if ($file) {
                while (!feof($file)) {
                    $current_pos = ftell($file);
                    $line = fgets($file);
                    echo $line, ",";
                    $y = strpos($line, ",");
                    $u = strpos($line, $user1->login);
                    $gIndex = strpos($line, "General:");
                    echo $u, ",", $y, ",";
                    if ($gIndex === 0) {
                        $value = substr($line, 9, strlen($line));
                        echo "oldGeneral:", $value;
                        $new_value = (int)$value + 1;
                        $new_line =  str_replace($value, $new_value, $line);
                        echo "new:", $new_line;
                        fseek($file, $current_pos); // Переходим на позицию, где начинается текущая строка в файле
                        fwrite($file, $new_line); // Записываем измененную строку в файл

                    }
                    if ($u === 0) {
                        echo "this" . "<br>";
                        $p = strpos($line, ":");
                        $k = $y;
                        if ($y == false) {
                            $k = strlen($line);
                        }
                        $value = substr($line,  strlen($user1->login) + 1, $k);
                        echo "old:", $value;
                        $new_value = (int)$value + 1;

                        $new_line =  str_replace($value, $new_value, $line);
                        echo "new:", $new_line;
                        fseek($file, $current_pos); // Переходим на позицию, где начинается текущая строка в файле
                        fwrite($file, $new_line); // Записываем измененную строку в файл
                        break;
                    }
                }
            } else {
                echo "not this" . "<br>";
            }
        } else {
            $fil = fopen('count.txt', "w");
            fwrite($fil, 1);
            echo '1';
            fclose($fil);
            return "good";
        }
        $dat = fread($file, filesize('count.txt'));

        fclose($file);
    }
    public function count()
    {
        $user1 = new User(
            $this->login,
            $this->email,
            $this->password
        );
        if (file_exists('../count.txt')) {
            $filename = "../count.txt";
            $file = fopen($filename, "r+");
            if ($file) {
                while (!feof($file)) {
                    $current_pos = ftell($file);
                    $line = fgets($file);
                    $y = strpos($line, ",");
                    $u = strpos($line, $user1->login);
                    $gIndex = strpos($line, "General:");
                    if ($gIndex === 0) {
                        $value = substr($line, 9, strlen($line));
                        $new_value = (int)$value + 1;
                        $new_line =  str_replace($value, $new_value, $line);
                        fseek($file, $current_pos); // Переходим на позицию, где начинается текущая строка в файле
                        fwrite($file, $new_line); // Записываем измененную строку в файл
                    }
                    if ($u === 0) {
                        $p = strpos($line, ":");
                        $k = $y;
                        if ($y == false) {
                            $k = strlen($line);
                        }
                        $value = substr($line,  strlen($user1->login) + 1, $k);
                        $new_value = (int)$value + 1;

                        $new_line =  str_replace($value, $new_value, $line);
                        fseek($file, $current_pos); // Переходим на позицию, где начинается текущая строка в файле
                        fwrite($file, $new_line); // Записываем измененную строку в файл
                        break;
                    }
                }
            } else {
            }
        } else {
            $fil = fopen('count.txt', "w");
            fwrite($fil, 1);
            fclose($fil);
        }

        fclose($file);
    }
    public function enter(string $a)
    {
        if (!isset($_SESSION['counted'])) {
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $uri = $_SERVER['REQUEST_URI'];
            $user = $a;
            $ip = $_SERVER['REMOTE_ADDR'];
            $ref = $_SERVER['HTTP_REFERER'];
            $dtime = date('r');
            if (!$ref) {
                $ref = "Ні";
            }
            if (isset($_SERVER['PHP_AUTH_USER'])) {
                $user = $_SERVER['PHP_AUTH_USER'];
            }
            $entry_line = "\n$dtime - IP: $ip | Agent: $agent | URL: $uri | Referrer: $ref | Username: $user .\n";
            $fp = fopen("../logs.txt", "a");
            fputs($fp, $entry_line);
            fclose($fp);
            $_SESSION['counted'] = true;
        }
    }
    private function checkAccount(SQLite3 $db)
    {
        $pattern = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';

        if (!preg_match($pattern, $this->email)) {
            return 0;
        } else {

            $result = $db->query("SELECT COUNT(*) FROM user WHERE email = '$this->email';");
            $count = $result->fetchArray()[0];
            if ($count > 0) {
                return 1;
            } else {
                $result = $db->query("SELECT COUNT(*) FROM user WHERE login = '$this->login';");
                $count = $result->fetchArray()[0];
                if ($count > 0) {
                    return 2;
                } else {
                    return 3;
                }
            }
        }
    }
    //insert user data to database
    public function insert(SQLite3 $db): int
    {
        //echo "checkAccount=" . $this->checkAccount($db);
        if ($this->checkAccount($db) == 3) {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $db->query("INSERT INTO user( login, email, password)
    VALUES ('$this->login', '$this->email', '$hashedPassword');");
            $this->login($db);
            $file = 'count.txt';
            $new_line = $this->login . ":1\n";
            file_put_contents($file, $new_line, FILE_APPEND);
            return 3;
        } else {
            return $this->checkAccount($db);
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function login(SQLite3 $db)
    {
        $login = $this->login;
        $query = "SELECT user_id FROM USER WHERE LOGIN='$login'";
        $result = $db->querySingle($query);
        if ($result !== false) {
            // Значення user_id успішно знайдено
            $user_id = $result;
            echo $user_id;
            $_SESSION['user_id'] = $user_id;
            $this->_setCookie($user_id);
            $this->count();
            $this->enter($this->login);
            // echo "FE".($_SESSION['user_id']);
        }
    }
    static public function getCookie()
    {
        if (isset($_COOKIE["UserCookie"])) {
            return $_COOKIE["UserCookie"];
        } else {
            return null;
        }
    }
    public static function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        // echo ("You are log out!");
    }
    private function _setCookie($user_id)
    {
        $cookie_value = $user_id . '|' . $this->_generateToken();
        setcookie($this->cookieName, $cookie_value, time() + (86400 * 30), "/");
    }
    private function _generateToken()
    {
        return bin2hex(random_bytes(32));
    }
    private function _unsetCookie()
    {
        setcookie($this->cookieName, "", time() - 3600, "/");
    }
    public function  clone(User $cloned)
    {
        if ($cloned->login != null) {
            $this->login = $cloned->login;
        } else {
            $this->login = "User";
        }
        if ($cloned->password != null) {
            $this->password = $cloned->password;
        } else {
            $this->password = "Password";
        }
    }
}