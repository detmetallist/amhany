<?php
$param1 = $_POST['name'];
$param2 = $_POST['phone']; 
$mail = $_POST['mail'];

$param3=$_POST['mail'];
$param4='Отправка прайс-листа';
if (empty($param1)){ $param1 = 'Нет'; }; 
if (empty($param3)){ $param3 = 'Нет'; }; 
// if (empty($param2)){ die('Введите телефон!'); }; 

require_once('amo.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
$config = array('mail_from' => 'order@AM-PRESENT.RU ', 'mail_to' => array('AMHANI@yandex.ru'));

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$mail = isset($_POST['mail']) ? trim($_POST['mail']) : '';
$soglas = isset($_POST['soglas']) ? trim($_POST['soglas']) : '';
$subject = 'Заявка с сайта';
$source = isset($_POST['utm_source']) ? trim($_POST['utm_source']) : '';
$data = array('name' => $name, 'phone' => $phone, 'utm_source' => $source,);
$vopros = isset($_POST['vopros']) ? trim($_POST['vopros']) : '';
$art = isset($_POST['art']) ? trim($_POST['art']) : '';
$subject .= ' (AM-PRESENT.RU )';

// Функция отправки письма

function send_mail($mail, $subject, $text)
{
    global $config;
    mail($mail, $subject, $text, "From: " . $config['mail_from'] . "\r\n" . "Reply-To: " . $config['mail_from'] . "\r\n" . "Content-type: text/plain; charset=utf-8\r\n" . "X-Mailer: PHP/" . phpversion());
}

// Формируем текст письма

$text = '';
$text .= ($name != '') ? 'Имя: ' . $name . "\r\n" : '';
$text .= ($phone != '') ? 'Телефон: ' . $phone . "\r\n" : '';
$text .= ($mail != '') ? 'e-mail: ' . $mail . "\r\n" : '';
if(!empty($soglas)){$text .= 'Клиент согласен на рассылку'. "\r\n";}
else{$text .= 'Клиент не согласен на рассылку'. "\r\n";}
if(isset($vopros)){$text .= ($vopros != '') ? 'Содержание: ' . $vopros . "\r\n" : '';}
if(isset($art)){$text .= ($art != '') ? 'Артикул товара: ' . $art . "\r\n" : '';}
$text .=  'сайт: AM-PRESENT.RU  ' . "\r\n" . '';
$text .= "\r\n" . 'IP-адрес посетителя: ' . htmlentities($_SERVER['REMOTE_ADDR']) . "\r\n";

$mail_to_count = count($config['mail_to']);

for ($i = 0; $i < $mail_to_count; $i++) {
    send_mail($config['mail_to'][$i], $subject, $text);
}
$picture = "PRAJS_Podarki_Amhani_01_12_2016.xls"; 
 // Если поле выбора вложения не пустое - закачиваем его на сервер 
  $path = 'PRAJS_Podarki_Amhani_01_12_2016.xls'; 
 $thm = 'am-present.ru - прайс лист'; //Тема письма
 $msg = 'am-present.ru - прайс лист'; //Текст сообщения
 $mail_to = $mail; //Адрес получателя

 // Отправляем почтовое сообщение 
 if(empty($picture)) mail($mail_to, $thm, $msg); 
 else send_mail2($mail_to, $thm, $msg, $picture);

 function send_mail2($mail_to, $thema, $msg, $path) { 
 // Вспомогательная функция для отправки почтового сообщения с вложением
 // Параметры - адрес получателя, тема письма, текст письма, путь к загруженному файлу
 if ($path) {  
  $fp = fopen($path,"rb");   
  if (!$fp) { print "Cannot open file"; exit(); }   
  $file = fread($fp, filesize($path));   
  fclose($fp);   
 }  
 $name = basename($path); // в этой переменной надо сформировать имя файла (без пути)  
 $EOL = "\r\n"; // ограничитель строк, некоторые почтовые сервера требуют \n - подобрать опытным путём
 $boundary     = "--".md5(uniqid(time()));  // любая строка, которой не будет ниже в потоке данных.  
 $headers    = "MIME-Version: 1.0;$EOL";   
 $headers   .= "Content-Type: multipart/mixed; boundary=\"$boundary\"$EOL";  
 $headers   .= "From: noreply@am-present.ru";  
 $multipart  = "--$boundary$EOL";
 $multipart .= "------------".$bondary."\nContent-Type:text/html;\n";
 $multipart .= "Content-Transfer-Encoding: 8bit\n\n$msg\n\n";
 $multipart .= $EOL; // раздел между заголовками и телом html-части 
 $multipart .=  "$EOL--$boundary$EOL";   
 $multipart .= "Content-Type: application/octet-stream; name=\"$name\"$EOL";   
 $multipart .= "Content-Transfer-Encoding: base64$EOL";   
 $multipart .= "Content-Disposition: attachment; filename=\"$name\"$EOL";   
 $multipart .= $EOL; // раздел между заголовками и телом прикрепленного файла 
 $multipart .= chunk_split(base64_encode($file));   
 $multipart .= "$EOL--$boundary--$EOL";   
 if (!mail($mail_to, $thema, $multipart, $headers)) { //если не письмо не отправлено
  return false;          
  echo "Письмо не отправлено"; 
 }  
 else { // если письмо отправлено
  return true; 
  echo "Письмо отправлено";
 }  
 exit;  
}

die($subject . '/' . $text);
?>