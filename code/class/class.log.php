<?php    
    include_once('../global.php');
    class log extends persist{ 
        private string $folder = 'dataFiles';
        private string $filename;
        static private $ptr_container = null;
        static $local_filename = "log.txt";
        private array $logs = array();

        static public function getFilename() {
            return get_called_class()::$local_filename;
        }

        private function __construct() { 

        }

        static function getInstance() {
            if ( self::$ptr_container == null )
                self::$ptr_container = new log();

            return self::$ptr_container;
        }

        public function addLog(string $p_logText ) {
            array_push( $this->logs, $p_logText );
        }
    }
