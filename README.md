# PLUGIN DWBA LOGIN
Este plugin ofrece funcionalidades útiles para el login y reedirecciones en wordpress.


## Características

### Configuración de acceso a páginas por roles.
Controlar acceso a la página mediante roles con reedireccionamiento a la página de login.

!["Menu de configuración de la funcionalidad acceso a páginas por reles"](./assets/readme/acceso_login.webp)


## Información técnica

### Organización plugin
La estructura del proyecto se divide en:

- /func : funcionalidad, cada fichero con su metodo de activación, desactivación y desinstalación.
- /view : html
- fichero plugin para los hooks solo llamadas a funciones, no codigo.


### Acceso a una página

si la página tiene el campo `dwba_role_acces_login` significa que tiene control de acceso configurado, si no existe entonces es una pagina publica sin ninguna redirección.

El campo `dwba_role_acces_login` tiene como valor un array en texto con los roles que si tienen acceso.

Cuando no tienes acceso a una página, por el role o por no estar logueado, se te reedirige a la página de login.

