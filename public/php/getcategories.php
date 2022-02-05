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

//Парсинг входящего JSON'а
$request = json_decode(file_get_contents('php://input'), true);

//Чтение записей
$categoriesDB = R::find('categories', 'userid = ? ORDER BY id ASC', array($request['id']));

//Сборка массива заданий
$categories = array();
foreach( $categoriesDB as $categoryitem) {
  $category = array(
	  'id' => $categoryitem->id,
	  'name' => $categoryitem->name,
	  'iconid' => $categoryitem->iconid,
	  'icon' => $categoryitem->icon,
	  'colorid' => $categoryitem->colorid,
	  'color' => $categoryitem->color,
	);
	array_push($categories, $category);
};

$response = array(
  'categories' => $categories
);

// Отправка JSON-ответа
echo json_encode($response, JSON_UNESCAPED_UNICODE);

// echo '<pre>';
// var_dump($response);
// echo '</pre>';

?>
