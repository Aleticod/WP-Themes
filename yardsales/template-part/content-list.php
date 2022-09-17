<?php 

$products = new WP_Query(array( 
    'post_type' => array('product'),
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
));

?>

<div class="productos__container">
    <?php if($products->have_posts()): ?>
        <?php while($products->have_posts()): $products->the_post(); ?>
            <div class="productos__card">
                <div class="producto__imagen">
                    <?php the_post_thumbnail('medium') ?>
                </div>
                <div class="producto__caption">
                    <div class="productos__desc">
                        <a class="producto__link" href="<?php the_permalink(); ?>">
                            <h4 class="productos__titulo"><?php the_title() ?></h4>
                            <h4 class="productos__titulo"><?php the_content() ?></h4>
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>