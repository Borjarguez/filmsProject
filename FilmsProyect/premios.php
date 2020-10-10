<?php

$xml = new DOMDocument();
$xml->load('films.xml');

$xsl = new DOMDocument();
$xsl->load('premios.xsl');

$proc = new XSLTProcessor();
$proc->importStyleSheet($xsl);

echo $proc->transformToXML($xml);
