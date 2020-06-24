<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../INDEX.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
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
	font-size: 2px;
}
.S {
	background-color: #FFF;
}
.S {
	font-size: 2px;
}
.D {
	font-size: 1px;
}
.D {
	text-align: right;
	font-size: 1px;
}
P {
	font-size: 18px;
	color: #00F;
	text-align: right;
}
.S {
	font-size: 2px;
}
.F {
}
.X {
	font-size: 9px;
}
.Z {
	font-size: 2px;
}
.C {
	font-size: 0px;
	color: #999;
}
.G {
	font-size: 0px;
}
</style>
</head>

<body>
<table width="1338" height="831" border="0">
  <tr>
    <th height="161" colspan="6" class="S" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="60" height="4">&nbsp;</td>
    <td width="362">&nbsp;</td>
    <td width="431">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="314" colspan="2" rowspan="2"><p><a href="ALTAPULSERA.dwt.php"><img src="../IMAGENES/106990.png" width="186" height="161" /></a></p>
      <p> REGISTRA UN PRODUCTO</p>
    <p>&nbsp;</p></td>
    <td rowspan="2"><p><a href="EDITPRODUCTOS.dwt.php" class="Z"><img src="../IMAGENES/126794.png" width="191" height="156" align="middle" /></a></p>
      <p> EDITAR PRODUCTOS</p>
    <p>&nbsp;</p></td>
    <td rowspan="2">&nbsp;</td>
    <td width="318" height="277"><p><span class="S"><a href="VENTAS.dwt.php"><img src="../IMAGENES/ventasSS.png" width="141" height="116" align="absmiddle" /></a></span></p>
    <p>LSTA DE VENTAS</p></td>
    <td width="140">&nbsp;</td>
  </tr>
  <tr>
    <td height="4" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="266" colspan="2"><p><a href="LISTACLIENTE.dwt.php" class="C"><img src="../IMAGENES/1130077.png" width="186" height="161" align="right" /></a></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>LISTA DE VENDEDORES</p></td>
    <td colspan="2"><p><a href="PULSERASADMI.dwt.php"><img src="../IMAGENES/binoculars-pngrepo-com.png" width="186" height="161" align="right" /></a></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <p>&nbsp; </p>
    <p>&nbsp;</p>
    <p>LISTA DE PULSERAS</p></td>
    <td><p><a href="<?php echo $logoutAction ?>"><img src="../IMAGENES/59319.png" width="146" height="161" align="right" /></a></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>CERRAR SECION</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
</html>