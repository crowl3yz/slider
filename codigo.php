<?php
$pdo = new PDO('mysql:host=localhost;dbname=CMS;charset=utf8mb4;port=3306', 'root', 'password');//pdo conn
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); // For MYSQL error dumping

$stmt = $pdo->prepare("
	SELECT *

	FROM cms_news_slider 

	ORDER BY ID ASC
"); #rpeapred statement
$stmt->execute(); //run the query
$newsSlider = $stmt->fetchAll(PDO::FETCH_ASSOC);//store data from DB in ASSOC values

foreach ($newsSlider AS $k => $v){ //loop though array
	//set var
	$title = $v['title'];
	$image = $v['image'];

	//echo responses
	print("title=$title </br>");
	print("image=$image </br>");
}
?>