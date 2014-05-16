<?php echo validation_errors(); ?>
<?php $d = $editinfo[0]['ArticleID']?>
<?php echo form_open("blog/submiteditArt/$d"); ?>

<div style="color:blue"><h1 align=center>Edit article</h1></div>

<h2 align=center>Article Title:</h2>
<div align=center>
<input type="input" name="title" autocomplete=off style="width:40%;height:30px" value=<?php echo $editinfo[0]['ArticleTitle']?> /><br><br>
<h2 align=center >content</h2>
<textarea id="x" type="input" name="content" autocomplete=off style="width:40%;height:150px;resize:none" ></textarea><br><br>
<?php
	$y = $editinfo[0]['ArticleContent'];
	//echo $y;
	echo "<script>document.getElementById('x').value='".$y."'</script>"
?>


<input type="submit" name="submit" value="submit"><br><br> 


</div>