<?php //Страница неавторизованного пользователя

//Подключение RedBeanPHP и БД
require 'php/db.php';

//Запуск сессии
session_start();

//Перевод авторизованного пользователя на страницу авторизованного пользователя
if ( isset($_SESSION['logged_user']) ) {
  header('Location: lifeplan_auth.php');
};

include './index.html';
?>