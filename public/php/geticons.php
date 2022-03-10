<?php //Авторизация пользователя

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

//Чтение записей
$iconsDB = R::findAll( 'icons' );

//Сборка массива иконок
$icons = array();
foreach( $iconsDB as $iconitem) {
  $icon = array(
	  'id' => $iconitem->id,
	  'name' => $iconitem->name,
	  'icon' => $iconitem->icon,
	  'type' => $iconitem->type,
	  'rating' => $iconitem->rating,
	);
	array_push($icons, $icon);
};

$response = array(
  'icons' => $icons
);

// Отправка JSON-ответа
echo json_encode($response, JSON_UNESCAPED_UNICODE);

// echo '<pre>';
// var_dump($response);
// echo '</pre>';

?>
