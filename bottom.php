<div id="bottom">
    <?php 
        //header('Content-Type: text/html; charset=utf-8');
        if (isset($_SESSION['user_session'])) { 
            $user_id = $_SESSION['user_session'];
            $stmt = $activeDB->runQuery("SELECT * FROM users WHERE user_id=:user_id");
            $stmt->execute(array(":user_id"=>$user_id));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            $name = explode(' ',trim($userRow['user_name']))[0];

            $user_db_id = $userRow['user_id'];
    ?>
        <div class="head_login">
            <span>Hello, 
                <strong><?php echo $name ?></strong>
            </span>
            <img src="http://graph.facebook.com/<?php echo $userRow['user_logger'] ?>/picture?width=150&height=150" />
            <div class="user_area">
                <a href="/allfunz/profile">Profile page</a>
                <a href="/allfunz/logout.php?logout=true">Sair</a>
            </div>
        </div>
        
    <?php } ?>
</div>