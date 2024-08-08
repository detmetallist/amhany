<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
$picture = "price-list.xlsm"; 
 // Если поле выбора вложения не пустое - закачиваем его на сервер 
  $path = 'price-list.xlsm'; 
 $thm = 'am-present.ru - прайс лист'; //Тема письма
 $msg = 'am-present.ru - прайс лист'; //Текст сообщения
 $mail_to = 'real.oleg@mail.ru'; //Адрес получателя

 // Отправляем почтовое сообщение 
 if(empty($picture)) mail($mail_to, $thm, $msg); 
 else send_mail($mail_to, $thm, $msg, $picture);

 function send_mail($mail_to, $thema, $msg, $path) { 
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
 ?>