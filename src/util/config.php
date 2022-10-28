<?php
$this_file = str_replace('\\', '/', __File__);

$doc_root = $_SERVER['DOCUMENT_ROOT'];

$web_root =  str_replace(array($doc_root, "src/util/config.php"), '', $this_file);
$server_root = str_replace ('src/util/config.php' ,'', $this_file);



define('web_root', $web_root); // '/silfersystem_db/'
define('server_root' , $server_root);

