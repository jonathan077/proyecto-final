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
$query_PULSE = "SELECT * FROM pulceras";
$PULSE = mysql_query($query_PULSE, $TIEND) or die(mysql_error());
$row_PULSE = mysql_fetch_assoc($PULSE);
$totalRows_PULSE = mysql_num_rows($PULSE);
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
<table width="1338" height="603" border="0">
  <tr>
    <th height="204" colspan="3" class="S" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="168" height="153">&nbsp;</td>
    <td width="1112" rowspan="2">&nbsp;
      <table border="1">
        <tr>
          <td width="129">&nbsp;</td>
          <td width="129">ID_PULSERA</td>
          <td width="144">NOMBRE</td>
          <td width="133">PRECIO</td>
          <td width="109">TALLA</td>
          <td width="100">MODELO</td>
          <td width="240">STOCK</td>
        </tr>
        <?php do { ?>
          <tr>
            <td><p><a href="EDITPRODUC.dwt.php?recordID=<?php echo $row_PULSE['id_pulcera']; ?>">EDITAR</a></p>
            <p>ELIMINAR</p></td>
            <td><div align="center"><?php echo $row_PULSE['id_pulcera']; ?></div></td>
            <td><div align="center"><?php echo $row_PULSE['nom_pulcera']; ?></div></td>
            <td><div align="center"><?php echo $row_PULSE['precio_unit']; ?></div></td>
            <td><div align="center"><?php echo $row_PULSE['id_talla']; ?></div></td>
            <td><img src="../IMAGENES/IMG/<?php echo $row_PULSE['imagen'];?>"width="100" height="100"/></td>
            <td><div align="center"><?php echo $row_PULSE['STOCK']; ?></div></td>
          </tr>
          <?php } while ($row_PULSE = mysql_fetch_assoc($PULSE)); ?>
    </table></td>
    <td width="160"><a href="PORTALADMINISTRADOR.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($PULSE);
?>
