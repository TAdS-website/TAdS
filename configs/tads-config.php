<?php
define( 'GROUP_ID', '-478212327');
define( 'BOT_TOKEN', '1471941583:AAF0FbPcdskqPIeiVunQdgxRVCVzOVi036c');
define( 'URL', 'SITE_INDEX_URL');


$conn = mysqli_connect("db_host","db_user","db_password","db_name");
if(!$conn){
    die("Connection Failed : ".mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8');