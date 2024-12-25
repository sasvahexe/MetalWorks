<?php
$host = 'localhost';  // хост
$dbname = 'test_db';  // имя базы данных
$username = 'root';   // имя пользователя
$password = '';       // пароль

try {
    $pdo = new pdo("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
} catch (pdoException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
}
?>
