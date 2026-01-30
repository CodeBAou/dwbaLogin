<?php 

/**
* MENU TOP LEVEL  - CONFIGURACIÓN WORDPRESS
*/


/**
 * Aqui se llama todas las funciones de configuracion que se deben llamar al activar el plugin
 */
function dwbaLoginWP_Configphp_activate(){

}

function dwbaLoginWP_Configphp_desactivate(){

}

function dwbaLoginWP_Config_del_dwba_role_acces_login(){
    //Elimina el campo dwba_acces_login de la base de datos
     $pages = get_pages();
   
    foreach ( $pages as $page ) {
         if ( !metadata_exists( 'post', get_the_ID(), 'dwba_role_acces_login' ) ) {
            delete_post_meta( $page->ID, 'dwba_role_acces_login' );
            
         }
    }
}

function dwbaLoginWP_RegisterMenu_Config(){

    add_menu_page(
        "DWBA LOGIN TOOLS",
        "Dwba Login",
        "manage_options",
        "DwbaLoginWP_Options",
        "dwbaLoginWP_Page_Config_HTML_1",
        null,
        20
    );
}

/**
* Para manejar el formulario de la página del menu del plugin.
*/
function dwbaLoginWP_Page_Config_HTML_1(){
 
    //Procesamiento del formulario
    if (
        //Seguridad nonce del formulario
        $_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['dwba_nonce']) &&
        wp_verify_nonce($_POST['dwba_nonce'], 'dwbaLoginWP_config_form_nonce')
    ) {

    //Delete 
    dwbaLoginWP_Config_del_dwba_role_acces_login();
    
    // Obtener todos los roles enviados
    $roles_por_pagina = $_POST['role'] ?? [];
   
    //Se recorre
    foreach( $roles_por_pagina as $page_id => $roles ){
       
        $page_id     = intval($page_id); // asegurar que es entero
        $roles_aux   = array_map('sanitize_text_field', array_filter($roles)); // limpiar

        if (empty($roles)) {
            // Si no hay roles marcados, eliminamos el meta → página pública
            delete_post_meta($page_id, 'dwba_role_acces_login');
        } else {
            delete_post_meta($page_id, 'dwba_role_acces_login');
            // Guardar los roles seleccionados en el meta
            update_post_meta($page_id, 'dwba_role_acces_login',json_encode($roles) );
        }
    }
   
    ?> 
        <p class="message_succes" style="color:green; font-size:30px;">Se ha actualizado...</p>
    <?php
    }


    
    //Imprime el html del frontend en la página
    include plugin_dir_path( __FILE__ ) . '../views/view_config.php';
    
}

function dwbaLoginWP_refreco_pagina(){
     // 3. Redirigir a la misma página para "refrescar"
    $url = menu_page_url('DwbaLoginWP_Options', false); // slug de tu menú
    wp_redirect( $url );
    exit; // siempre salir después de redirigir
}

?>