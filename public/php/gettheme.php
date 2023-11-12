<?php //Проверка авторизации пользователя в сессии

//Сначала разрешим принимать и отправлять запросы на сервер А
header('Access-Control-Allow-Origin: *');
//Установим типы запросов, которые следует разрешить (все неуказанные будут отклоняться)
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
//Разрешим передавать Cookie и Authorization заголовки для указанновго в Origin домена
header('Access-Control-Allow-Credentials: true');
//Установим заголовки, которые можно будет обрабатывать
header('Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Accept, X-PINGOTHER, Content-Type');

//Подключение RedBeanPHP и БД
require 'db.php';

//Парсинг входящего JSON'а
$request = json_decode(file_get_contents('php://input'), true);
$theme = null;
$themeId = null;

// echo '--------------------------';
// var_dump($_SESSION);
// echo '--------------------------';

if ( isset($request) ) {
  //Чтение идентификатора зарегистрированного пользователя
  $theme = R::load('themes', $request['userid']);
  
  //Формирование ответа
  $response = array(
    'theme' => $theme
  );

  //Отправка JSON-ответа
  echo json_encode($response, JSON_UNESCAPED_UNICODE);
};
?>