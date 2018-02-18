<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php var_dump($error);  ?>
"At <?php echo $time; ?>"
<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />
<input type="time" name="time" />
<input type="submit" value="upload" />

</form>
</body>
</html>