<html>
<head>
<?php include 'head.php' ?>
</head>
<body>
<?php include 'nav.php' ?>
<h1>Upload Table</h1>
<?php echo form_open_multipart('home/upload');?>
<div class="container">
<input type="file" name="userfile" size="20" />
</div>
 <button type="submit" class="btn btn-default">Upload</button>
</form>
</body>
</html>
