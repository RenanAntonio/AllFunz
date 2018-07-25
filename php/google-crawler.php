<?php
	try {
		//Requires Pages
		require_once("session.php");
		require_once("class.user.php");

		//Consults DataBase
		$activeDB = new USER();

		require('Snoopy.class.php');
		$snoopy = new Snoopy();

		$url = "https://www.bing.com/images/search?&q=robert+de+niro&qft=+filterui:aspect-wide+filterui:imagesize-large&FORM=R5IR3";
		$c = file_get_contents($url);



	} catch (PDOException $pe) {
    	//Error
    	die("Could not connect to the database $dbname :" . $pe->getMessage());
  	}
?>


<html>
	<head>
		<script src="../js/jquery.js"></script>
	</head>
	<body>
		<?php echo $c; ?>
		<script>
			window.aaa = $('#main a.thumb:eq(0)').attr('href');
			return window.aaa;
		</script>
	</body>
</html>