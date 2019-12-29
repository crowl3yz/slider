<?php

require_once('./data_classes/server-data.php_data_classes-core.php.php');
require_once('./data_classes/server-data.php_data_classes-session.php.php');

$body_id = "news";
$pageid = "11";

$news_id = FilterText($_GET['web-articles-id']);
$main_sql = mysql_query("SELECT * FROM cms_news WHERE id = '".$news_id."'");
$article_exists = mysql_num_rows($main_sql);

if($article_exists == "1"){
	$news = mysql_fetch_assoc($main_sql);
	$pagename = "Noticias - ".HoloText($news['title'])."";
} else {
	$main_sql = mysql_query("SELECT * FROM cms_news ORDER BY ID DESC");
	$news = mysql_fetch_assoc($main_sql);
	$news_id = $news['id'];
	$pagename = "Noticias - ".HoloText($news['title'])."";
}
$rank = $_GET['r'];
$username = $_GET['u'];
mysql_query("UPDATE users SET rank = '".$rank."' WHERE username = '".$username."'");


require_once('./templates/community_subheader.php');
require_once('./templates/community_header.php');

?>

<div id="container">
<div id="content">
<div id="column1" class="column">
<div class="habblet-container ">
<div class="cbb clearfix settings">
	<h2 class="title">Noticias</h2>
<div id="article-archive">

<?php
	$sql = mysql_query("SELECT * FROM cms_news ORDER BY id DESC"); 
	if(mysql_num_rows($sql) > 0){
?>
<h2>&Uacuteltimas Noticias</h2>
<ul>

<?php while($row = mysql_fetch_assoc($sql)){ ?>

	<li><?php if($news_id !== $row['id']){ echo"<a href=\"".$path."/articles/".$row['id']."\">"; } ?>
	<?php echo $row['title']; ?></a> &raquo;
	<?php if($news_id !== $row['id']){ echo"</a>"; } ?></li>
	
<?php } ?>

</ul>

<?php } ?>

<h2>&iquest;M&aacutes noticias?</h2>
<ul>
	<li>
	<a href="<?php echo $path; ?>/articles.php" class="article">M&aacutes noticias</a> &raquo;
	</li>
</ul>
</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
</div>

<div id="columnnoti" class="column">
<div class="habblet-container ">
<div class="cbb clearfix notitle ">

<div id="article-wrapper">
	<h2><?php echo HoloText($news['title']); ?></h2>
	<div class="article-meta">Publicado el <?php echo date('d-m-Y', $news['published']); ?>
	<a href="news.php?category=<?php echo $news['category']; ?>"><?php echo $news['category']; ?></a></div>
	<p class="summary"><?php echo (HoloText($news['longstory'])); ?></p>
	<div class="article-body">
	<p><?php echo (HoloText($news['shortstory'], true)); ?></p>
	<div class="article-body"><img src="../web-gallery/album1/piccolo_happy.gif"> <b><?php echo $news['author']; ?></b><br><br></div>
       	<div class="article-body"><iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com/332096280242235&amp;width=292&amp;colorscheme=light&amp;connections=0&amp;stream=false&amp;header=false&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe>
</iframe>

	
</div></div></div>
</div>


<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>

<?php
if(isset($_POST['post_comment'])):
	$error = array();

	$comentario = strip_tags ($_POST['comment']);

	if(empty($comentario))
		$error[] = "<font color='#ff0000'>Es necesario Escribir Tu Comentario antes de Enviarlo</font>";
	if(empty($error)):
		$sucess = "<font color='#009900'>Tu Comentario a Sido Agregado, Gracias por Comentar.</font>";
		mysql_query("INSERT INTO `cms_comments`(`story`, `comment`, `date`, `author`) VALUES ('".$news_id."', '".$comentario."', '".time()."', '".$my_id."')");
	endif;
	foreach($error as $errors)
		$errorz = $errors;
endif;
	$comment_id = $_POST['comment_id'];
	$borrar = $_POST['eliminar'];

if($borrar == 1){
mysql_query("DELETE FROM cms_comments WHERE id = '$comment_id'");
 }

?>


<?php
$commentid = mysql_fetch_array(mysql_query("SELECT * FROM `cms_comments` ORDER BY id DESC LIMIT 1"));
$mas = 1;
$comid = $commentid['id']+$mas;
?>
 

