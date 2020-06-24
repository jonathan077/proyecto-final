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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE pulceras SET nom_pulcera=%s, precio_unit=%s, id_talla=%s, imagen=%s, STOCK=%s WHERE id_pulcera=%s",
                       GetSQLValueString($_POST['nom_pulcera'], "text"),
                       GetSQLValueString($_POST['precio_unit'], "double"),
                       GetSQLValueString($_POST['id_talla'], "text"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['STOCK'], "text"),
                       GetSQLValueString($_POST['id_pulcera'], "int"));

  mysql_select_db($database_TIEND, $TIEND);
  $Result1 = mysql_query($updateSQL, $TIEND) or die(mysql_error());

  $updateGoTo = "Edi.dwt.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$VarProduc_pulse = "0";
if (isset($_GET["recordID"])) {
  $VarProduc_pulse = $_GET["recordID"];
}
mysql_select_db($database_TIEND, $TIEND);
$query_pulse = sprintf("SELECT * FROM pulceras WHERE pulceras.id_pulcera = %s", GetSQLValueString($VarProduc_pulse, "int"));
$pulse = mysql_query($query_pulse, $TIEND) or die(mysql_error());
$row_pulse = mysql_fetch_assoc($pulse);
$totalRows_pulse = mysql_num_rows($pulse);

mysql_select_db($database_TIEND, $TIEND);
$query_talla = "SELECT * FROM tallas";
$talla = mysql_query($query_talla, $TIEND) or die(mysql_error());
$row_talla = mysql_fetch_assoc($talla);
$totalRows_talla = mysql_num_rows($talla);
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
	  remote = open('SUBIRIMG.dwt.php', 'remote','width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
	  remote.focus();
	}
    </script>


<body>
<table width="1338" height="766" border="0">
  <tr>
    <th height="204" colspan="3" class="s" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="164" height="86">&nbsp;</td>
    <td width="984" rowspan="2">&nbsp;
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="465" align="center">
          <tr valign="baseline">
            <td width="128" align="right" nowrap="nowrap">Id_pulcera:</td>
            <td width="287"><?php echo $row_pulse['id_pulcera']; ?></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">NOMBRE:</td>
            <td><input type="text" name="nom_pulcera" value="<?php echo htmlentities($row_pulse['nom_pulcera'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">PRECIO:</td>
            <td><input type="text" name="precio_unit" value="<?php echo htmlentities($row_pulse['precio_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">TALLA:</td>
            <td><select name="id_talla">
              <?php 
do {  
?>
              <option value="<?php echo $row_talla['id_talla']?>" <?php if (!(strcmp($row_talla['id_talla'], htmlentities($row_pulse['id_talla'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_talla['nom_talla']?></option>
              <?php
} while ($row_talla = mysql_fetch_assoc($talla));
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">MODELO:</td>
            <td><input type="text" name="imagen" value="<?php echo htmlentities($row_pulse['imagen'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
            <input type="button" name="button" id="button" value="subir imagen" onclick="javascrip:subirimagen();" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">STOCK:</td>
            <td><input type="text" name="STOCK" value="<?php echo htmlentities($row_pulse['STOCK'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value="Actualizar registro" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
        <input type="hidden" name="id_pulcera" value="<?php echo $row_pulse['id_pulcera']; ?>" />
      </form>
    <p>&nbsp;</p></td>
    <td width="176"><a href="PORTALADMINISTRADOR.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($pulse);

mysql_free_result($talla);
?>
