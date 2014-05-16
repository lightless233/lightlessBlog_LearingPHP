<br /><br />

<?php $articles_item = $articles[0]?>
<?php 
	$e = $articles_item['ArticleID'];
	$editurl = base_url("blog/edit/$e");

	$delurl = base_url("blog/delete/$e");
;?>

<h1 align=center><?php echo $articles_item['ArticleTitle']?></h1>
<h4 align=right>Public time:<?php echo $articles_item['PublishDate']; ?></h4>
<h4 align=right>Last edit time: <?php echo $articles_item['EditDate']?></h4>

<?php 
	// echo $this->session->userdate['session_id'];
	// if ( isset($this->session->userdate['username']) && $this->session->userdate['username'] === 'lightless') 
	// {
	// 	echo "<h4 align=right><a href=$editurl >[EDIT]</a> <a href=$delurl >[DELETE]</a></h4>";
	// }
?>

<br />
<div font=><p><?echo $articles_item['ArticleContent'] ?></p></div>

<br /><br />
<hr>
<br />

<div algin=left><h3>Comments:</h3></div>
<br />

<?php 
	
	for ($i=0; $i < $articles_item['CommentsNumber']; $i++) { 
		echo '#'.$i." - ".$comments[$i]['PublishDate']."		Author:".$comments[$i]['Username']."	Email:".$comments[$i]['UserEmail']."<br />";
		echo $comments[$i]['CommentContent']."<br />"."<hr />"."<br />";

	}
?>

<?php echo validation_errors(); ?> <!-- 报告表单验证中出现的错误信息 -->

<?php $hidden = array('ArticleID' => $articles_item['ArticleID']); ?>
<?php echo form_open('blog/submitcomment', '', $hidden); ?> <!-- 表单辅助函数   -->

<h3>You can submit your comments here</h3>
<label for="name">Name</label><br />
<input type="input" name="name" autocomplete=off style="width:40%;"/><br />

<label for="email">Email</label><br />
<input type="input" name="email" autocomplete=off style="width:40%;"/><br />

<label for="content" algin=center>Content</label><br />
<textarea name="content" style="resize:none;width:40%;height:20%"></textarea><br />
<input type="submit" name="submit" value="submit" />