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
$theme = null;
$themeId = null;

// echo '--------------------------';
// var_dump($request);
// echo '--------------------------';

if ( isset($request) ) {
  global $theme, $themeId;
  
  // Если передан идентификатор темы, то редактируем тему
  if ( isset($request['id']) ) {
	global $theme, $themeId;
	$theme = R::load('themes', $request['id']);
      $theme->toggle_by_time = $request['toggle_by_time'];  
      $theme->primary_color = $request['primary_color'];  
      $theme->primary_lightness = $request['primary_lightness'];  
      $theme->primary_time_start = $request['primary_time_start'];  
      $theme->secondary_color = $request['secondary_color'];  
      $theme->secondary_lightness = $request['secondary_lightness'];  
      $theme->secondary_time_start = $request['secondary_time_start'];  
    $categoryId = R::store($theme);
  // Если идентификатор темы не передан, то создаем тему
  } else {
	global $theme, $themeId;
	$theme = R::dispense('themes');
      $theme->userid = $request['userid'];
      $theme->toggle_by_time = $request['toggle_by_time'];  
      $theme->primary_color = $request['primary_color'];  
      $theme->primary_lightness = $request['primary_lightness'];  
      $theme->primary_time_start = $request['primary_time_start'];  
      $theme->secondary_color = $request['secondary_color'];  
      $theme->secondary_lightness = $request['secondary_lightness'];  
      $theme->secondary_time_start = $request['secondary_time_start'];  
    $themeId = R::store($theme);
  }
   
  //Формирование ответа
  $themeResponse = array(
    'id' => $themeId,
    'toggle_by_time' => $request['toggle_by_time'],
    'primary_color' => $request['primary_color'],
    'primary_lightness' => $request['primary_lightness'],
    'primary_time_start' => $request['primary_time_start'],
    'secondary_color' => $request['secondary_color'],
    'secondary_lightness' => $request['secondary_lightness'],
    'secondary_time_start' => $request['secondary_time_start'],
  );
  $response = array(
    'theme' => $themeResponse
  );

  //Отправка JSON-ответа
  echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>