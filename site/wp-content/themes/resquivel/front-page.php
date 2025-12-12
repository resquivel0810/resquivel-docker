<?php
get_header();
?>


            
<div class="content">


    <div class="hero">
        <div class="image">
            <?php $hero_image= get_post_meta($post->ID, 'hero_image', true); ?> 
            <?php if ($hero_image)  ?>
            <?php echo '<img src="' .$hero_image.  '"' . '>'; ?>  
        </div>
        <div class="text">
            <?php $hero_text= get_post_meta($post->ID, 'hero_text', true); ?> 
            <?php if ($hero_text)  ?>
            <?php echo '<h1>' .$hero_text. '</h1>'; ?>     
        </div>
    </div>
    <div>
        <h2 >últimas publicaciones</h2>
      
        

        

        <?php 
   // the query
   $the_query = new WP_Query( array(
     'category_name' => '',
      'posts_per_page' => 3,
   )); 
?>

<?php if ( $the_query->have_posts() ) : ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="post">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="image">
        <div class="post-body">
            <h3><?php the_title(); ?> </h3>
            <div class=""><span class="post-date"><?php the_date() ?></span><span class="comment"><a href="#"><?php comments_number() ?></a></span></div>
            <div class="intro"><?php the_excerpt(); ?></div>
            <a class="more-link" href="<?php the_permalink() ?>">Leer más &rarr;</a>
        </div>
    </div>


  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>

<?php else : ?>
  <p><?php __('No se ha publicado nada'); ?></p>
<?php endif; ?>

       



    </div>
    
    
</div>
</div>
<?php
get_footer();
?>