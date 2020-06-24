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
  $insertSQL = sprintf("INSERT INTO administrador (Nombre, Apellido, Correo, Contrasena, imagen) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Apellido'], "text"),
                       GetSQLValueString($_POST['Correo'], "text"),
                       GetSQLValueString($_POST['Contrasena'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"));

  mysql_select_db($database_TIEND, $TIEND);
  $Result1 = mysql_query($insertSQL, $TIEND) or die(mysql_error());

  $insertGoTo = "MINDEXITOSO.dwt.php";
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
	  remote = open('SUBIRPERFIL.dwt.php', 'remote','width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
	  remote.focus();
	}
    </script>

<body>
<table width="1338" height="722" border="0">
  <tr>
    <th height="300" colspan="5" class="s" scope="col"><p><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="177" /></p>
    <p><img src="../IMAGENES/registrate.png" alt="" width="445" height="102" /></p></th>
  </tr>
  <tr>
    <td width="124" height="142">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td width="225">&nbsp;</td>
    <td width="682">&nbsp;</td>
    <td width="284"><a href="INICIOADMI.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="284" height="140" align="right" /></a></td>
  </tr>
  <tr>
    <td height="150">&nbsp;</td>
    <td colspan="3" rowspan="3"><p>&nbsp;</p>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="479" align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nombre:</td>
            <td><input type="text" name="Nombre" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Apellido:</td>
            <td><input type="text" name="Apellido" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Correo:</td>
            <td><input type="text" name="Correo" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Contraseña:</td>
            <td><input type="password" name="Contrasena" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">foto de perfil:</td>
            <td><input type="text" name="imagen" value="" size="32" />
        <input type="button" name="button" id="button" value="subir imagen" onclick="javascrip:subirimagen();" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Insertar registro" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    <p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="136">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
