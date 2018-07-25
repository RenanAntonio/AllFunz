<?php
  try {
    //Requires Pages
    require_once("php/session.php");
    require_once("php/class.user.php");

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


  } catch (PDOException $pe) {
    //Error
    die("Could not connect to the database $dbname :" . $pe->getMessage());
  }

?>
<html>
    <!-- Head -->
    <head>
        <title>AllFunz</title>
        <?php include 'head-scripts.html'; ?>
    </head>
    <!-- Head | END -->
    <!-- Body -->
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="leftFixed">
                <div class="posts">
                    <a href="/allfunz/profile">
                        <img src="http://graph.facebook.com/<?php echo $userRow['user_logger'] ?>/picture?width=150&height=150" />
                        <span class="name"><?php echo $userRow['user_name']; ?></span>
                        <span class="moderation">View profile</span>
                    </a>
                    <div class="myPosts">
                        <a href="/allfunz/profile">
                            <span class="titles iconPosts">My Posts</span>
                            <span class="arrow"></span>
                        </a>
                    </div>
                </div>
                <div class="like">
                    <div class="mightLike">
                        <span class="titles iconMight">You Might Like</span>
                    </div>
                    <ul class="likes">
                        <li>Beyoncé</li>
                        <li>Harry Potter and the Chamber of Secret</li>
                        <li>The Wolf of Wall Street</li>
                        <li>Lionel Messi</li>
                        <li>Mortal Kombat X</li>
                        <li>Toy Story 3</li>
                    </ul>
                </div>
                <div class="share">
                    <div class="mightLike">
                        <span class="titles iconShare">Share</span>
                    </div>
                    <ul class="likes">
                        <li>Beyoncé</li>
                        <li>Harry Potter and the Chamber of Secret</li>
                        <li>The Wolf of Wall Street</li>
                    </ul>
                </div>
            </div>
            <div class="rightPosts">
                <div class="recentPost">
                <?php 
                    foreach ($articles as $lines){
                      $name = strtr($lines['article_name'], $normalizeChars);
                      $nameFormatted = clean($name);
                      $currentColor = colorArticle($lines['article_category']);
                      echo '<div class="post">
                                <div class="top">
                                    <a href="article/'.$lines['article_id'].'/'.$nameFormatted.'.html">
                                        <div class="article_img '.$currentColor.'" style="background-image: url('.$lines['article_picture'].');"></div>
                                        <div class="wrap">
                                            <span class="category '.$currentColor.'">'.$lines['article_category'].'</span>
                                            <span class="article">'.$lines['article_name'].'</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="author"><a href="">Renan Antonio</a><span>posted:</span></div>
                                    <div class="message">“Do you guys think Leo should had won the Oscars for best actor instead of Matthew? I personally think Matt did a way better job in Dallas...”</div>
                                    <div class="visit"><a href="article/'.$lines['article_id'].'/'.$nameFormatted.'.html">Visit forum</a></div>
                                </div>
                            </div>';
                    } 
                ?>
                </div>
            </div>
        </div>
  
    <!-- Bottom -->
    <?php
        include 'bottom.php';
    ?>

    <!-- Body | END -->
    </body>
</html>




