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
$query_CLIENTES = "SELECT * FROM clientes";
$CLIENTES = mysql_query($query_CLIENTES, $TIEND) or die(mysql_error());
$row_CLIENTES = mysql_fetch_assoc($CLIENTES);
$totalRows_CLIENTES = mysql_num_rows($CLIENTES);
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
    <th height="202" colspan="5" class="S" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="44" height="74">&nbsp;</td>
    <td width="201">&nbsp;</td>
    <td width="404">&nbsp;</td>
    <td width="483">&nbsp;</td>
    <td width="195"><a href="PORTALADMINISTRADOR.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" rowspan="2"><div align="center">
      <table width="200" border="2">
        <tr>
          <th scope="col">ID_CLIENTE</th>
          <th scope="col">NOMBRE</th>
          <th scope="col">APELLIDO</th>
          <th scope="col">DIRECCION</th>
          <th scope="col">CORREO</th>
          <th scope="col">TELEFONO</th>
          </tr>
        <?php do { ?>
          <tr>
            <td><?php echo $row_CLIENTES['id_cliente']; ?></td>
            <td><?php echo $row_CLIENTES['NOMBRE']; ?></td>
            <td><?php echo $row_CLIENTES['APELLIDO']; ?></td>
            <td><?php echo $row_CLIENTES['DIRECION']; ?></td>
            <td><?php echo $row_CLIENTES['CORREO']; ?></td>
            <td><?php echo $row_CLIENTES['TELEFONO']; ?></td>
          </tr>
          <?php } while ($row_CLIENTES = mysql_fetch_assoc($CLIENTES)); ?>
      </table>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="201">&nbsp;</td>
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
</body>
</html>
<?php
mysql_free_result($CLIENTES);
?>
