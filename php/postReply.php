<?php
	require '../forum/config.php';
	if (empty($_POST['message']) || empty($_POST['username']) === true) {
	    $errors[] = 'Error: You must enter a reply message and/or an email.';
	    header('Location: ' . $_SERVER['HTTP_REFERER']. '?error');
	} else {
	    //insert the reply into the database.
		$message = htmlentities($_POST['message']);
		$username = htmlentities($_POST['username']);
		$topicid = htmlentities($_POST['topicid']);
	    $whatforum = htmlentities($_POST['forum_']);
	    $created = date('Y-m-d H:i:s');

		$insert_reply = $forums->addReply($message,$username,$topicid,$whatforum,$created);
	    //$forumpost_update = $forums->updatelastPost($username,$whatforum);
	    //$topicreply_update = $forums->updatelastReply($username,$topicid);
	    echo 'You have created a reply!';
	    header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>