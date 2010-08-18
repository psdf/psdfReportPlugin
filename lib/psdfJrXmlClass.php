<?php

class psdfJrXml {

    var $xml = null;
    var $xp = null;
    var $file = false;

    public function  __construct($xml=false) {
        if( $xml ) {
            return $this->load($xml);
        }
    }

    public function load( $xml ) {
        $this->xml = new DOMDocument();
        // Determino si levanto de un archivo o un string
        if( file_exists($xml) ) {
            $ret = $this->xml->load($xml);
            $this->file = $xml; // Puede servirme mantenerlo
        }
        else {
            $ret = $this->xml->loadXML($xml);
            $this->file = false;
        }
        if( !$ret ) {
            $this->file = false;
            return false;
        }
        // Dejo ya instanciado el objeto para tratamiento xpath
        $this->xp = new domxpath( $this->xml );

        return true;
    }

    /**
     * Corrige el path de las imagenes que tenga el reporte
     * de "foo.png" pasaria a "/path/to/foo.png"
     *
     * @param string $name Nombre del atributo
     * @param value $name valor del atributo, a setear.
     * @param constante $type Nivel donde setear (paquete, proceso o actividad)
     * @param array $parent Id de proceso y actividad si tengo que recuperar el atributo
     *                       de uno de ellos.
     * @return none
     */
    public function fixPathImages($path) {

        $nodeList = $this->xml->getElementsByTagName( 'imageExpression' );
        foreach($nodeList as $node ) {

            //echo $node->nodeValue.'</br>';

            // Ultima posición es el nombre del archivo
            $parts = explode(DIRECTORY_SEPARATOR, $node->nodeValue);
            $filename = $parts[count($parts)-1];
            $node->removeChild($node->firstChild);
            $ct = $this->xml->createCDATASection('"'.$path.DIRECTORY_SEPARATOR.$filename);
            $node->appendChild($ct);

            //echo $node->nodeValue.'</br>';
            //die('::');
        }
    }

    public function getElementsByQuery( $xpath ) {
        return $this->xp->query( $xpath );
    }

    public function getContent() {
        $content = $this->xml->saveXML();
        return $content;
    }

    /**
     * Actualiza el archivo con el contenido actual del xpdl. Esto si previamente
     * fue levantado desde un archivo
     */
    public function file_save() {
        if( $this->file ) {
            $data = $this->getContent();
            file_put_contents($this->file, $data);
        }
    }

}

?>