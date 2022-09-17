<?php get_header() ?>

<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?php the_title() ?></h1>
                    <div class="col-12 col-md-6">
                        <?php the_content() ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php the_post_thumbnail('large') ?>
                    </div>
                    
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    
<?php endif; ?>

<?php get_footer() ?>