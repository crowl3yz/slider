<link rel="stylesheet" href="./web-gallery/static/styles/lightweightmepage.css" type="text/css" />
<script src="./web-gallery/static/js/lightweightmepage.js" type="text/javascript"></script>

<div id="promo-box">
    <div id="promo-bullets"></div>

<?php
require ('config.php');
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
?>

<?php $i = 0; while($news = mysql_fetch_assoc($news1_5)){ $i++; ?>

        <div class="promo-container" style="background-image: url(<?php echo $news['image']; ?>)<?php if($i != '1'){ ?>; display: none<?php } ?>">
            <div class="promo-content-container">
                <div class="promo-content">
                    <div class="title"><?php echo $news['title']; ?></div>
                    <div class="body"><?php echo $news['shortstory']; ?></div>
                </div>
            </div>
            <div class="promo-link-container">
                    <div class="enter-hotel-btn">
                        <div class="open enter-btn">
                            <a style="padding: 0 8px 0 19px;" href="<?php echo $path; ?>/client">Confira &gt;&gt;&gt;</a><b></b>
                        </div>
                    </div>
            </div>
        </div>
        </div><?php } ?>

<script type="text/javascript">    document.observe("dom:loaded", function() { PromoSlideShow.init(); });</script>