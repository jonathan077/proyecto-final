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
  $insertSQL = sprintf("INSERT INTO pulceras (nom_pulcera, precio_unit, id_talla, imagen, STOCK) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nom_pulcera'], "text"),
                       GetSQLValueString($_POST['precio_unit'], "double"),
                       GetSQLValueString($_POST['id_talla'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['STOCK'], "text"));

  mysql_select_db($database_TIEND, $TIEND);
  $Result1 = mysql_query($insertSQL, $TIEND) or die(mysql_error());

  $insertGoTo = "EXITOPULSERA.dwt.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_TIEND, $TIEND);
$query_TALLA = "SELECT * FROM tallas";
$TALLA = mysql_query($query_TALLA, $TIEND) or die(mysql_error());
$row_TALLA = mysql_fetch_assoc($TALLA);
$totalRows_TALLA = mysql_num_rows($TALLA);
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
.S {
	background-color: #FFF;
}
</style>
</head>

<script>
    function subirimagen()
	{
	  self.name = 'opener'; 
	  remote = open('elegirIMG.dwt.php', 'remote','width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
	  remote.focus();
	}
    </script>

<body>
<p>&nbsp;</p>
<table width="1338" height="722" border="0">
  <tr>
    <th height="204" colspan="5" class="S" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="181" height="118">&nbsp;</td>
    <td colspan="3" rowspan="3"><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table width="488" height="171" align="center">
        <tr valign="baseline">
          <td width="81" align="right" nowrap="nowrap">NOMBRE:</td>
          <td width="279"><input type="text" name="nom_pulcera" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">PRECIO...:</td>
          <td><input type="text" name="precio_unit" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">TALLA.....:</td>
          <td><select name="id_talla">
            <?php 
do {  
?>
            <option value="<?php echo $row_TALLA['id_talla']?>" ><?php echo $row_TALLA['nom_talla']?></option>
            <?php
} while ($row_TALLA = mysql_fetch_assoc($TALLA));
?>
          </select></td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">MODELO:</td>
          <td><input type="text" name="imagen" value="" size="32" />
            <input type="button" name="button" id="button" value="subir imagen" onclick="javascrip:subirimagen();" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">STOCK...:</td>
          <td><input type="text" name="STOCK" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="AGREGAR" />
            <input type="reset" name="borrar" id="borrar" value="Restablecer" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form></td>
    <td width="414"><a href="PORTALADMINISTRADOR.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" align="right" /></a></td>
  </tr>
  <tr>
    <td height="204">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="119">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="161">&nbsp;</td>
    <td width="185">&nbsp;</td>
    <td width="264">&nbsp;</td>
    <td width="264">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($TALLA);
?>
