<?php
/**
 * admin_only_inc.php session protection include for restricting access to administrative areas
 *
 * Checks for AdminID session variable, and forcibly redirects users not logged in
 *
 * @package nmAdmin
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.21 2015/12/07
 * @link http://www.newmanix.com/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * 
 * @see admin_login.php
 * @see admin_dashboard.php 
 * @todo none
 */

startSession(); # wrapper for session_start()
if(!isset($_SESSION['UserID']))
{ //no session var
	$myProtocol = strtolower($_SERVER["SERVER_PROTOCOL"]); # Cascade the http or https of current address
	if(strrpos($myProtocol,"https")>-1){$myProtocol = "https://";}else{$myProtocol = "http://";}
	$myURL = $_SERVER['REQUEST_URI'];  #Path derives properly on Windows & UNIX. alternatives: SCRIPT_URL, PHP_SELF
	$_SESSION['red'] = $myProtocol . $_SERVER['HTTP_HOST'] . $myURL;
    feedback("Your session has timed out.  Please login."); 
	header('Location:' . ADMIN_PATH . 'login.php');
}
?>
