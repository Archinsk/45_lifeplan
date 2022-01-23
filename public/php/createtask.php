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

$user_id = $request['user_id'];
$creation_date = time();

// echo '--------------------------';
// var_dump($request);
// echo '--------------------------';

if ( isset($request) ) {
  $task = R::dispense('tasks');
    $task->login = $request['login'];
    $task->user_id = $user_id;
    $task->task = $request['task'];
    $task->done = false;
    $task->creationDate = $creation_date;
  $id = R::store($task);
}

//Формирование ответа
$taskRespose = array(
  'id' => $id,
  'task' => $request['task'],
  'done' => "0",
  'creationDate' => $creation_date,
  'completionDate' => null,
);
$response = array(
  'task' => $taskRespose
);

// Отправка JSON-ответа
echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>