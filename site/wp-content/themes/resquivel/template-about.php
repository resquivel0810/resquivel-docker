<?php
/**
* Template name: About
*
* Plantilla personalizada
*
* @package resquivel
* @subpackage resquivel
* @since 1.0
*/
?>

<?php 
get_header();
?>

<?php

    if( have_posts() ){
        while ( have_posts() ){
            the_post();
            the_content();
        }
    }

?>
</div>

<?php 
get_footer();
?>

