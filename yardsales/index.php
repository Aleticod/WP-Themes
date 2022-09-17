<?php get_header() ?>

<?php if(have_posts()): ?>
    <?php while(have_posts()): the_post(); ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?php the_title() ?></h1>
                    <p><?php the_content() ?></p>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    
<?php endif; ?>

<?php get_template_part("template-part/content", "list"); ?>

<?php get_footer() ?>