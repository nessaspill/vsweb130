<?php
/*config.php - stores app configuration info
*/
//we want to see all errors
define('DEBUG',TRUE); 

define('SECURE',false); #force secure, https, for all site pages

define('PREFIX', 'news_'); #Adds uniqueness to your DB table names.  Limits hackability, naming collisions

//sets default date/timezone for this website
date_default_timezone_set('America/Los_Angeles'); 

define('VIRTUAL_PATH', 'http://nessaspillwebpages.com/web130/assignments/final/');

define('PHYSICAL_PATH', '/home/vanspi1/nessaspillwebpages.com/web130/assignments/final/');


//database credencials - stores database login info
include 'credentials.php';

//stores all unsightly application functions, etc.
include 'common.php';

//loads class that autoloads all classes in include folder
include 'MyAutoLoader.php';

    
//Allows the current page to know it's own name
define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

//force secure website
if (SECURE && $_SERVER['SERVER_PORT'] != 443) {#force HTTPS
	header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}

// Path to PHP include files - INSIDE APPLICATION ROOT
//define('INCLUDE_PATH', PHYSICAL_PATH . 'includes/');

define('ADMIN_PATH', VIRTUAL_PATH); # Could change to sub folder

//buffers our page to be prevent header errors. Call before INC files or ANY html!
ob_start();


//$banner = "My Business";//default banner data
$logo = "Crochet News";

switch(THIS_PAGE)
{
    case "index.php":
        $title = "Crochet News";
        $logo = "Crochet News";
        break;
    
    case "login.php":
        $title = "Crochet News - Login";
        $logo = "Crochet News";
        break;
    
    case "edit.php":
        $title = "Crochet News - Edit Articles";
        $logo = "Crochet News";
        break;
    
    case "detail.php":
        $title = "Crochet News - Article";
        $logo = "Crochet News";
       break;
    
    default:
        $title = THIS_PAGE;
        $logo = "Crochet News";
        break;
}
include 'header.php';

if(startSession() && isset($_SESSION['UserID']))
{#add admin logged in info to sidebar or nav
	$adminWidget = '<li><a href="' . VIRTUAL_PATH . 'edit.php">Author</a></li>';
	$adminWidget .= '<li><a href="' . VIRTUAL_PATH . 'admin_logout.php">LOGOUT</a></li>';
}else{//show login (YOU MAY WANT TO SET TO EMPTY STRING FOR SECURITY)
    $adminWidget = '<li><a href="' . VIRTUAL_PATH . 'login.php">LOGIN</a></li>';
}
