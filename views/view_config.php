
<h1>DWBA Login</h1>
<ul>
    <li><a href="https://hal21.es/">Dev hal21</a></li>
    <li><a href="https://dwba.es/">Dev Dwba</a></li>
</ul>
<br/>
<h2>Acceso Login</h2>
<p>Controlar que roles tienen permitido acceder a cada página, si no tienen permiso se reedirijen a la página de login.</p>
<p>Si no se marca ningún role en una página, entonces todos los usuarios `con login` o `sin login` podrán acceder.

<div class="dwbaLoginWP_form">
    </tr>

    <form id="dwbaLoginWP_config_form_form" action="<?php menu_page_url( 'DwbaLoginWP_Config_form' ) ?>" method="post">

        <?php wp_nonce_field('dwbaLoginWP_config_form_nonce', 'dwba_nonce'); ?>

        <fieldset>
            <table class="dwbaLoginWP_table">
                <th>ID</th>
                <th>STATUS</th>
                <th>TITLE</th>
                <th>ACCESO / ROLE</th>
                <th></th>
            <?php 
                
                $pages     = get_pages();
                $roles     = wp_roles()->roles;
              
                    foreach( $pages as $page ){
                         
                        ?>
                        <tr>    
                            <td class="dwbaLoginWP_config_data"><?php echo $page->ID?></td>
                            <td class="dwbaLoginWP_config_data"><?php echo $page->post_status?></td>
                            <td class="dwbaLoginWP_config_data"><?php echo $page->post_title?></td>
                         
                            <?php 
                            if( metadata_exists( 'post', $page->ID, 'dwba_role_acces_login' )){
                                //Pagina con acceso confifurado
                             
                            ?> 
                            
                                <?php 
                                    $roles_this_page = json_decode($page->dwba_role_acces_login);

                                    foreach($roles as $role){
                                        
                                        if(in_array($role["name"],$roles_this_page)){  
                                            ?>
                                            
                                            <td>

                                            <input type='checkbox'
                                                checked
                                                name = 'role[<?php echo $page->ID?>][]' 
                                                value='<?php echo esc_attr( $role['name'] ); ?>' 
                                                > <?php  echo $role["name"];  ?>

                                        </td>
                                                 
                                    <?php 
                                        }else{
                                            ?>
                                            <td>
                                            <input type='checkbox'
                                                name="role[<?php echo $page->ID; ?>][]"
                                                value='<?php echo esc_attr( $role['name'] ); ?>' 
                                                > <?php echo $role["name"]; ?>
                                             </td>
                                            <?php
                                        }
                                    }
                                ?>
                              
                            <?php
                                   
                            }else{
                                //Pagina con acceso sin configura
                                  foreach($roles as $role){ 
                               ?>
                                        <td>
                                            <input type='checkbox'
                                                name="role[<?php echo $page->ID; ?>][]"
                                                value='<?php echo esc_attr( $role['name'] ); ?>' 
                                                > <?php echo $role["name"]; ?>
                                        </td>
                                <?php
                                  }
                            }
                    }   ?>
                            
                        </tr>
            </table>    
        </fieldset>

        <br/>

        <input type="submit" value="Guardar"/>

    </form>

</div>

