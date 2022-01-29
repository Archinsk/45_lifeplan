<?php //Добавление задания в список заданий

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

// echo '--------------------------';
// var_dump($request);
// echo '--------------------------';

if ( isset($request) ) {
  foreach( $request as $item) {
	$color = R::dispense('colors');
    $color->name = $item['name'];
    $color->hex_color = $item['hex_color'];
    R::store($color);
  }
}

?>