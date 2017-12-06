<?php

require('config.php');
require('classes/Dictionary.php');



if( isset($_POST['lang']) && isset($_POST['word'])) {
  $dictionary = new Dictionary($app_id, $app_key, $url);

  echo $dictionary->suggest($_POST['lang'],$_POST['word'], 10);
}

?>
