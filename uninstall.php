<?php 
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}
error_log("unistall");

// Includes
$path_config = plugin_dir_path( __FILE__ ) . 'func/config.php';

if ( file_exists( $path_config ) ) {
  include_once $path_config;
} else {
  error_log( 'No se ha podido incluir func/config.php' );
}

// Elimina la metadata 'dwba_role_acces_login'
dwbaLoginWP_Config_del_dwba_role_acces_login();

?>