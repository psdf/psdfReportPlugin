<?php

class psdfReportPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    // Ruta al apache-tomcat donde en la subcarpeta webapps contiene el paquete jasperReports
    sfConfig::set('psdf_tomcat_dir', sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'/psdfReportPlugin/apache-tomcat-6.0.29');

    // Java inc que deben requerir los scripts php para acceder al jasperReport
    sfConfig::set('psdf_jasperreports_inc', 'http://localhost:8080/JasperReport/java/Java.inc');

    // Ruta donde almacenar y levantar los reportes y sus recursos
    sfConfig::set('psdf_reports_dir', sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'reports');
    sfConfig::set('psdf_reports_resource_dir', sfConfig::get('psdf_reports_dir').DIRECTORY_SEPARATOR.'img');
  }
}
