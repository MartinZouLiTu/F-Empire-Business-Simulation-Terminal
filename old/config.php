<?php
   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'admin');
   define('DB_PASSWORD', 'picontrol');
   define('DB_DATABASE', 'company');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>