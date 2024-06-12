<?php
class Code
{
    public string $htmlCode;
    public string $jsCode;
    public string $cssCode;
    public string $name;
    public string $description;
    public function __construct(int $id)
    {
        if ($id == -1) {
            return;
        }
        // Підключення до бази даних
        $db = new SQLite3('../SQL/users.db');

        // Перевірка підключення
        if (!$db) {
            die("Помилка підключення до бази даних");
        }

        // Запит на отримання даних з таблиці Code
        $sql = "SELECT code_name, code_description, html_code, js_code, css_code FROM Code WHERE code_id = $id";
        $result = $db->query($sql);

        if ($result) {
            // Отримання першого рядка результату запиту
            $row = $result->fetchArray(SQLITE3_ASSOC);

            // Заповнення полів об'єкту з отриманих даних
            $this->htmlCode = $row['html_code'];
            $this->jsCode = $row['js_code'];
            $this->cssCode = $row['css_code'];
            $this->name = $row['code_name'];
            $this->description = $row['code_description'];
        }

        // Закриття підключення до бази даних
        $db->close();
        $this->print();
    }
    private function print()
    {
        echo "name=" . $this->name;
        echo "description=" . $this->description;
        echo "htmlCode=" . $this->htmlCode;
        echo "jsCode=" . $this->jsCode;
        echo "cssCode=" . $this->cssCode;
    }
    public function Insert()
    {
        // $this->print();
        $db = new SQLite3('../SQL/users.db');
        if (!$db) {
            die("Помилка підключення до бази даних");
        }
        $query = $db->prepare("INSERT INTO Code(html_code, js_code, css_code, code_name, code_description) 
        VALUES (:htmlCode, :jsCode, :cssCode, :name, :description)");

        $query->bindParam(':htmlCode', $this->htmlCode);
        $query->bindParam(':jsCode', $this->jsCode);
        $query->bindParam(':cssCode', $this->cssCode);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':description', $this->description);

        $result = $query->execute();

        if ($result) {
            echo "Дані були успішно вставлені в базу даних.";
        } else {
            echo "Помилка при вставці даних в базу даних.";
        }
    }
}
