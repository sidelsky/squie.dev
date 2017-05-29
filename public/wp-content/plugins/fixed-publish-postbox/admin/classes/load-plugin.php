<?php

    /**
    * Require all functions within the functions folder
    */
    class LoadPlugin {

        public $folder;
        public $files;
        public $dir;

        public function getFunctions() {

            $folder = 'assets/functions/*.php';
            $files = glob(plugin_dir_path( __FILE__ ) . $folder);

            $file = 'assets/functions/*.php';
            $dir = plugins_url($file, __DIR__);

            echo $dir;

            foreach( $files as $file ) {
                require_once( $file );
            }

        }

    }

?>
