<?php
  try {
    //Requires Pages
    require_once("php/session.php");
    require_once("php/class.user.php");
    require_once("config.php");

    //Consults DataBase
    $activeDB = new USER();

    //Gets User Info
    if (isset($_SESSION['user_session'])) {
      $user_id = $_SESSION['user_session'];
      $stmt = $activeDB->runQuery("SELECT * FROM users WHERE user_id=:user_id");
      $stmt->execute(array(":user_id"=>$user_id));
      $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    }


    //Collects Topics
    $sql = "SELECT * FROM article";
    $result = $activeDB->runQuery($sql);
    //$rows = $result->fetchAll( PDO::FETCH_ASSOC );
    $result->execute();
    $articles = $result->fetchAll(PDO::FETCH_ASSOC);


    //Collects Topic
    $topic = $forums->topicData($_GET['id']);
    $reply = $forums->replyData($_GET['id']);
    $forum = $forums->forumData($topic['forum']);


  } catch (PDOException $pe) {
    //Error
    die("Could not connect to the database $dbname :" . $pe->getMessage());
  }

?>
<html>
    <!-- Head -->
    <head>
        <title><?php echo $topic['title']; ?> - <?php echo $forum['article_name']; ?> | AllFunz</title>
        <?php include 'head-scripts.html'; ?>
    </head>
    <!-- Head | END -->
    <!-- Body -->
    <body>
        <?php 
            include 'header.php'; 
            $name = strtr($forum['article_name'], $normalizeChars);
            $nameFormatted = clean($name);
        ?>
        <div class="container topic">
            <div class="forumTop">
                <a href="article/<?php echo $forum['article_id'] ?>/<?php echo $nameFormatted ?>.html">
                	<?php
        			$starter = $topic['starter'];
        			$title = $topic['title'];
        			$message = $topic['message'];
        	        $created = str_replace('-', '/', $topic['created']);
        	        $created = str_replace(' ', ' at ', $created);
        			$i = 0;

                	if ($forum['article_category'] === "movies/television") {
                		$catArt = "movies";
                	} else {
                		$catArt = $forum['article_category'];
                	}
                    echo '<div class="article_img '.$catArt.'" style="background-image: url('.$forum['article_picture'].');"></div>
                    	<div class="wrap">
                    	    <span class="category '.$catArt.'">'.$forum['article_category'].'</span>
                    	    <span class="article">'.$forum['article_name'].'</span>
                    	</div>';
                    ?>
                </a>
                <div class="discussion">Discussion</div>
            </div>
            <div class="report">
            	<span>Report</span>
            </div>
            <div class="forumPosts">
            	<div class="forumName"><?php echo $title; ?></div>
            	<ul class="messages">
	            	<li>
	            		<?php
	            		$user = $forums->getUser($starter);
	            		echo '<a href=""><img src="http://graph.facebook.com/'.$user['user_logger'].'/picture?width=150&height=150" /></a>
	            			<div class="group">
		            			<div class="author"><a href="">'.$user['user_name'].'</a><span>'.$created.'</span></div>
		            			<div class="message">'.$message.'</div>
		            		</div>';
	            		?>
	            	</li>
	            	<?php
						foreach ($reply as $replies) {
							++$i;
							$user = $forums->getUser($replies['username']);
				        	$reply_username = $user['user_name'];	
				        	$reply_pic = $user['user_logger'];
				    		$reply_message = $replies['message'];
				        	$created = str_replace(' ', ' at ', $replies['created']);
				        	$whatforum = $replies['forum'];
				    		echo '<li>
				    				<a href=""><img src="http://graph.facebook.com/'.$reply_pic.'/picture?width=150&height=150" /></a>
				    				<div class="group">
				    					<div class="author"><a href="">'.$reply_username.'</a><span>'.$created.'</span></div>
				    					<div class="message">'.$reply_message.'</div>
				    				</div>
				    			</li>';
						}
	            	?>
            	</ul>
            	<div class="pagination">1-2-3</div>
            </div>
            <div class="newMessage">
            	<img src="http://graph.facebook.com/<?php echo $userRow['user_logger'] ?>/picture?width=150&height=150" />
            	<form id="submitReply" method="POST">
            		<textarea class="messageReply" name="message" placeholder="Leave a comment..."></textarea>
            		<input type="hidden" name="topicid" value="'.htmlspecialchars($_GET['id'],ENT_QUOTES).'">
            		<input type="submit" name="submit" value="Add Reply">
            	</form>
            	<div class="submit">Post</div>
                <?php
                //submitting the reply.
                if (isset($_POST['submit'])) {
                    if (empty($_POST['message']) === true) {
                        echo '<div class="error">You have to leave a comment before posting. Please try again.</div>';
                    } else {
                        $message = htmlentities($_POST['message']);
                        $username = htmlentities($userRow['user_id']);
                        $topicid = htmlentities(htmlspecialchars($_GET['id'],ENT_QUOTES));
                        $whatforum = htmlentities($topic['forum']);
                        $created = date('d/m/Y H:i');
                        $insert_reply = $forums->addReply($message,$username,$topicid,$whatforum,$created);
                        $forumpost_update = $forums->updatelastPost($username,$whatforum);
                        $topicreply_update = $forums->updatelastReply($username,$topicid);
                        $newURL = 'topic.php?id='.$_GET['id'];
                        //header('Location: '.$newURL);
                    }
                }
                ?>
            </div>
        </div>

    	<script>
    		$('.newMessage .submit').click(function(){
    			$('#submitReply input[name="submit"]').click();
    		});
    	</script>
  
    <!-- Bottom -->
    <?php
        include 'bottom.php';
    ?>

    <!-- Body | END -->
    </body>
</html>