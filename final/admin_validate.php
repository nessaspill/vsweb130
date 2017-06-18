<?php
/**
 * admin_validate.php validation page for access to administrative area
 *
 * Processes form data from admin_login.php to process administrator login requests.
 * Forwards user to admin_dashboard.php, upon successful login. 
 * 
 * @package nmAdmin
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.21 2015/12/07
 * @link http://www.newmanix.com/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see admin_login.php
 * @see admin_dashboard.php
 * @todo none
 */

require 'includes/config.php'; #provides configuration, pathing, error handling, db credentials 

if (isset($_POST['Email']) && isset($_POST['Password'])) 
{//if POST is set, prepare to process form data
	//next check for specific issues with data
	if(!ctype_graph($_POST['Password']))
	{//data must be alphanumeric or punctuation only	
		feedback("Illegal characters were entered. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		header('Location:' . ADMIN_PATH . 'login.php');
        die;
	}
	
	if(!onlyEmail($_POST['Email']))
	{//login must be a legal email address only	
		feedback("Illegal characters were entered. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		header('Location:' . ADMIN_PATH . 'login.php');
        die;
	}
	
	$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));

	$Email = dbIn($_POST['Email'],$iConn);
	$MyPass = dbIn($_POST['Password'],$iConn);
    
	$sql = sprintf("select UserID,FirstName,LastName,Email,Password from " . PREFIX . "user WHERE Email='%s' AND Password=SHA('%s')",$Email,$MyPass);

	$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));
	if(mysqli_num_rows($result) > 0) # had to be a match
	{# valid user, create session vars, redirect!
		$row = mysqli_fetch_array($result); #no while statement, should be single record
		startSession(); #wrapper for session_start()
		$UserID = (int)$row["UserID"];  # use (int) cast to for conversion to integer
		$_SESSION["UserID"] = $UserID; # create session variables to identify admin
		$_SESSION["FirstName"] = dbOut($row["FirstName"]);  #use dbOut() to clean strings, replace escaped quotes
		$_SESSION["LastName"] = dbOut($row["LastName"]);
        $_SESSION["Password"] = dbOut($row["Password"]);
		
		if(isset($_SESSION['red']) && $_SESSION['red'] != "")
		{#check to see if we'll be redirecting to a requesting page
			$red = $_SESSION['red']; #redirect back to original page
			$_SESSION['red'] == ''; #clear session var
            @mysqli_free_result($result);
            @mysqli_close($iConn);
			feedback("Login Successful!", "notice");
			header('Location:' . $red);
            die;
		}else{
            # successful login! Redirect to admin page
            feedback("Login Successful!", "notice");
            @mysqli_free_result($result);
            @mysqli_close($iConn);
			header('Location:' . ADMIN_PATH . 'edit.php');
            die;
		} 
         
	}else{# failed login, redirect
	    feedback("Login and/or Password are incorrect.","warning");
        @mysqli_free_result($result);
        @mysqli_close($iConn);
		header('Location:' . ADMIN_PATH . 'login.php');
        die;
	}
}else{//post data not sent
	feedback("Required data not sent. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
	header('Location:' . ADMIN_PATH . 'login.php');
    die;	
}		
?>
