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

mysql_select_db($database_TIEND, $TIEND);
$query_VENTAS = "SELECT * FROM venta";
$VENTAS = mysql_query($query_VENTAS, $TIEND) or die(mysql_error());
$row_VENTAS = mysql_fetch_assoc($VENTAS);
$totalRows_VENTAS = mysql_num_rows($VENTAS);
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
	color: #000;
}
.S {
	background-color: #FFF;
}
</style>
</head>

<body>
<table width="1338" height="722" border="0">
  <tr>
    <th height="204" colspan="5" class="S" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="207" height="160">&nbsp;</td>
    <td colspan="3" rowspan="4"><div align="center">
      <table width="200" border="1">
        <tr>
          <th height="48" scope="col">ID_VENTA</th>
          <th scope="col">ID_PULSERA</th>
          <th scope="col">ID_TALLA</th>
          </tr>
        <?php do { ?>
          <tr>
            <td height="57"><?php echo $row_VENTAS['venta']; ?></td>
            <td><?php echo $row_VENTAS['nombre']; ?></td>
            <td><?php echo $row_VENTAS['talla']; ?></td>
          </tr>
          <?php } while ($row_VENTAS = mysql_fetch_assoc($VENTAS)); ?>
      </table>
    </div></td>
    <td width="405"><a href="PORTALADMINISTRADOR.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" align="right" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="118">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($VENTAS);
?>
