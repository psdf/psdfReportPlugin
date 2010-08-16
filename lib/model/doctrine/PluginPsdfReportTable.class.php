<?php

/**
 */
class PluginPsdfReportTable extends Doctrine_Table {

    const TO_PDF = 'pdf';
    const TO_HTML = 'html';

    /**
     * Ubica un reporte por el nombre o el id.
     * 
     * @param string $key Id o Nombre del reporte
     * @return psdfReport Objeto psdfReport o false
     */
    static public function getByNameOrId($key) {
        if (is_numeric($key)) {
            $rep = Doctrine_Core::getTable('psdfReport')
                            ->find($key);
        } else {
            $rep = Doctrine_Core::getTable('psdfReport')
                            ->findByName($key);
        }
        if( is_array($rep) ) {
            if( count($rep)>0 ) {
                $rep = $rep[0];
            }
        }

        return $rep;
    }

}