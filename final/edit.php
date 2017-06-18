<?php include_once 'includes/config.php'; ?>
    <?php
    include_once 'includes/admin_only_inc.php';
if (isset($_POST['Title']))
{# if Email is set, check for valid data
	$params = array('Title','Text','Link');#required fields
    if(!required_params($params))
    {//abort - required fields not sent
        feedback("Data not entered/updated. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
        header('Location:' . ADMIN_PATH . THIS_PAGE);
        die;	    
    }

	$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));

	$Title = dbIn($_POST['Title'],$iConn);
    $UserID = dbIn($_SESSION["UserID"],$iConn);
    $Text = dbIn($_POST['Text'],$iConn);
    $Link = dbIn($_POST['Link'],$iConn);

	#sprintf() function allows us to filter data by type while inserting DB values.
	$sql = sprintf("INSERT into " . PREFIX . "article (Title,UserID,DatePost,DateUpdate,Text,Link) VALUES ('%s','%s',NOW(),NOW(),'%s','%s')",
            $Title,$UserID,$Text,$Link);
    
    # insert is done here
	@mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));
	
	# feedback success or failure of insert
	if (mysqli_affected_rows($iConn) > 0){
		feedback("Article Added!","notice");
	}else{
	 	feedback("Article NOT Added!", "error");
	}
	header('location: index.php');
}else{
echo '
        <section class="row">
            <form action="' . ADMIN_PATH . THIS_PAGE . '" method="post">
                <div class="formEdit">
                    <h3>Editing</h3>
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1">Title</span>
                                <input type="text" name="Title" class="form-control" placeholder="Title" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1">Link</span>
                                <input type="text" name="Link" class="form-control" placeholder="Link" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="basic-addon1">Article</span>
                                <textarea class="form-control" rows="5" id="editText"  name="Text" placeholder="Use </p><p> between paragraphs" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit"  name="Submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                        <a href="' . ADMIN_PATH . 'admin_logout.php" title="Do not forget to Logout!" class="backButton"><b>Logout</b></a>
        </div>
        </div>
        </div>
        </form>
        </div>
        </section>'; 
} 
include 'includes/footer.php';
