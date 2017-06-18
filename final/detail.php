<?php include_once 'includes/config.php'; ?>
<?php

//process querystring here
if(isset($_GET['id']))
{//process data
    //cast the data to an integer, for security purposes
    $id = (int)$_GET['id'];
}else{//redirect to safe page
    header('Location:index.php');
}


$sql = "select * from news_article where ArticleID = $id";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        $Title = stripslashes($row['Title']);
        $Category = stripslashes($row['Category']);
        $Day = stripslashes($row['DateUpdate']);
        $Author = stripslashes($row['UserID']);
        $Article = stripslashes($row['Text']);
        $Link = $row['Link'];
        $Feedback = '';//no feedback necessary
    }    

}else{//inform there are no records
    $Feedback = '<p>This News does not exist</p>';
}

    if($Feedback == '')
    {//data exists, show it

        echo '<section class="row detail">
        <article class="col-md-12" id="' . $Category . '">
            <header>
                <h2>' . $Title . '</h2>
                <p>Published on ' . $Day . '</p>';
                echo '<p align="center">';
                echo '<img class="viewupload" src="uploads/stitch' . $id . '.jpg" /> <br/>';
                echo'
            </header>
            <p>' . $Article . '</p>';
            echo '<a href="' . $Link . '"><b><i>Source</i></b></a>';
        echo '</article>
    </section>';
        
    
        
    }else{//warn user no data
        echo $Feedback;
    }    

echo '<a href="index.php" class="backButton">Back to the list</a>';

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);
include 'includes/footer.php'
?>