<?php 
$path_config = plugin_dir_path( __FILE__ ) . 'config.php';

if ( file_exists( $path_config ) ) {
  include_once $path_config ;
} else {
  error_log( 'No se ha podido incluir config.php' );
}

dwbaLoginWP_Config_del_dwba_role_acces_login();

?>