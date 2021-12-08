
<?php

require 'ProcesarComprobanteElectronico.php';
$procesarComprobanteElectronico = new ProcesarComprobanteElectronico();
$configApp = new \configAplicacion();
$configApp->dirFirma = "C:\\Directorio\\MILTON HERNAN RAMIREZ MURILLO 251121171243.p12";
$configApp->passFirma = "0926034786";
$configApp->dirAutorizados = "C:\\Directorio\\Autorizados";
$configApp->dirLogo = "C:\\Directorio\\logo.png";

$configCorreo = new \configCorreo();
$configCorreo->correoAsunto = "Nuevo Comprobante rueb";
$configCorreo->correoHost = "smtp.gmail.com";
$configCorreo->correoPass = "wdhjvaakxnbsrldb";
$configCorreo->correoPort = "587";
$configCorreo->correoRemitente = "cesarlata1@gmail.com";
$configCorreo->sslHabilitado = false;
$factura = new factura();
$factura->configAplicacion = $configApp;
$factura->configCorreo = $configCorreo;
$factura->ambiente = "1"; //[1,Prueba][2,Produccion] 
$factura->tipoEmision = "1"; //[1,Emision Normal]
$factura->razonSocial = "RAMIREZ MURILLO MILTON HERNAN"; //[Razon Social]
$factura->nombreComercial = "SOFTPRO";  //[Nombre Comercial, si hay]*
$factura->ruc = "0926034786001"; //[Ruc]
$factura->codDoc = "01"; //[01, Factura] [04, Nota Credito] [05, Nota Debito] [06, Guia Remision] [07, Guia de Retencion]
$factura->establecimiento = "001"; //[Numero Establecimiento SRI]
$factura->ptoEmision = "001"; // [pto de emision ] **
$factura->secuencial = "000009938"; // [Secuencia desde 1 (9)]
$factura->fechaEmision = "02/12/2021"; //[Fecha (dd/mm/yyyy)]
$factura->dirMatriz = "GUAYAS / DURAN / ELOY ALFARO (DURAN) / MZ 572 SOLAR 5 Y 5TA ETAPA"; //[Direccion de la Matriz ->SRI]
$factura->dirEstablecimiento = "DURAN"; //[Direccion de Establecimiento ->SRI]
$factura->obligadoContabilidad = "NO"; // [SI]
$factura->contribuyenteEspecial = "";
$factura->tipoIdentificacionComprador = "05"; //Info comprador [04, RUC][05,Cedula][06, Pasaporte][07, Consumidor final][08, Exterior][09, Placa]
$factura->razonSocialComprador = "Milton Ramirez"; //Razon social o nombres y apellidos comprador
$factura->identificacionComprador = "1207118470"; // Identificacion Comprador
$factura->direccionComprador = "El Inca"; // Identificacion Comprador

$factura->totalSinImpuestos = "150.00"; // Total sin aplicar impuestos
$factura->totalDescuento = "0.00"; // Total Dtos

$totalConImpuestoArray = array();
//if ($subtotal12 > 0) {
    $totalImpuesto = new totalImpuesto();
    $totalImpuesto->codigo = "2"; // [2, IVA][3,ICE][5, IRBPNR]
    $totalImpuesto->codigoPorcentaje = "2"; // IVA -> [0, 0%][2, 12%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
    $totalImpuesto->baseImponible = "100.00"; // Suma de los impuesto del mismo cod y % (0.00)
    $totalImpuesto->valor = "12.00"; // Suma de los impuesto del mismo cod y % aplicado el % (0.00)
    
    $totalConImpuestoArray[] = $totalImpuesto;
//}

//if ($subtotal0 > 0) {
    $totalImpuesto = new totalImpuesto();
    $totalImpuesto->codigo = "2"; // [2, IVA][3,ICE][5, IRBPNR]
    $totalImpuesto->codigoPorcentaje = "0"; // IVA -> [0, 0%][2, 12%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
    $totalImpuesto->baseImponible = "50.00"; // Suma de los impuesto del mismo cod y % (0.00)
    $totalImpuesto->valor = "0.00"; // Suma de los impuesto del mismo cod y % aplicado el % (0.00)
    
    $totalConImpuestoArray[] = $totalImpuesto;
//}


$factura->totalConImpuesto = $totalImpuesto; //Agrega el impuesto a la factura

$factura->propina = "0.00"; // Propina 
$factura->importeTotal = "162.00"; // Total de Productos + impuestos  100 + 50 + 12
$factura->moneda = "DOLAR"; //DOLAR

$detalleFacturaArray = array();

$detalleFactura = new detalleFactura();
$detalleFactura->codigoPrincipal = "COD-01"; // Codigo del Producto
$detalleFactura->codigoAuxiliar = "COD-A"; // Opcional
$detalleFactura->descripcion = "Jabon"; // Nombre del producto
$detalleFactura->cantidad = "50.00"; // Cantidad
$detalleFactura->precioUnitario = "1.00"; // Valor unitario
$detalleFactura->descuento = "0.00"; // Descuento u
$detalleFactura->precioTotalSinImpuesto = "50.00"; // Valor sin impuesto  (cantidad * precioUnitario) - descuento

