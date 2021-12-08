
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
$liquidacionCompra = new \liquidacionCompra();
$liquidacionCompra->configAplicacion = $configApp;
$liquidacionCompra->configCorreo = $configCorreo;
$liquidacionCompra->ambiente = "1"; //[1,Prueba][2,Produccion] 
$liquidacionCompra->tipoEmision = "1"; //[1,Emision Normal][2,Emision Por Indisponibilidad del sistema
$liquidacionCompra->razonSocial = "MARTINEZ HIDALGO YOELVYS"; //[Razon Social]
$liquidacionCompra->nombreComercial = "SOFTPRO";  //[Nombre Comercial, si hay]*
$liquidacionCompra->ruc = "1755154679001"; //[Ruc]
$liquidacionCompra->codDoc = "03"; //[01, Factura] [04, Nota Credito] [05, Nota Debito] [06, Guia Remision] [07, Guia de Retencion]
$liquidacionCompra->establecimiento = "001"; //[Numero Establecimiento SRI]
$liquidacionCompra->ptoEmision = "001"; // [pto de emision ] **
$liquidacionCompra->secuencial = "000000002"; // [Secuencia desde 1 (9)]
$liquidacionCompra->fechaEmision = "13/08/2019"; //[Fecha (dd/mm/yyyy)]
$liquidacionCompra->dirMatriz = "LEONOR ROSALES Y CAMILO EGAS"; //[Direccion de la Matriz ->SRI]
$liquidacionCompra->dirEstablecimiento = "QUITO"; //[Direccion de Establecimiento ->SRI]
$liquidacionCompra->obligadoContabilidad = "NO"; // [SI]
//$liquidacionCompra->contribuyenteEspecial = "584";
$liquidacionCompra->tipoIdentificacionProveedor = "05"; //Info comprador [04, RUC][05,Cedula][06, Pasaporte][07, Consumidor final][08, Exterior][09, Placa]
$liquidacionCompra->razonSocialProveedor = "PINTURA CASA"; //Razon social o nombres y apellidos comprador
$liquidacionCompra->identificacionProveedor = "1311692139"; // Identificacion Proveedor
$liquidacionCompra->direccionProveedor = "Av 6 de diciembre y alamos";
$liquidacionCompra->totalSinImpuestos = "10.00"; // Total sin aplicar impuestos
$liquidacionCompra->totalDescuento = "0.00"; // Total Dtos

$totalImpuesto = new totalImpuesto();
$totalImpuesto->codigo = "2"; // [2, IVA][3,ICE][5, IRBPNR]
$totalImpuesto->codigoPorcentaje = "0"; // IVA -> [0, 0%][2, 12%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
$totalImpuesto->baseImponible = "10.00"; // Suma de los impuesto del mismo cod y % (0.00)
$totalImpuesto->valor = "0.00"; // Suma de los impuesto del mismo cod y % aplicado el % (0.00)

$liquidacionCompra->totalConImpuesto = $totalImpuesto; //Agrega el impuesto a la factura

$liquidacionCompra->propina = "0.00"; // Propina 
$liquidacionCompra->importeTotal = "10.00"; // Total de Productos + impuestos
$liquidacionCompra->moneda = "DOLAR"; //DOLAR


$detalleLiquidacionCompra = new detalleLiquidacionCompra();
$detalleLiquidacionCompra->codigoPrincipal = "COD-01"; // Codigo del Producto
$detalleLiquidacionCompra->codigoAuxiliar = "COD-A"; // Opcional
$detalleLiquidacionCompra->descripcion = "Prueba 21 FEB"; // Nombre del producto
$detalleLiquidacionCompra->cantidad = "1"; // Cantidad
$detalleLiquidacionCompra->precioUnitario = "10.00"; // Valor unitario
$detalleLiquidacionCompra->descuento = "0.00"; // Descuento u
$detalleLiquidacionCompra->precioTotalSinImpuesto = "10.00"; // Valor sin impuesto  (cantidad * precioUnitario) - descuento

$impuesto = new impuesto(); // Impuesto del detalle
$impuesto->codigo = "2";
$impuesto->codigoPorcentaje = "0"; // 0-0% 2-12% 
$impuesto->tarifa = "0"; // 0 0 12
$impuesto->baseImponible = "10.00"; //precioTotalSinImpuesto del detalle
$impuesto->valor = "0.00"; // baseImponible * % impuesto
$detalleLiquidacionCompra->impuestos = $impuesto;

$liquidacionCompra->detalles = $detalleLiquidacionCompra;

//asi podemos crear los elementos que sean una lista, en este caso es con campo adicional, pero puede ser con detallesFactura, 
//impuestos, etc.
//en los documentos estan los que son arreglos de campos.

$pago = new pagos();
$pago->formaPago = "01";
$pago->total = "10.00";

$liquidacionCompra->pagos = $pago;

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
$liquidacionCompra->infoAdicional = $camposAdicionales;

$procesarComprobante = new procesarComprobante();
$procesarComprobante->comprobante = $liquidacionCompra;
$procesarComprobante->envioSRI = true; //El sistema si es true 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia SRI 5-No devuelve respuesta
$res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

if ($res->return->estadoComprobante == "AUTORIZADO") {
    $procesarComprobante = new procesarComprobante();
    $procesarComprobante->comprobante = $liquidacionCompra;
    $procesarComprobante->envioSRI = false; //El sistema si es false 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia Email al cliente 5-No devuelve respuesta
    $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);
}


/* Si queremos primero enviar al cliente el email y despues al sri utilizar este bloque
  $procesarComprobante = new procesarComprobante();
  $procesarComprobante->comprobante = $liquidacionCompra;
  $procesarComprobante->envioSRI = false; //El sistema si es false 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia Email al cliente 5-No devuelve respuesta
  $res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

  if($res->return->estadoComprobante == "FIRMADO"){
  $procesarComprobante = new procesarComprobante();
  $procesarComprobante->comprobante = $liquidacionCompra;
  $procesarComprobante->envioSRI = true; //El sistema si es true 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia SRI 5-No devuelve respuesta
  $res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);
  }
 */
var_dump($res);
