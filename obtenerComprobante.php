<?php

require './ProcesarComprobanteElectronicoConsulta.php';
$procesarComprobanteElectronico = new ProcesarComprobanteElectronico();
$obtenerComprobante = new obtenerComprobante();
$obtenerComprobante->claveAcceso = "2607201901175515467900120010010000000291234567814";
$obtenerComprobante->ambiente = "2";
$res = $procesarComprobanteElectronico->obtenerComprobante($obtenerComprobante);

var_dump($res);
