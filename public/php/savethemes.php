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

//echo '--------------------------';
//var_dump($request);
//echo '--------------------------';

//Запись в БД
if ( isset($request) ) {
	
  //Поиск совпадения начала задания с именем одной из существующих категорий пользователя
  // $categories = R::find('categories', 'userid = ?', array($request['userid']));
  // $categoryid = null;
  // foreach( $categories as $category ) {
    // $hasCategory = strpos($request['task'], $category->name);
    // if ($hasCategory === 0) {
	  // $categoryid = $category->id;
    // }
  // }

  $theme = R::dispense('themes');
    $theme->userid = $request['userid'];
    $theme->themecolors = $request['themecolors'];
	$theme->lightnessmodes = $request['lightnessmodes'];
    $theme->starttimes = $request['starttimes'];
  $id = R::store($theme);
}

//Формирование ответа
// $taskRespose = array(
  // 'id' => $id,
  // 'task' => $request['task'],
  // 'done' => "0",
  // 'creationDate' => $creation_date,
  // 'completionDate' => null,
  // 'categoryid' => $categoryid
// );
// $response = array(
  // 'task' => $taskRespose
// );

//Отправка JSON-ответа
// echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>