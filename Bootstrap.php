<?php

use Doctrine\Common\ClassLoader;
require_once("Doctrine/Common/ClassLoader.php");
$classLoader = new ClassLoader("WijnshopTest", "scr");
$classLoader->register();

require_once("Libraries/Twig/Autoloader.php"); 
Twig_Autoloader::register(); 
$loader = new Twig_Loader_Filesystem("scr/WijnshopTest/Presentation"); 
$twig = new Twig_Environment($loader);


