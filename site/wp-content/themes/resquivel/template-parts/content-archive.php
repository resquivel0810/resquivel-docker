<div style="margin-top: 100px">
    <div class="post">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="image">
        <div class="post-body">
            <h3><?php the_title(); ?> </h3>
            <div class=""><span class="post-date"><?php the_date() ?></span><span class="comment"><a href="#"><?php comments_number() ?></a></span></div>
            <div class="intro"><?php the_excerpt(); ?></div>
            <a class="more-link" href="<?php the_permalink() ?>">Leer más &rarr;</a>
        </div>
    </div>
</div>