$impuesto = new impuesto(); // Impuesto del detalle
$impuesto->codigo = "2";
$impuesto->codigoPorcentaje = "2"; // 0-0% 2-12% 
$impuesto->tarifa = "12"; // 0 0 12
$impuesto->baseImponible = "50.00"; //precioTotalSinImpuesto del detalle
$impuesto->valor = "6.00"; // baseImponible * % impuesto
$detalleFactura->impuestos = $impuesto;
$detalleFacturaArray [] = $detalleFactura;

$detalleFactura = new detalleFactura();
$detalleFactura->codigoPrincipal = "COD-01"; // Codigo del Producto
$detalleFactura->codigoAuxiliar = "COD-A"; // Opcional
$detalleFactura->descripcion = "Leche"; // Nombre del producto
$detalleFactura->cantidad = "100.00"; // Cantidad
$detalleFactura->precioUnitario = "0.50"; // Valor unitario
$detalleFactura->descuento = "0.00"; // Descuento u
$detalleFactura->precioTotalSinImpuesto = "50.00"; // Valor sin impuesto  (cantidad * precioUnitario) - descuento

$impuesto = new impuesto(); // Impuesto del detalle
$impuesto->codigo = "2";
$impuesto->codigoPorcentaje = "0"; // 0-0% 2-12% 
$impuesto->tarifa = "0"; // 0 0 12
$impuesto->baseImponible = "50.00"; //precioTotalSinImpuesto del detalle
$impuesto->valor = "0.00"; // baseImponible * % impuesto
$detalleFactura->impuestos = $impuesto;
$detalleFacturaArray [] = $detalleFactura;

$detalleFactura = new detalleFactura();
$detalleFactura->codigoPrincipal = "COD-01"; // Codigo del Producto
$detalleFactura->codigoAuxiliar = "COD-A"; // Opcional
$detalleFactura->descripcion = "Cerveza"; // Nombre del producto
$detalleFactura->cantidad = "25.00"; // Cantidad
$detalleFactura->precioUnitario = "2.00"; // Valor unitario
$detalleFactura->descuento = "0.00"; // Descuento u
$detalleFactura->precioTotalSinImpuesto = "50.00"; // Valor sin impuesto  (cantidad * precioUnitario) - descuento

$impuesto = new impuesto(); // Impuesto del detalle
$impuesto->codigo = "2";
$impuesto->codigoPorcentaje = "2"; // 0-0% 2-12% 
$impuesto->tarifa = "12"; // 0 0 12
$impuesto->baseImponible = "50.00"; //precioTotalSinImpuesto del detalle
$impuesto->valor = "6.00"; // baseImponible * % impuesto
$detalleFactura->impuestos = $impuesto;
$detalleFacturaArray [] = $detalleFactura;

$factura->detalles = $detalleFacturaArray;

//asi podemos crear los elementos que sean una lista, en este caso es con campo adicional, pero puede ser con detallesFactura, 
//impuestos, etc.
//en los documentos estan los que son arreglos de campos.
$pagoArray = array();

$pago = new pagos();
$pago->formaPago = "01";
$pago->total = "120.00";
$pagoArray[] = $pago;

$pago = new pagos();
$pago->formaPago = "20";
$pago->total = "62.00";
$pagoArray[] = $pago;

$factura->pagos = $pago;

//Para todos los elementos que sean colecciones(mas de un dato) utilizar este esquema de array
$camposAdicionales = array();
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "Email";
$campoAdicional->valor = "jdiaz@redlinks.com.ec";
$camposAdicionales[0] = $campoAdicional;
$campoAdicional = new campoAdicional();
$campoAdicional->nombre = "direccion";
$campoAdicional->valor = "San isidro del inca";
$camposAdicionales[1] = $campoAdicional;

$factura->agenteRetencion = '';
$factura->regimenMicroempresas = 1;

$factura->infoAdicional = $camposAdicionales;

$procesarComprobante = new procesarComprobante();
$procesarComprobante->comprobante = $factura;
$procesarComprobante->envioSRI = true; //El sistema si es true 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia SRI 5-Nos devuelve respuesta
$res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

if ($res->return->estadoComprobante == "AUTORIZADO") {
    $procesarComprobante = new procesarComprobante();
    $procesarComprobante->comprobante = $factura;
    $procesarComprobante->envioSRI = false; //El sistema si es false 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia Email al cliente 5-No devuelve respuesta
    $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);
}


/* Si queremos primero enviar al cliente el email y despues al sri utilizar este bloque
  $procesarComprobante = new procesarComprobante();
  $procesarComprobante->comprobante = $factura;
  $procesarComprobante->envioSRI = false; //El sistema si es false 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia Email al cliente 5-No devuelve respuesta
  $res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

  if($res->return->estadoComprobante == "FIRMADO"){
  $procesarComprobante = new procesarComprobante();
  $procesarComprobante->comprobante = $factura;
  $procesarComprobante->envioSRI = true; //El sistema si es true 1-Crea XML en el directorio de autorizado 2-Firma XML 3-Crea Ride en el directorio autorizado 4-Envia SRI 5-No devuelve respuesta
  $res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);
  }
 */
echo '<pre>';
var_dump($res);
echo '</pre>';
