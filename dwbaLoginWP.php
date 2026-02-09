<?php
/**
* Plugin Name: dwbaLoginWP
* Description: Un bloque para aplicar login y control de acceso a wordpress desde cualquier página.
* Author: dwba.es
* Author URI: 
* Version: 1.0.1
* Requires at least: 6.9
* Requires PHP:      8.2
* slugn colisions  :   dwbaLoginWP_
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

//Dependencias
$path_config = plugin_dir_path( __FILE__ ) . 'func/config.php';

if ( file_exists( $path_config ) ) {
  include_once $path_config;
} else {
  error_log( 'No se ha podido incluir func/config.php' );
}

$path_auth = plugin_dir_path( __FILE__ ) . 'func/auth.php';

if ( file_exists( $path_auth) ) {
  include_once $path_auth;
} else {
  error_log( 'No se ha podido incluir func/auth.php' );
}


//REGISTRO PAGINA CONFIGURACION MENU 
add_action( 'admin_menu', 'dwbaLoginWP_RegisterMenu_Config' );

add_action( 'admin_enqueue_scripts', function(){
    wp_enqueue_style(
        'dwbaLoginWP_viewconfig_css',
        plugin_dir_url( __FILE__ ) . '/assets/css/view_config.css',
        [],
        '1.0'
    );
} );

//REDIRECCION SEGUN LA CONFIGURACIÓN DE ACCESO
add_action('template_redirect', 'DwbaLoginWP_Login_Page_Acces');



