<?php

require './ProcesarComprobanteElectronico.php';
$procesarComprobanteElectronico = new ProcesarComprobanteElectronico();
$procesarXML = new procesarXML();
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

$procesarXML->configAplicacion = $configApp;
$procesarXML->configCorreo = $configCorreo;
$procesarXML->xml = "<?xml version='1.0' encoding='UTF-8' standalone='no'?>
<factura id='comprobante' version='1.0.0'>
  <infoTributaria>
    <ambiente>1</ambiente>
    <tipoEmision>1</tipoEmision>
    <razonSocial>MARTINEZ HIDALGO YOELVYS</razonSocial>
    <nombreComercial>Facilfact</nombreComercial>
    <ruc>1755154679001</ruc>
    <claveAcceso>1801202001175515467900110010010000057691234567810</claveAcceso>
    <codDoc>01</codDoc>
    <estab>001</estab>
    <ptoEmi>001</ptoEmi>
    <secuencial>000005769</secuencial>
    <dirMatriz>DE LAS TORONJAS Y DE LAS HORTENCIAS</dirMatriz>
  </infoTributaria>
  <infoFactura>
    <fechaEmision>18/01/2020</fechaEmision>
    <dirEstablecimiento>Mariana De Jesús</dirEstablecimiento>
    <obligadoContabilidad>NO</obligadoContabilidad>
    <tipoIdentificacionComprador>04</tipoIdentificacionComprador>
    <razonSocialComprador>Joel Alejandro</razonSocialComprador>
    <identificacionComprador>1311692139001</identificacionComprador>
    <totalSinImpuestos>1.43</totalSinImpuestos>
	<totalSubsidio>8.91</totalSubsidio>
    <totalDescuento>0.00</totalDescuento>
    <totalConImpuestos>
      <totalImpuesto>
        <codigo>2</codigo>
        <codigoPorcentaje>2</codigoPorcentaje>
        <baseImponible>1.43</baseImponible>
        <valor>0.17</valor>
      </totalImpuesto>
    </totalConImpuestos>
    <propina>0.00</propina>
    <importeTotal>1.60</importeTotal>
    <moneda>DOLAR</moneda>
    <pagos>
      <pago>
        <formaPago>01</formaPago>
        <total>1.60</total>
      </pago>
    </pagos>
  </infoFactura>
  <detalles>
    <detalle>
      <codigoPrincipal>NP</codigoPrincipal>
      <descripcion>Gas Domestico</descripcion>
      <cantidad>1.00</cantidad>
      <precioUnitario>1.43</precioUnitario>
	  <precioSinSubsidio>10.34</precioSinSubsidio>
      <descuento>0.00</descuento>
      <precioTotalSinImpuesto>1.43</precioTotalSinImpuesto>
      <impuestos>
        <impuesto>
          <codigo>2</codigo>
          <codigoPorcentaje>2</codigoPorcentaje>
          <tarifa>12.00</tarifa>
          <baseImponible>1.43</baseImponible>
          <valor>0.17</valor>
        </impuesto>
      </impuestos>
    </detalle>
	<detalle>
      <codigoPrincipal>NP</codigoPrincipal>
      <descripcion>Gas Dhdgdstico</descripcion>
      <cantidad>1.00</cantidad>
      <precioUnitario>1.43</precioUnitario>
	  <precioSinSubsidio>10.34</precioSinSubsidio>
      <descuento>0.00</descuento>
      <precioTotalSinImpuesto>1.43</precioTotalSinImpuesto>
      <impuestos>
        <impuesto>
          <codigo>2</codigo>
          <codigoPorcentaje>2</codigoPorcentaje>
          <tarifa>12.00</tarifa>
          <baseImponible>1.43</baseImponible>
          <valor>0.17</valor>
        </impuesto>
      </impuestos>
    </detalle>
	<detalle>
      <codigoPrincipal>NP</codigoPrincipal>
      <descripcion>Gas Domestico</descripcion>
      <cantidad>1.00</cantidad>
      <precioUnitario>1.43</precioUnitario>
	  <precioSinSubsidio>10.34</precioSinSubsidio>
      <descuento>0.00</descuento>
      <precioTotalSinImpuesto>1.43</precioTotalSinImpuesto>
      <impuestos>
        <impuesto>
          <codigo>2</codigo>
          <codigoPorcentaje>2</codigoPorcentaje>
          <tarifa>12.00</tarifa>
          <baseImponible>1.43</baseImponible>
          <valor>0.17</valor>
        </impuesto>
      </impuestos>
    </detalle>
	<detalle>
      <codigoPrincipal>NP</codigoPrincipal>
      <descripcion>Gas Domestico</descripcion>
      <cantidad>1.00</cantidad>
      <precioUnitario>1.43</precioUnitario>
	  <precioSinSubsidio>10.34</precioSinSubsidio>
      <descuento>0.00</descuento>
      <precioTotalSinImpuesto>1.43</precioTotalSinImpuesto>
      <impuestos>
        <impuesto>
          <codigo>2</codigo>
          <codigoPorcentaje>2</codigoPorcentaje>
          <tarifa>12.00</tarifa>
          <baseImponible>1.43</baseImponible>
          <valor>0.17</valor>
        </impuesto>
      </impuestos>
    </detalle>
	<detalle>
      <codigoPrincipal>NP</codigoPrincipal>
      <descripcion>Gas Domestico</descripcion>
      <cantidad>1.00</cantidad>
      <precioUnitario>1.43</precioUnitario>
	  <precioSinSubsidio>10.34</precioSinSubsidio>
      <descuento>0.00</descuento>
      <precioTotalSinImpuesto>1.43</precioTotalSinImpuesto>
      <impuestos>
        <impuesto>
          <codigo>2</codigo>
          <codigoPorcentaje>2</codigoPorcentaje>
          <tarifa>12.00</tarifa>
          <baseImponible>1.43</baseImponible>
          <valor>0.17</valor>
        </impuesto>
      </impuestos>
    </detalle>
  </detalles>
  <infoAdicional>
    <campoAdicional nombre='Direccion'>Planw</campoAdicional>
    <campoAdicional nombre='Email'>l@gmail.com</campoAdicional>
  </infoAdicional>
  </factura>";
        
$res = $procesarComprobanteElectronico->procesarXML($procesarXML);

var_dump($res);

