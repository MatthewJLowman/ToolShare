<?php

$file = $_FILES['file'];

$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];
$fileType = $_FILES['file']['type'];

$fileExt = strtolower(end(explode('.', $fileName)));

$allowed = array('jpg', 'jpeg', 'png', 'webp');

if (in_array($fileExt, $allowed)) {
  if ($fileError === 0) {
    if ($fileSize < 1000000) {
      $fileNameNew = uniqid('', true).".".$fileExt;
      $fileDestination = '../images/'.$fileNameNew;
      move_uploaded_file($fileTmpName, $fileDestination);
    } else {
      $session->message('Your image is too big.');
    }
  } else {
    $session->message('There was an error uploading your image.');
  }
} else {
  $session->message('You cannot upload this type of image.');
  $session->message('Allowed filetypes: jpeg, png, webp');
}

?>