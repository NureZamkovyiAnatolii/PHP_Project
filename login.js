// Создаем новый объект XMLHttpRequest
var xhr = new XMLHttpRequest();

// Открываем новый запрос на выполнение insert.php
xhr.open('POST', 'process.php', true);

// Устанавливаем заголовок запроса
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

// Обрабатываем ответ сервера
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // Получаем результат из ответа сервера
        var result = this.responseText;
        if(result ==3){
            window.location.href = 'index.html';
            // Выводим результат в консоль
    }
}
};

// Отправляем запрос на выполнение функции insert с параметром 'foo'
xhr.send('function=insert');