<?php
function fetchCodesFromDB(int $start)
{
    $db = new SQLite3('../SQL/users.db');
    if (!$db) {
        die("Помилка підключення до бази даних");
    }

    // Запит на отримання даних з таблиці Code з використанням параметра
    $sql = "SELECT code_id, code_name, code_description FROM Code WHERE code_id >= $start AND code_id <= $start + 3";

    $result = $db->query($sql);
    if ($result) {
        // Отримання результатів запиту та збереження в масиві
        $codes = array();
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $codes[] = $row;
        }

        return $codes;
    }
    echo "null";
    return null;
}
function fetchLastCodesFromDB()
{
    $db = new SQLite3('../SQL/users.db');
    if (!$db) {
        die("Помилка підключення до бази даних");
    }

    // Запит на отримання даних з таблиці Code з використанням параметра
    $sql = "SELECT MAX(code_id) FROM Code";
    $result = $db->querySingle($sql);
    if ($result) {
        // Отримання результатів запиту та збереження в масиві

        // Перетворення результата на ціле число
        $maxCodeId = intval($result);
        return fetchCodesFromDB($maxCodeId-3);
    }
    echo "null";
    return null;
}
