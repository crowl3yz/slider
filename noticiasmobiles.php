```

<link rel="stylesheet" href="./web-gallery/static/styles/lightweightmepage.css" type="text/css" />
<script src="./web-gallery/static/js/lightweightmepage.js" type="text/javascript"></script>

<div id="promo-box">
    <div id="promo-bullets"></div>

<?php
require ('config.php');
mysql_select_db('database');
$news1_5 = mysql_query("SELECT * FROM cms_news_slider") or die(mysql_error());
echo("<pre>");print_r($news1_5);die;
?>

<?php
$i = 0;
while($news = mysql_fetch_assoc($news1_5)) {
    $i++;
?>


    <div class="promo-container" style="background-image: url(<?php echo $news['image']; ?>)<?php echo($i != 1 ? 'display: none' : '') ?>">
        <div class="promo-content-container">
            <div class="promo-content">
                <div class="title"><?php echo $news['title']; ?></div>
                <div class="body"><?php echo $news['shortstory']; ?></div>
            </div>
        </div>
        <div class="promo-link-container">        
        </div>
    </div>

<?php } ?>

</div>

<script type="text/javascript">
    document.observe("dom:loaded", function() {
        PromoSlideShow.init();
    });
</script>
```