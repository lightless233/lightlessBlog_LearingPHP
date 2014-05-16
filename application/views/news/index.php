<?php foreach ($news as $news_item): ?>

	<h2><?php echo $news_item['title'] ?></h2>
	<div id = "main">
		<?php echo $news_item['text'] ?>
	</div>
	<p><a href="http://127.0.0.1/ci/index.php/news/<?php echo $news_item['slug'] ?>">View article</a></p>

<?php endforeach ?>

<br />

<a href="http://127.0.0.1/ci/index.php/news/create">Create news</a>

<br />
<br />