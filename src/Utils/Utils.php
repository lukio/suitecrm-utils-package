<?php

namespace Gcoop\Utils;

use Spatie\ArrayToXml\ArrayToXml;

final class Utils
{
    public static function generarteSoapXML(array $parameters, string $SOAPAction): string
    {
        $cleanXml = ArrayToXml::convert($parameters, $SOAPAction);
        $dom = new \DOMDocument();
        $dom->loadXml($cleanXml);
        $cleanXml = $dom->saveXML($dom->documentElement);
        $soapHeader = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                   <soapenv:Header/>
                   <soapenv:Body>';
        $soapFooter = '</soapenv:Body></soapenv:Envelope>';
        $xmlRequest = $soapHeader . $cleanXml . $soapFooter;
        return $xmlRequest;
    }


    public static function removeSOAPNamespaces(string $soapContent): string
    {
        return preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$3", $soapContent);
    }
}
