<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>

<?php  if((isset($_POST["enviado"])) && ($_POST["enviado"]== "form1")){
            $nombre_archivo = $_FILES['userfile']['name'];
			move_uploaded_file($_FILES['userfile']['tmp_name'],"../IMAGENES/IMG/".$nombre_archivo);
			?>
            <script>
			opener.document.form1.imagen.value="<?php echo  $nombre_archivo; ?>";
			self.close();
            </script>
            <?php
}
else
{?>
<form action="elegirIMG.dwt.php" method="post" enctype="multipart/form-data" id="form1">
  <p>
    <input name="userfile" type="file" size="40" />
    </p>
  <p>
    <input type="submit" name="button" id="button" value="Subir Imagen" />
  </p>
  <input type="hidden" name="enviado" value="form1"/>
</form>
<?php }?>


</body>
</html>
