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
$notaDebito = new notaDebito();
$notaDebito->configAplicacion = $configApp;
$notaDebito->configCorreo = $configCorreo;

$notaDebito->idUnico =  "01629114710620382144040819";
$notaDebito->ambiente = "1"; //[1,Prueba][2,Produccion] 
$notaDebito->tipoEmision = "1"; //[1,Emision Normal][2,Emision Por Indisponibilidad del sistema
$notaDebito->razonSocial = "COOPERATIVA DE AHORRO Y CREDITO 4 DE OCTUBRE"; //[Razon Social]
$notaDebito->nombreComercial = "COAC 4 DE OCTUBRE AGENCIA QUIMIAG";  //[Nombre Comercial, si hay]*
$notaDebito->ruc = "0691702324001"; //[Ruc]
$notaDebito->codDoc = "05"; //[01, Factura] [04, Nota Credito] [05, Nota Debito] [06, Guia Remision] [07, Guia de Retencion]
$notaDebito->establecimiento = "002"; //[pto de emision ] **
$notaDebito->ptoEmision = "007"; // [Numero Establecimiento SRI]
$notaDebito->secuencial = "000000057"; // [Secuencia desde 1 (9)]
$notaDebito->fechaEmision = "03/02/2015"; //[Fecha (dd/mm/yyyy)]
$notaDebito->dirMatriz = "CHIMBORAZO / RIOBAMBA / AV. CORDOVEZ Y JUAN LARREA"; //[Direccion de la Matriz ->SRI]
$notaDebito->dirEstablecimiento = "CHIMBORAZO / RIOBAMBA /"; //[Direccion de Establecimiento ->SRI]
$notaDebito->contribuyenteEspecial = "5368"; //[Ver SRI]
$notaDebito->obligadoContabilidad = "SI"; // [SI]
$notaDebito->tipoIdentificacionComprador = "05"; //Info comprador [04, RUC][05,Cedula][06, Pasaporte][07, Consumidor final][08, Exterior][09, Placa]
$notaDebito->razonSocialComprador = "Pruebas Servicio de renta internas"; //Razon social o nombres y apellidos comprador
$notaDebito->identificacionComprador = "1311692139"; // Identificacion Comprador
$notaDebito->codDocModificado = "01";
$notaDebito->numDocModificado = "002-007-000000011";
$notaDebito->fechaEmisionDocSustento = "30/01/2015";
$notaDebito->totalSinImpuestos = "21.0";

$impuesto = new impuesto();
$impuesto->codigo = "2"; // [2, IVA][3,ICE][5, IRBPNR]
$impuesto->codigoPorcentaje = "2"; // IVA -> [0, 0%][2, 12%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
$impuesto->tarifa = "12";
$impuesto->baseImponible = "21.0"; // Suma de los impuesto del mismo cod y % (0.00)
$impuesto->valor = "2.52"; // Suma de los impuesto del mismo cod y % aplicado el % (0.00)

$notaDebito->impuestos = $impuesto;
$notaDebito->valorTotal = "23.52";

$motivos = array();
$motivo = new motivo();
$motivo->razon = "otra";
$motivo->valor = "21.00";
$motivos[0] = $motivo;

$notaDebito->motivos = $motivos;

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
$notaDebito->infoAdicional = $camposAdicionales;

$procesarComprobante = new procesarComprobante();
$procesarComprobante->comprobante = $notaDebito;
$res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

var_dump($res);

