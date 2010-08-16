<?php

require_once dirname(__FILE__).'/../lib/psdfReportGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/psdfReportGeneratorHelper.class.php';

/**
 * psdfReport actions.
 *
 * @package    psdf
 * @subpackage psdfReport
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class psdfReportActions extends autoPsdfReportActions
{
    public function executeRun($request) {
        try {
            if ( !$this->hasRequestParameter('id') )
                throw new sfException('No se especificó el Id o Nombre del reporte a ejecutar!');

            $rep = PluginPsdfReportTable::getByNameOrId($this->getRequestParameter('id'));

            if (!$rep)
                throw new sfException('No existe el reporte solicitado!');

            $rep->execute(PluginPsdfReportTable::TO_PDF);
        }
        catch( sfException $e) {
            $this->error = $e->getMessage();
            return sfView::ERROR;
        }
    }
}
