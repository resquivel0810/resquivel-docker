<div style="display: flex; margin-top:100px; width: 30%; justify-content: space-between;">
    <span class="date"><?php the_date(); ?></span>
    <span class="tag"> <?php the_tags(); ?> </span>
    <span class="comment"><a href="#comments"><?php comments_number(); ?></a></span>
</div>

<?php
the_content(); 
?>

<?php
comments_template();
?>