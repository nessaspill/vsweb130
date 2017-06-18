<?php include 'includes/config.php'; ?>
    <?php
$sql = "select * from news_article order by DateUpdate desc";

//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    $class="col-md-8";
    $size=2;

    $news_in_row = 0;
    while($row = mysqli_fetch_assoc($result))
    {
        echo'<article class="' . $class . '">
            <header>
                <h2>' . $row['Title'] . '</h2>
                <p>Published on ' . $row['DateUpdate'] . '</p>
            </header>';
        echo '<p>' . $row['Text'];
        echo '</p>';
        echo '<a href="detail.php?id=' . (int)$row['ArticleID'] . '">' . dbOut($row['Title']) . '</a>';
        echo '</article>';
        
        $news_in_row += $size;
        if($news_in_row == 3) {
            echo '</section>';
            $news_in_row = 0;
        }
    
        $class="col-md-4";
        $size=1;
    }    
    
}else{//inform there are no records
    echo '<p>There are no articles</p>';
}

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);
include 'includes/footer.php'
?>
