<?php

class psdfReportPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    // Ruta al apache-tomcat
    sfConfig::set('psdf_tomcat_dir', sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'/psdfReportPlugin/apache-tomcat-6.0.29');

    // Java include que deben requerir para acceder al jasperReport
    sfConfig::set('psdf_report_java_inc', 'http://localhost:8080/JasperReport/java/Java.inc');

    // Ruta a los reportes
    sfConfig::set('psdf_report_dir', sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'reports');

    // Ruta a los recursos de los reportes (imagenes, etc..)
    sfConfig::set('psdf_report_resource_dir', sfConfig::get('psdf_report_dir').DIRECTORY_SEPARATOR.'img');

  }
}
