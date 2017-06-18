<?php include_once 'includes/config.php'; 
if(startSession() && isset($_SESSION['red']) && $_SESSION['red'] != 'admin_logout.php')
{//store redirect to get directly back to originating page
	$red = $_SESSION['red'];
}else{//don't redirect to logout page!
	$red = '';
}#required for redirect back to previous page

//include 'includes/header.php'; #header must appear before any HTML is printed by PHP
echo '
<section class="row">
    <form action="admin_validate.php" method="post">
        <div class="form">
            <h3>Login</h3>
            <div class="row">
                <div class="col-md-12">

                    <div class="input-group form-group">
                        <span class="input-group-addon" id="basic-addon1">@</span>
                        <input type="email" name="Email" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="input-group form-group">
                        <span class="input-group-addon" id="basic-addon1">Password</span>
                        <input type="password" name="Password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" name="Submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    </div>
</section>';
include 'includes/footer.php';
if(isset($_SESSION['red']) && $_SESSION['red'] == 'admin_logout.php')
{#since admin_logout.php uses the session var to pass feedback, kill the session here!
	$_SESSION = array();
	session_destroy();	
}
?>