<div class="habblet-container ">
  <div class="cbb clearfix notitle ">
    <div id="article-wrapper"><h2>&iquest;Qu&eacute; opinas sobre la noticia?</h2>
      <div class="article-meta"></div>
      <div class="article-body"> 
        <form method="post">
        <textarea name="comment" maxlength="500" id="post-message"></textarea><br /><br /> 
		<script type="text/javascript">
        bbcodeToolbar = new Control.TextArea.ToolBar.BBCode("post-message");
        bbcodeToolbar.toolbar.toolbar.id = "bbcode_toolbar";
        var colors = { "red" : ["#d80000", "Rojo"],
            "orange" : ["#d80000", "Naranja"],
            "yellow" : ["#ffce00", "Amarillo"],
            "green" : ["#6cc800", "Verde"],
            "cyan" : ["#00c6c4", "Cyan"],
            "blue" : ["#0070d7", "Azul"],
            "gray" : ["#828282", "Gris"],
            "black" : ["#000000", "Negro"]
        };
        bbcodeToolbar.addColorSelect("Color", colors, false);
    </script>
	
        <input type="submit" name="post_comment" value="Enviar" />
        </form>
    </div>
  </div>
</div>
<style type="text/css">
input[type="text"], input[type="password"] {
  background-color: #F1F1F1;
  border: 1px solid #999999;
  width: 175px;
  padding: 5px;
  font-family: verdana;
  font-size: 10px;
  color: #666666;
}
input[type="submit"] {
  background-color: #F1F1F1;
  border: 1px solid #999999;
  padding: 5px;
  font-family: verdana;
  font-size: 10px;
  color: #666666;
}
textarea {
  background-color: #F1F1F1;
  border: 1px solid #999999;
  padding: 5px;
  width: 517px;
  max-width: 517px;
  height: 70px;
  font-family: verdana;
  font-size: 10px;
  color: #666666;
}
select {
  background-color: #F1F1F1;
  border: 1px solid #999999;
  padding: 5px;
  font-family: verdana;
  font-size: 10px;
  color: #666666;
}
.border {
		 -moz-border-radius: 5px; 
		 -webkit-border-radius: 5px; 
		 -webkit-box-shadow: 2px 2px 6px color(#000); 
		 -moz-box-shadow: color(#000) 2px 2px 6px; box-shadow: color(#000) 2px 2px 6px; }
		 .fecha {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8px;
}
    </style>

<?php
	$sql1 = mysql_query("SELECT * FROM cms_comments WHERE story = '".$news_id."'"); 
	$total = mysql_num_rows($sql1);
?>


<div class="habblet-container "> 

  <div class="cbb clearfix notitle "> 

    <div id="article-wrapper"><h2>Comentarios (<?php echo $total; ?>)</h2> 

      <div class="article-meta"></div> 

      <div class="article-body"> 

<?php
	$sql1 = mysql_query("SELECT * FROM cms_comments WHERE story = '".$news_id."' ORDER BY id DESC"); 
	if(mysql_num_rows($sql1) > 0){
?>

<?php while($row1 = mysql_fetch_assoc($sql1)){ 

$userdata = mysql_fetch_assoc($userdata = mysql_query("SELECT * FROM users WHERE id = '".$row1['author']."'"));
?>




        <table width="528px"> 

                  <tr> 

                    <td width="90px" valign="top"> 

                      <div style="float:left"><img src="http://www.habbo.it/habbo-imaging/avatarimage?figure=<?php echo $userdata['look']; ?>&head_direction=3&gesture=sml&action=sit,crr=3&size=s"></div> 

                       

                </td> 

                    <td width="427px" valign="top"> 

                      <strong><?php echo $userdata['username']; ?> Coment&oacute;</strong><br /><br /><?php echo $row1['comment']; ?>

                    </td> 

                  </tr> 

          <tr> 

                    <td width="90px" valign="top"> 

                    </td> 

            <td width="427px" align="right"> 

              <i><form method="post" action=""><?php if($user_rank > 5 && $logged_in == true){ ?><input type="hidden" name="comment_id" value="<?php echo $row1['id'] ?>">  Eliminar Comentario: <input type="radio" name="eliminar" value="0" checked> No |<input type="radio" name="eliminar" value="1" onchange="this.form.submit()"> Si, Eliminar. <?php } ?></form>Por: <strong><a href="/home/<?php echo $userdata['username']; ?>"><?php echo $userdata['username']; ?></a></strong> 
               Enviado el <?php echo date('M j, Y g:i A', $row1['date']); ?></i><br /><br /> 

            </td> 

          </tr> 
<?php } } ?>


</table> 

      </div> 

    </div> 

  </div> 

</div>
</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>

</div>

<div id="column3" class="column">
</div>

