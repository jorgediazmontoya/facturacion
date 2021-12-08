
<?php

require 'ProcesarComprobanteElectronico.php';
$procesarComprobanteElectronico = new ProcesarComprobanteElectronico();
$configApp = new \configAplicacion();
$configApp->dirFirma = "D:\\Directorio\\yoelvys_martinez_hidalgo.p12";
$configApp->passFirma = "Yo3lvys1987";
$configApp->dirAutorizados = "D:\\Directorio\\Autorizados";
$configApp->dirLogo = "D:\\Directorio\\logo.jpg";

$configCorreo = new \configCorreo();
$configCorreo->correoAsunto = "Nuevo Comprobante Electrónico";
$configCorreo->correoHost = "smtp.gmail.com";
$configCorreo->correoPass = "12valeria";
$configCorreo->correoPort = "587";
$configCorreo->correoRemitente = "factel2015@gmail.com";
$configCorreo->sslHabilitado = false;

$guia = new guiaRemision();
$guia->configAplicacion = $configApp;
$guia->configCorreo = $configCorreo;
$guia->ambiente = "1";
$guia->tipoEmision = "1";
$guia->razonSocial = "MARTINEZ HIDALGO YOELVYS";
$guia->nombreComercial = "FACILFACT";
$guia->ruc = "1755154679001";
$guia->codDoc = "06";
$guia->establecimiento = "001";
$guia->ptoEmision = "001";
$guia->secuencial = "000025100";
$guia->dirMatriz = "Enrique Guerrero Portilla OE1-34 Av. Galo Plaza";
$guia->dirEstablecimiento = "Rodrigo Moreno S/N Francisco García";
$guia->contribuyenteEspecial = "5368";
$guia->obligadoContabilidad = "SI";

$guia->dirPartida = "Av. Eloy Alfaro 34 y Av. Libertad Esq.";
$guia->razonSocialTransportista = "Transportes S.A";
$guia->tipoIdentificacionTransportista = "06";
$guia->rucTransportista = "1796875790001";
$guia->rise = "RISE";
$guia->fechaIniTransporte = "15/04/2015";
$guia->fechaFinTransporte = "16/04/2015";
$guia->placa = "MCL0827";

$destinatario = new Destinatario();
$destinatario->identificacionDestinatario = "1716849140001";
$destinatario->razonSocialDestinatario = "Alvarez Mina John Henry";
$destinatario->dirDestinatario = "Av. Simón Bolívar S/N Intercambiador";
$destinatario->motivoTraslado = "Venta de Maquinaria de Impresión";
$destinatario->docAduaneroUnico = "0041324846887";
$destinatario->codEstabDestino = "001";
$destinatario->ruta = "Quito – Cayambe - Otavalo";
$destinatario->codDocSustento = "01";
$destinatario->numDocSustento = "002-001-000000001";
$destinatario->numAutDocSustento = "2110201116302517921467390011234567891";
$destinatario->fechaEmisionDocSustento = "26/05/2015";

$detalles = array();
$detalle = new DetalleGuiaRemision();
$detalle->codigoInterno = "125BJC-01";
$detalle->codigoAdicional = "1234D56789-A";
$detalle->descripcion = "CAMIONETA 4X4 DIESEL 3.7";
$detalle->cantidad = "10";
$detalles[0] = $detalle;
$detalle = new DetalleGuiaRemision();
$detalle->codigoInterno = "PPP5584";
$detalle->codigoAdicional = "55444";
$detalle->descripcion = "CHEVROLET AVEO 1.6";
$detalle->cantidad = "6";
$detalles[1] = $detalle;

$destinatario->detalles = $detalles;

$guia->destinatarios = $destinatario;

$camposAdicionales = array();
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "Email";
$campoAdicional->valor = "yoelvysmh@gmail.com";
$camposAdicionales[0] = $campoAdicional;
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "direccion";
$campoAdicional->valor = "San isidro del inca";
$camposAdicionales[1] = $campoAdicional;
$guia->infoAdicional = $camposAdicionales;

$procesarComprobante = new procesarComprobante();
$procesarComprobante->comprobante = $guia;
$procesarComprobante->envioSRI = false;
$res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

if ($res->return->estadoComprobante == "FIRMADO") {
    $procesarComprobante = new procesarComprobante();
    $procesarComprobante->comprobante = $guia;
    $procesarComprobante->envioSRI = true;
    $res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);
}
var_dump($res);
