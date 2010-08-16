<?php

class psdfStopTomcatJavabridgeTask extends sfBaseTask
{
  public function configure()
  {
    $this->namespace = 'psdf';
    $this->name      = 'stop-tomcat-javabridge';
    $this->briefDescription    = 'Para el apache tomcat con las librerias javabridge y jasperReports';
    $this->detailedDescription = <<<EOF
La Tarea [psdf:stop-tomcat-javabridge|INFO] para el apache tomcat con las librerias javabridge jasperReports
para cuando fuese iniciado con la tarea psdf:start-tomcat-javabridge:

  [./symfony psdf:start-tomcat-javabridge|INFO]

EOF;

  }

  public function execute($arguments = array(), $options = array())
  {
    // Conexión por defecto inicial en databases.yml
    $connection_default = 'psdf';

    $this->logSection('psdf', 'Finalizando tomcat con javabridge/jasperReports...');
    
    // Comando: /path/to/apache-tomcat/bin/catalina.sh run
    $cmd = sfConfig::get('psdf_tomcat_dir').'/bin/catalina.sh stop';

    exec($cmd);
  }
}

?>