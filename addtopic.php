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
    $forum = $forums->forumData($_GET['forum']);


  } catch (PDOException $pe) {
    //Error
    die("Could not connect to the database $dbname :" . $pe->getMessage());
  }

?>
<html>
    <!-- Head -->
    <head>
        <title>New topic - <?php echo $forum['article_name']; ?> | AllFunz</title>
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
          </div>
          <div class="report">
            <span>Report</span>
          </div>
          <div class="forumPosts">
            <div class="forumName">New topic</div>
            <?php
              if(empty($_GET['forum']) === true) {
                $errors[] = 'Error: Forum does not exist.';
              } else {
                echo '<form method="post" id="formNew">
                        <span>Title:</span><input type="text" name="title">
                        <span>Message:</span><textarea name="message"></textarea>
                        <input type="submit" name="submit" class="submit" value="Create topic">
                      </form>';
              }

              if (isset($_POST['submit'])) {
                if (empty($_POST['title']) || empty($_POST['message'])) {
                  $errors[] = 'Error: All fields are required to post.';
                  echo '<div class="error">All fields are required to create a topic. Please try again.</div>';
                } else {
                  if (empty($errors) === true) {
                    $username = $user_db_id;
                    $title = htmlentities($_POST['title']);
                    $message = htmlentities($_POST['message']);
                    $whatforum = (int)$_GET['forum'];
                    $created = date('d/m/Y H:i');
                    $forums->addTopic($username,$title,$message,$whatforum,$created);
                    $newtopicid = $dbh->lastInsertId();
                    $newURL = 'topic.php?id='.$newtopicid;
                    header('Location: '.$newURL);
                  }
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








<?php

//submitting the reply.
if (isset($_POST['submit'])) {
  if (empty($_POST['message']) === true) {
      $errors[] = 'Error: You must enter a reply message and/or an email.';
  } else {
    $message = htmlentities($_POST['message']);
    $username = htmlentities($userRow['user_id']);
    $topicid = htmlentities(htmlspecialchars($_GET['id'],ENT_QUOTES));
        $whatforum = htmlentities($topic['forum']);
        $created = date('d/m/Y H:i');
    $insert_reply = $forums->addReply($message,$username,$topicid,$whatforum,$created);
        $forumpost_update = $forums->updatelastPost($username,$whatforum);
        $topicreply_update = $forums->updatelastReply($username,$topicid);
      echo 'You have created a reply!';
  }

}


?>
