<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function ExistSession(){
	$user_id  = get_current_user_id();
    $sessions = WP_Session_Tokens::get_instance( $user_id ) -> get_all();
}


/**
* Configura el acceso a las páginas por role
*/
function DwbaLoginWP_Login_Page_Acces($array_pages){

    if ( ! is_page() ) return; // solo páginas

    //Obtener la lista roles permitidos en la página
    global $post;
    

    //No existe el campo, por lo que la página no tiene ninguna restrincción aplicada
    if ( ! metadata_exists( 'post', $post->ID, 'dwba_role_acces_login')  ){

        // no existe metadata dwba_role_acces_login, la página no tiene control de acceso es pública
        return;

    }else{

        // Usuario no logueado → redirigir al login
        if ( ! is_user_logged_in() ) {
            //La página necesita permisos de login y el usuario no está logueado
            wp_redirect( wp_login_url( get_permalink() ) );
            exit;
        }

        //Obtener lista de roles permitidos para la página actual
        $allowed_roles = json_decode(get_post_meta( $post->ID, 'dwba_role_acces_login', true ));

        //Obtener lista de roles del usuario
        $user       = wp_get_current_user();
        $user_roles = (array) $user->roles;
        $coinciden  = array_intersect( array_map('strtolower', $user_roles), array_map('strtolower', $allowed_roles) ); //Array de valores que coinciden en los 2 arrays

        //intersect busca coincidencias entre las listas de roels
        if ( count($coinciden) == 0 ) {
            // No hay coincidencias en los roles, el usuario no tiene permiso para entrar en la pagina

            //echo "ROLES NO COINCIDEN";
            wp_redirect( wp_login_url( ) );
             
        }else{
            //Hay coincidencias en roles, el usuario puede ver la página
            //echo "ROLES COINCIDEN";
            $url = get_permalink( $post->ID );
            error_log($url);
        }
    }
}