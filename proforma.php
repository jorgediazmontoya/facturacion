
<?php

require 'ProcesarComprobanteElectronico.php';
$procesarComprobanteElectronico = new ProcesarComprobanteElectronico();
$configCorreo = new \configCorreo();
$configCorreo->correoAsunto = "Nueva Proforma";
$configCorreo->correoHost = "smtp.gmail.com";
$configCorreo->correoPass = "12valeria";
$configCorreo->correoPort = "587";
$configCorreo->correoRemitente = "factel2015@gmail.com";
$configCorreo->sslHabilitado = false;
$proforma = new proforma();
$proforma->numero = "1500";
$proforma->dirProformas = "D:\\Directorio\\Proformas";
$proforma->dirLogo ="D:\\Directorio\\logo.jpg";
$proforma->configCorreo = $configCorreo;
$proforma->razonSocial = "MARTINEZ HIDALGO YOELVYS"; //[Razon Social]
$proforma->nombreComercial = "SOFTPRO";  //[Nombre Comercial, si hay]*
$proforma->ruc = "17551546791001"; //[Ruc]
$proforma->fechaEmision = "16/12/2019"; //[Fecha (dd/mm/yyyy)]
$proforma->dirMatriz = "LEONOR ROSALES Y CAMILO EGAS"; //[Direccion de la Matriz ->SRI]
$proforma->dirEstablecimiento = "QUITO"; //[Direccion de Establecimiento ->SRI]
$proforma->razonSocialComprador = "CONSUMIDOR FINAL"; //Razon social o nombres y apellidos comprador
$proforma->identificacionComprador = "9999999999999"; // Identificacion Comprador
$proforma->direccionComprador = "El Inca"; // Identificacion Comprador
$proforma->subTotal0 = "11.00";
$proforma->subTotal12 = "100.00";
$proforma->subTotalSinImpuesto = "111.00";
$proforma->iva = "12.00";
$proforma->totalDescuento = "0.00";
$proforma->importeTotal = "123.00";

$detalleProforma = new detalleProforma();
$detalleProforma->codigo = "COD-01"; // Codigo del Producto
$detalleProforma->descripcion = "Prueba 17 diciembre"; // Nombre del producto
$detalleProforma->cantidad = "1"; // Cantidad
$detalleProforma->precioUnitario = "10.00"; // Valor unitario
$detalleProforma->descuento = "0.00"; // Descuento u
$detalleProforma->precioTotalSinImpuesto = "10.00"; // Valor sin impuesto  (cantidad * precioUnitario) - descuento

$proforma->detalles = $detalleProforma;

//Para todos los elementos que sean colecciones(mas de un dato) utilizar este esquema de array
$camposAdicionales = array();
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "Email";
$campoAdicional->valor = "yoelvysmh@gmail.com";
$camposAdicionales[0] = $campoAdicional;
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "direccion";
$campoAdicional->valor = "San isidro del inca";
$camposAdicionales[1] = $campoAdicional;
$proforma->infoAdicional = $camposAdicionales;

$procesarProforma = new procesarProforma();
$procesarProforma->proforma = $proforma;
$res = $procesarComprobanteElectronico->procesarProforma($procesarProforma);

var_dump($res);
