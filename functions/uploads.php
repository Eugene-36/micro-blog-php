<?php

function createDirectoryIfNotExist($path){
  if (!is_dir($path)) {
    mkdir($path, 0777, true);
  }
};



function checkPhotoBeforeUpload(){

  global $allowed_file_types, $allowed_extension;

    //Проверка на наличие ошибок при загрузке файла
    if ($_FILES['cover']['error'] !== UPLOAD_ERR_OK) {
      return ["Ошибка при загрузке файла"];
    }

    //Проверка на  типа файла
    $file_type = mime_content_type($_FILES['cover']['tmp_name']);
    if (!in_array($file_type, $allowed_file_types)) {
      return ["Недопустимый тип файла, загрузите png или jpg"];
    }
    //Проверка на расширение файла
    $extension =	pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
    
    if (!in_array(strtolower($extension), $allowed_extension)) {
      return ["Недопустимое расширение файла"];
    }

    // Проверка на размер
    if ($_FILES['cover']['size'] > MAX_UPLOAD_FILE_SIZE) {
      return ['Файл слишком большой. Максимальный размер файла 10МБ'];
    }

    if ($extension === 'jpeg') {
      $extension = 'jpg';
    }
    // Проверка существования директории, если нет то будет создан 
    createDirectoryIfNotExist(ROOT . "data/covers/");

  return true;
};
