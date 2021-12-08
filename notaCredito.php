<?php

var_dump("iniciando...");
require 'ProcesarComprobanteElectronico.php';
ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);
$procesarComprobanteElectronico = new ProcesarComprobanteElectronico();
$configApp = new \configAplicacion();
$configApp->dirFirma = "D:\\Directorio\\yoelvys_martinez_hidalgo.p12";
$configApp->passFirma = "Yo3lvys1987";
$configApp->dirAutorizados = "D:\\Directorio\\Autorizados";
$configApp->dirLogo = "D:\\Directorio\\logo.jpg";

$configCorreo = new \configCorreo();
$configCorreo->correoAsunto = "Nuevo Comprobante rueb";
$configCorreo->correoHost = "smtp.gmail.com";
$configCorreo->correoPass = "12valeria";
$configCorreo->correoPort = "587";
$configCorreo->correoRemitente = "factel2015@gmail.com";
$configCorreo->sslHabilitado = false;
$notaCredito = new notaCredito();
$notaCredito->configAplicacion = $configApp;
$notaCredito->configCorreo = $configCorreo;

$notaCredito->idUnico =  "01629114710620382144040819";
$notaCredito->ambiente = "1"; //[1,Prueba][2,Produccion] 
$notaCredito->tipoEmision = "1"; //[1,Emision Normal][2,Emision Por Indisponibilidad del sistema
$notaCredito->razonSocial = "COOPERATIVA DE AHORRO Y CREDITO 4 DE OCTUBRE"; //[Razon Social]
$notaCredito->nombreComercial = "COAC 4 DE OCTUBRE AGENCIA QUIMIAG";  //[Nombre Comercial, si hay]*
$notaCredito->ruc = "0691702324001"; //[Ruc]
$notaCredito->codDoc = "04"; //[01, Factura] [04, Nota Credito] [05, Nota Debito] [06, Guia Remision] [07, Guia de Retencion]
$notaCredito->establecimiento = "006"; //[pto de emision ] **
$notaCredito->ptoEmision = "001"; // [Numero Establecimiento SRI]
$notaCredito->secuencial = "099994877"; // [Secuencia desde 1 (9)]
$notaCredito->fechaEmision = "01/04/2015"; //[Fecha (dd/mm/yyyy)]
$notaCredito->dirMatriz = "CHIMBORAZO / RIOBAMBA / AV. CORDOVEZ Y JUAN LARREA"; //[Direccion de la Matriz ->SRI]
$notaCredito->dirEstablecimiento = "CHIMBORAZO / RIOBAMBA /"; //[Direccion de Establecimiento ->SRI]
$notaCredito->contribuyenteEspecial = "5368"; //[Ver SRI]
$notaCredito->obligadoContabilidad = "SI"; // [SI]
$notaCredito->tipoIdentificacionComprador = "04"; //Info comprador [04, RUC][05,Cedula][06, Pasaporte][07, Consumidor final][08, Exterior][09, Placa]
$notaCredito->razonSocialComprador = "Pruebas Servicio de renta internas"; //Razon social o nombres y apellidos comprador
$notaCredito->identificacionComprador = "1311692139001"; // Identificacion Comprador
$notaCredito->codDocModificado = "01";
$notaCredito->numDocModificado = "006-001-099994877";
$notaCredito->fechaEmisionDocSustento = "31/03/2015";
$notaCredito->totalSinImpuestos = "10.0";
$notaCredito->valorModificacion = "10.0";
$notaCredito->moneda = "DOLAR";

$totalImpuesto = new totalImpuesto();
$totalImpuesto->codigo = "2"; // [2, IVA][3,ICE][5, IRBPNR]
$totalImpuesto->codigoPorcentaje = "0"; // IVA -> [0, 0%][2, 12%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
$totalImpuesto->baseImponible = "10"; // Suma de los impuesto del mismo cod y % (0.00)
$totalImpuesto->valor = "0"; // Suma de los impuesto del mismo cod y % aplicado el % (0.00)

$notaCredito->totalConImpuesto = $totalImpuesto;

$detalle = new detalleNotaCredito();
$detalle->cantidad = "1";
$detalle->codigoAdicional = "125BJC-01";
$detalle->codigoInterno = "1334D56789-A";
$detalle->descripcion = "CAMIONETA 4X4";
$detalle->descuento = "0.00";

$detalle->precioUnitario = "10.00";
$detalle->precioTotalSinImpuesto = "10.00";

$impuesto = new impuesto(); // Impuesto del detalle
$impuesto->codigo = "2";
$impuesto->codigoPorcentaje = "0";
$impuesto->tarifa = "0";
$impuesto->baseImponible = "10.00";
$impuesto->valor = "0.00";
$detalle->impuestos = $impuesto;

$notaCredito->detalles = $detalle;
$notaCredito->motivo = "ANULACION";


//asi podemos crear los elementos que sean una lista, en este caso es con campo adicional, pero puede ser con detallesFactura, 
//impuestos, etc.
//en los documentos estan los que son arreglos de campos.

$camposAdicionales = array();
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "correo";
$campoAdicional->valor = "yoelvysmh@gmail.com";
$camposAdicionales[0] = $campoAdicional;
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "direccion";
$campoAdicional->valor = "San isidro del inca";
$camposAdicionales[1] = $campoAdicional;
$notaCredito->infoAdicional = $camposAdicionales;

$procesarComprobante = new procesarComprobante();
$procesarComprobante->comprobante = $notaCredito;
$res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

var_dump($res);

