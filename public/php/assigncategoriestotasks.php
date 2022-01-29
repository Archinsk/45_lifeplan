<?php //Редактирование задания

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

if ( isset($request) ) {
  $categories = R::findAll( 'categories' );
  $tasks = R::findAll( 'tasks' );
  foreach( $tasks as $task) {
    foreach( $categories as $category) {
	  $eq = strpos($task->task, $category->name);
	  if ($eq === 0) {
		// $taskDB = R::load('tasks', $task->id);
		// $taskDB->categoty_id = $category->id;
		$task->category_id = $category->id;
		R::store($task); 
		echo 'T' . $task->id . '-K' . $category->id . '-true;';
	  } 
	} 
  }	  

  // R::store($tasks); 
};

// echo '<pre>';
// var_dump($task);
// echo '</pre>';
echo 'assign categories to tasks comleted';

?>