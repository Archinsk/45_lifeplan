<?php //Добавление категории с список категорий пользователя

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
  $category = R::dispense('categories');
    $category->userid = $request['userid'];
    $category->login = $request['user_name'];
    $category->name = $request['name'];  
    $category->iconid = $request['iconid'];
    $category->icon = $request['icon'];
    $category->colorid = $request['colorid'];
    $category->color = $request['color'];
  $categoryId = R::store($category);
  
  // Поиск (по началу строки) и присвоение категории в ранее созданных заданиях пользователя
  if ( isset( $request['search']) ) {
	$tasks = R::find('tasks', 'userid = ?', array($request['userid']));
    foreach( $tasks as $task ) {
      $hasCategory = strpos($task->task, $request['name']);
      if ($hasCategory === 0) {
	    $task->categoryid = $categoryId;
		R::store($task);
      };
    };
  };
    
  //Формирование ответа
  $categoryResponse = array(
    'id' => $categoryId,
    'name' => $request['name'],
    'iconid' => $request['iconid'],
    'icon' => $request['icon'],
    'colorid' => $request['colorid'],
    'color' => $request['color']
  );
  $response = array(
    'category' => $categoryResponse
  );

  //Отправка JSON-ответа
  echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>