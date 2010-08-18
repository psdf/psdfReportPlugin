<?php

class psdfReportPluginUtil
{
    /**
     * Recupera los datos de la conexion asociada a la consulta. Lee de databases.yml
     * cuyo formato es:
     *
     * all:
     *   psdf:
     *     class: sfDoctrineDatabase
     *     param:
     *       dsn:      pgsql:host=localhost;dbname=psdf
     *       username: desa
     *       password: desa
     *
     * @param string $ent Entorno, por defecto para todos (all)
     * @return array Datos de la conexion
     */
    static public function dataConnection( $connection=null, $ent='all' ) {

        $arrayYml = sfYaml::load(sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'databases.yml');

        // Si no especifico conexión tomo la 1ra informada para el entorno
        $con = $connection;
        if( $connection==null ) {
            $keys = array_keys($arrayYml[$ent]);
            $con = $keys[0];
        }

        $dsn = $arrayYml[$ent][$con]['param']['dsn']; // tengo pgsql:host=localhost;dbname=psdf
        $dsn = substr($dsn, strpos($dsn, ':')+1); // tengo host=localhost;dbname=psdf
        $aux = explode(";", $dsn); // tengo 0=>host=localhost y 1=>dbname=psdf
        $aux1 = explode('=', $aux[0]);
        $aux2 = explode('=', $aux[1]);

        $data['host'] = $aux1[1]?$aux1[1]:'';
        $data['dbname'] = $aux2[1]?$aux2[1]:'';
        $data['username'] = $arrayYml[$ent][$con]['param']['username'];
        $data['password'] = $arrayYml[$ent][$con]['param']['password'];

        return $data;
    }

    /**
     * Permite descargar un archivo.
     * Uso: psdfReportPluginPsdf::download('/path/to/foo.zip')
     * fuente: http://www.webcomparte.com/foro/programacion-en-php/descargar-archivos-y-directorios-en-php/
     * @param string $ruta Ruta del archivo a descargar
     * @param string $nombre_archivo (opcional) Nombre de archivo con que 
     *                  descargar sinó toma el de descarga.
     * @return boolean
     */
    static public function download($ruta, $nombre_archivo = false) {
        if(!is_dir($ruta) and !is_file($ruta)) {
            return false; /* La ruta no existe */
        }
        if(headers_sent())
            return false; /* Los headers ya fueron enviados */
        if(!$handle = @fopen($ruta, 'r'))
            return false; /* Imposible abrir el archivo */
        header('Content-type: application/force-download');
        if($nombre_archivo) { /* Se ha elegido un nombre de archivo para la descarga */
            header('Content-Disposition: attachment; filename='.urlencode($nombre_archivo));
        }else { /* Se utilizará el nombre de archivo original por defecto */
            header('Content-Disposition: attachment; filename='.urlencode(basename($ruta)));
        }
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.filesize($ruta));
        while(!feof($handle)) {
            echo fread($handle, 1024); /* Escribe el archivo cada 1024 bites para evitar un DOS */
        }
        fclose($handle);

        exit;
    }
}
?>