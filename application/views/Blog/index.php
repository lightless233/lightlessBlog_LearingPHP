
<?php 
	//echo $this->session->userdata('username');
	$logouturl = base_url('blog/logout');
	$adminurl = base_url('blog/admin');
	$createurl = base_url('blog/create');
	$deleteArticleurl = base_url('blog/delete');
	$editArticleurl = base_url('blog/edit');

	if (($this->session->userdata('username')) === 'lightless') 
	{
		
		echo "<div align=right style='color:red'>Welcome back, lightless.</div>";
		echo "<div align=right style='color:blue'>";
		echo "<a href=$createurl>[Create New Article]</a>"."	"."<a href=$logouturl >[Exit]</a></div>";
	}
	else 
	{
		echo "<div align=right><a href=$adminurl >[Admin Login]</a></div>";
	}
?>

<br />
<br />

<?php $i = 0; ?>
<?php foreach ($articles as $articles_item): ?>
	<h2><a href=<?php echo base_url('blog/showArt')?><?php echo '/'.$articles_item['ArticleID']?>>
	<?php echo $articles_item['ArticleTitle'] ?></a>
	[Comments:<?php echo $articles_item['CommentsNumber']?>]</h2>
	<?php if (isset($this->session->userdata['username']) && $this->session->userdata['username'] === 'lightless') {
		echo "	<div style='color:blue'><a href=$deleteArticleurl/".$articles_item['ArticleID'].">[Delete]</a>	<a href=$editArticleurl/".$articles_item['ArticleID'].">[Edit]</a> </div>";
	}?>
	<h3>Publish date:<?php echo $articles_item['PublishDate'] ?></h3><br />

	<?php echo $articles_item['ArticleContent']?>
	<hr>
<?php $i++ ?>
<?php endforeach ?>

<br />
<br />