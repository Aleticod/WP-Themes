<?php 

function plz_assets() {
    wp_register_style('google', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700', array(), false, 'all');
    wp_register_style('google2', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;700&display=swap', array(), false, 'all');

    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css', array(), false, 'all');
    
    //wp_enqueue_style('estilos', get_template_directory_uri() . '/assets/css/style.css', array('google', 'bootstrap'), false, 'all');
    wp_enqueue_style('estilos', get_stylesheet_directory_uri() . '/assets/css/style.css', array('google', 'bootstrap'), false, 'all');

    wp_enqueue_script('yardsale-js', get_template_directory_uri() . '/assets/js/script.js', array(), false, true);

}

add_action('wp_enqueue_scripts', 'plz_assets');

function plz_analytics(){
    ?>
    <h3>Analytics</h3>
    <?php
}

add_action('wp_body_open', 'plz_analytics');

function plz_theme_supports() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('custom-header');
    add_theme_support('custom-background');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-list', 'comment-form', 'gallery', 'caption'));
    add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio'));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('starter-content');
}

add_action('after_setup_theme', 'plz_theme_supports');

function plz_add_menus() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'yardsales'),
        'footer-menu' => __('Footer Menu', 'yardsales'),
    ));
}

add_action('after_setup_theme', 'plz_add_menus');

function plz_add_sidebar() {
    register_sidebar(array(
        'name' => __('Sidebar', 'yardsales'),
        'id' => 'sidebar',
        'description' => __('Sidebar for the theme yardsales', 'yardsales'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'plz_add_sidebar');



function plz_custom_post_type() {
    $labels = array(
        'name' => 'Producto',
        'singular_name' => 'Producto',
        'all_items' => 'Todos los productos',
    );

    register_post_type('product', array(
        'labels' => $labels,
        'description' => 'Products for the theme yardsales',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'public' => true,
        'publicly_queryable' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'product'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'supports' => array('title', 'editor','author', 'thumbnail', 'custom-fields'),
        'taxonomies' => array('category', 'post_tag'),
        'can_export' => true,
        'publicly_queryable' => true,
        'rewrite' => true,
        'show_in_rest' => true,
    ));
}

//add_action('init', 'plz_custom_post_type');

function plz_add_to_signin_menu() {
    $current_user = wp_get_current_user();
    $user_email = is_user_logged_in() ? $current_user->user_email : 'Sign in';
    echo $user_email;
}

add_action('plz_signin', 'plz_add_to_signin_menu');
//add_action('plz_signin', 'storefront_header_container_close');
//add_action('plz_signin', 'storefront_primary_navigation_wrapper');
//add_action('plz_signin', 'storefront_product_search');

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

function plz_add_to_cart() {
    global $product;
    ?>
    <a href="<?= $product->add_to_cart_url() ?>" class="productos__add-to-cart">
        <img src="<?= get_stylesheet_directory_uri() ?>/assets/img/add-to-cart.svg" alt="carrito">
    </a>
    <?php
}

add_action('woocommerce_after_shop_loop_item', 'plz_add_to_cart', 10);

function plz_ws_share() {
    global $product;
    ?>
    <div class="productos__share">
        <a class="icons-consult" href="https://www.facebook.com/sharer/sharer.php?u=<?= get_permalink($product->get_id()) ?>" target="_blank">
            <img src="<?= get_stylesheet_directory_uri() ?>/assets/img/facebook.svg" alt="facebook">
        </a>
        <a class="icons-consult" href="https://twitter.com/intent/tweet?text=<?= get_permalink($product->get_id()) ?>" target="_blank">
            <img src="<?= get_stylesheet_directory_uri() ?>/assets/img/twitter.svg" alt="twitter">
        </a>
        <a class="icons-consult" href="https://wa.me/989273430?text=Quisiera%20sobre%20sobre%20este%20producto: <?= get_permalink($product->get_id()) ?>" target="_blank">
            <img src="<?= get_stylesheet_directory_uri() ?>/assets/img/whatsapp.svg" alt="whatsapp">
        </a>
    </div>
    <?php
}

add_action('woocommerce_after_shop_loop_item', 'plz_ws_share', 11);