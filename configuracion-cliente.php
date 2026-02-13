<?php
if($_SERVER['SERVER_NAME']=='localhost' || $_SERVER['SERVER_NAME']=='127.0.0.1')
{
    define('ROOTURL','http://'.$_SERVER['SERVER_NAME'].'/YG_Amigurumis/');
    define('DOCROOT',$_SERVER['DOCUMENT_ROOT'].'/YG_Amigurumis/');

    define('SITENAME','YG Amigurumis');
    define('AUTOR','Bahia Group');
    define('CSS',ROOTURL.'css/');
    define('JS',ROOTURL.'js/');
    define('IMG',ROOTURL.'Imagenes/');

    define('IMAGES_ORIGEN','http://'.$_SERVER['SERVER_NAME'].'/YG_Amigurumis/admin/');

    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASSWD','');
    define('DBNAME','yg_crochet');

    define('HEADERCLIENTE',DOCROOT.'header-cliente.php');
    define('FOOTERCLIENTE',DOCROOT.'footer-cliente.php');

}

include_once('funciones-cliente.php');
session_start();
ini_set("display_errors","On");
?>