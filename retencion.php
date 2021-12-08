<?php

require 'ProcesarComprobanteElectronico.php';
$procesarComprobanteElectronico = new ProcesarComprobanteElectronico();
$configApp = new \configAplicacion();
$configApp->dirFirma = "F:\\Directorio\\yoelvys_martinez_hidalgo.p12";
$configApp->passFirma = "Yo3lvys1987";
$configApp->dirAutorizados = "F:\\Directorio\\Autorizados";
$configApp->dirLogo = "F:\\Directorio\\logo.jpg";

$configCorreo = new \configCorreo();
$configCorreo->correoAsunto = "Nuevo Comprobante Electrónico";
$configCorreo->correoHost = "smtp.gmail.com";
$configCorreo->correoPass = "12valeria";
$configCorreo->correoPort = "587";
$configCorreo->correoRemitente = "factel2015@gmail.com";
$configCorreo->sslHabilitado = false;

$comprobante = new comprobanteRetencion();
$comprobante->configAplicacion = $configApp;;
$comprobante->ambiente = "1";
$comprobante->tipoEmision = "1";
$comprobante->razonSocial = "MARTINEZ HIDALGO YOELVYS";
$comprobante->nombreComercial = "FACILFACT";
$comprobante->ruc = "1755154679001";
$comprobante->codDoc = "07";
$comprobante->establecimiento = "001";
$comprobante->ptoEmision = "002";
$comprobante->secuencial = "100322201";
$comprobante->dirMatriz = "De los Nogales y Chigualcanes";
$comprobante->fechaEmision = "11/01/2019";
$comprobante->dirEstablecimiento = "De los Nogales y Chigualcanes";

$comprobante->obligadoContabilidad = "NO";
$comprobante->tipoIdentificacionSujetoRetenido = "04";
$comprobante->razonSocialSujetoRetenido = "Juan Pablo Chávez Núñez";
$comprobante->identificacionSujetoRetenido = "1311692139001";
$comprobante->periodoFiscal = "01/2019";

$impuesto = new impuestoComprobanteRetencion();
$impuesto->codigo = "2";
$impuesto->codigoRetencion = "1";
$impuesto->baseImponible = "101.94";
$impuesto->porcentajeRetener = "30";
$impuesto->valorRetenido = "30.58";
$impuesto->codDocSustento = "01";
$impuesto->numDocSustento = "002001000000001";
$impuesto->fechaEmisionDocSustento = "11/01/2019";
$comprobante->impuestos = $impuesto;

$camposAdicionales = array();
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "Email";
$campoAdicional->valor = "yoelvysmh@gmail.com";
$camposAdicionales[0] = $campoAdicional;
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "direccion";
$campoAdicional->valor = "San isidro del inca";
$camposAdicionales[1] = $campoAdicional;
$comprobante->infoAdicional = $camposAdicionales;

$procesarComprobante = new procesarComprobante();
$procesarComprobante->comprobante = $comprobante;
$procesarComprobante->envioSRI = true; //El sistema si es true 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia SRI 5-No devuelve respuesta
$res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

if ($res->return->estadoComprobante == "AUTORIZADO") {
    $procesarComprobante = new procesarComprobante();
    $procesarComprobante->comprobante = $comprobante;
    $procesarComprobante->envioSRI = false; //El sistema si es false 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia Email al cliente 5-No devuelve respuesta
    $res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);
}

var_dump($res);