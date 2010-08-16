<?php

class psdfStartTomcatJavabridgeTask extends sfBaseTask
{
  public function configure()
  {
    $this->namespace = 'psdf';
    $this->name      = 'start-tomcat-javabridge';
    $this->briefDescription    = 'Inicia el apache tomcat con las librerias javabridge y jasperReports';
    $this->detailedDescription = <<<EOF
La Tarea [psdf:start-tomcat-javabridge|INFO] inicia el apache tomcat con las librerias javabridge jasperReports
para a continuacion poder ejecutar los reportes. Esta tarea es para fines de desarrollo.
En producción es recomendable dejar iniciado desde un cron del SO:

  [./symfony psdf:start-tomcat-javabridge|INFO]

EOF;

  }

  public function execute($arguments = array(), $options = array())
  {
    // Conexión por defecto inicial en databases.yml
    $connection_default = 'psdf';

    $this->logSection('psdf', 'Iniciando tomcat con javabridge/jasperReports...');
    $this->logSection('psdf', '(Esta tarea es con fines de uso en desarollo, en producción se recomienda manejarlo por el SO)');
    $this->logSection('psdf', 'Para finalizar en otra consola ejecutar tarea psdf:stop-tomcat-javabridge...');
    
    // Comando: /path/to/apache-tomcat/bin/catalina.sh run
    $cmd = sfConfig::get('psdf_tomcat_dir').'/bin/catalina.sh run';

    exec($cmd);
  }
}

?>