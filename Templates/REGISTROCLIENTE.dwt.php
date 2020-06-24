<?php require_once('../Connections/TIEND.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO clientes (NOMBRE, APELLIDO, DIRECION, TELEFONO, CORREO, CONTRASENA, perfil) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['NOMBRE'], "text"),
                       GetSQLValueString($_POST['APELLIDO'], "text"),
                       GetSQLValueString($_POST['DIRECION'], "text"),
                       GetSQLValueString($_POST['TELEFONO'], "text"),
                       GetSQLValueString($_POST['CORREO'], "text"),
                       GetSQLValueString($_POST['CONTRASENA'], "text"),
                       GetSQLValueString($_POST['perfil'], "text"));

  mysql_select_db($database_TIEND, $TIEND);
  $Result1 = mysql_query($insertSQL, $TIEND) or die(mysql_error());

  $insertGoTo = "REGISTROEXITOSO.dwt.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">
body {
	background-image: url(../IMAGENES/images.jpg);
}
.s {
	background-color: #FFF;
}
</style>
</head>

<script>
    function subirimagen()
	{
	  self.name = 'opener'; 
	  remote = open('subirimagen.dwt.php', 'remote','width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
	  remote.focus();
	}
    </script>

<body>
<table width="1338" height="722" border="0">
  <tr>
    <th colspan="5" class="s" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="178" height="114">&nbsp;</td>
    <td width="129">&nbsp;</td>
    <td width="419">&nbsp;</td>
    <td width="145"><label></label>&nbsp;</td>
    <td width="295"><a href="ACCESOCLIENTE.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" /></a></td>
  </tr>
  <tr>
    <td height="123">&nbsp;</td>
    <td colspan="3" rowspan="2"><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table width="538" align="center">
        <tr valign="baseline">
          <td width="109" align="right" nowrap="nowrap">NOMBRE:</td>
          <td width="224"><input type="text" name="NOMBRE" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">APELLIDO:</td>
          <td><input type="text" name="APELLIDO" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">DIRECION:</td>
          <td><input type="text" name="DIRECION" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">TELEFONO:</td>
          <td><input type="text" name="TELEFONO" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">CORREO:</td>
          <td><input type="text" name="CORREO" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">CONTRASENA:</td>
          <td><input type="password" name="CONTRASENA" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">FOTO DE PERFILl:</td>
          <td><input type="text" name="perfil" value="" size="32" />
            <input type="button" name="button" id="button" value="subir imagen" onclick="javascrip:subirimagen();" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Insertar registro" />
            <input type="reset" name="borrar" id="borrar" value="Restablecer" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
