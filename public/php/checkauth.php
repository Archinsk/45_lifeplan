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

//Запуск сессии
session_start();

// echo '--------------------------';
// var_dump($_SESSION);
// echo '--------------------------';

if ( isset($_SESSION['auth_user_id']) ) {
  //Чтение идентификатора зарегистрированного пользователя
  $userDB = R::findOne('users', 'id = 1', array($_SESSION['auth_user_id']) );
  if ( $userDB ) {
      $user = array(
	    'id' => $userDB->id,
	    'name' => $userDB->login,
	  );    
      $response = array(
	    'user' => $user
      ); 
	  $_SESSION['auth_user_name'] = $userDB->login;
  } else {
    $error = array(
	  'id' => '8',
	  'type' => 'auth',
	  'errorText' => 'Пользователь не авторизован'
	);
	$response = array(
	  'error' => $error
	);
  };
  
  //Отправка JSON-ответа
  echo json_encode($response, JSON_UNESCAPED_UNICODE);
};
?>