<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
//include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once(get_stylesheet_directory() . '/lib/theme-defaults.php');

// Set Localization (do not remove).
add_action('after_setup_theme', 'genesis_sample_localization_setup');
function genesis_sample_localization_setup()
{
    load_child_theme_textdomain('genesis-sample', get_stylesheet_directory() . '/languages');
}

// Add the helper functions.
include_once(get_stylesheet_directory() . '/lib/helper-functions.php');

// Add Image upload and Color select to WordPress Theme Customizer.
require_once(get_stylesheet_directory() . '/lib/customize.php');

// Add Image SVG support.
require_once(get_stylesheet_directory() . '/lib/svg-support.php');

// Include Customizer CSS.
include_once(get_stylesheet_directory() . '/lib/output.php');

// Add WooCommerce support.
include_once(get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php');

// Add the required WooCommerce styles and Customizer CSS.
include_once(get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php');

// Add the Genesis Connect WooCommerce notice.
include_once(get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php');

// Child theme (do not remove).
define('CHILD_THEME_NAME', 'Genesis Sample');
define('CHILD_THEME_URL', 'http://www.studiopress.com/');
define('CHILD_THEME_VERSION', '2.3.0');

// Enqueue Scripts and Styles.
add_action('wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles');
function genesis_sample_enqueue_scripts_styles()
{


    //slick resources
    wp_enqueue_style('slick-styles', get_stylesheet_directory_uri() . '/css/css/slick.css', array(), CHILD_THEME_VERSION);
    wp_enqueue_script('slick-script', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), CHILD_THEME_VERSION, true);
    wp_enqueue_script('slick-custom', get_stylesheet_directory_uri() . '/js/slick-custom.js', array('jquery'), CHILD_THEME_VERSION, true);


    wp_enqueue_style('genesis-sample-fonts', 'https://use.typekit.net/meq7dmc.css', array(), CHILD_THEME_VERSION);
    wp_enqueue_style('sample-fonts', 'https://use.typekit.net/ckh8eqx.css', array(), CHILD_THEME_VERSION);
    wp_enqueue_style('sample-new-fonts', 'https://use.typekit.net/gfu2nwl.css', array(), CHILD_THEME_VERSION);
    wp_enqueue_style('genesis-custom-style-found', get_stylesheet_directory_uri() . '/css/css/foundation.css', array());
    wp_enqueue_style('genesis-custom-style', get_stylesheet_directory_uri() . '/css/css/custom.css', array());
    wp_enqueue_style('fancybox-style', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), CHILD_THEME_VERSION);


    wp_enqueue_style('dashicons');


    $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

    wp_enqueue_script('fancybox-script', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', null, '1', true);
    wp_enqueue_script('jarallax', get_stylesheet_directory_uri() . '/js/plugins/jarallax.min.js', null, '1.12.0', true);
    wp_enqueue_script('jarallax_element', get_stylesheet_directory_uri() . '/js/plugins/jarallax-element.esm.js', null, '1.12.0', true);


    wp_enqueue_script('custom', get_stylesheet_directory_uri() . "/js/custom.js", array('jquery'), CHILD_THEME_VERSION, true);

    wp_enqueue_script('genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array('jquery'), CHILD_THEME_VERSION, true);
    wp_localize_script(
        'genesis-sample-responsive-menu',
        'genesis_responsive_menu',
        genesis_sample_responsive_menu_settings()
    ); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,400;0,700;1,400;1,700&family=League+Spartan:wght@700&display=swap"
          rel="stylesheet">
<?php }

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings()
{

    $settings = array(
        'mainMenu' => __('Menu', 'genesis-sample'),
        'menuIconClass' => 'dashicons-before dashicons-menu',
        'subMenu' => __('Submenu', 'genesis-sample'),
        'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
        'menuClasses' => array(
            'combine' => array(
                '.nav-primary',
                '.nav-header',
            ),
            'others' => array(),
        ),
    );

    return $settings;

}

// Add HTML5 markup structure.
add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

// Add Accessibility support.
add_theme_support('genesis-accessibility', array('404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links'));

// Add viewport meta tag for mobile browsers.
add_theme_support('genesis-responsive-viewport');

// Add support for custom header.
//add_theme_support('custom-header', array(
//    'width' => 600,
//    'height' => 160,
//    'header-selector' => '.site-title a',
//    'header-text' => false,
//    'flex-height' => true,
//));

// Add support for custom background.
add_theme_support('custom-background');

// Add support for after entry widget.
add_theme_support('genesis-after-entry-widget-area');

// Add support for 3-column footer widgets.
add_theme_support('genesis-footer-widgets', 3);

// Add Image Sizes.
add_image_size('featured-image', 720, 400, TRUE);

// Rename primary and secondary navigation menus.
add_theme_support('genesis-menus', array('primary' => __('After Header Menu', 'genesis-sample'), 'secondary' => __('Footer Menu', 'genesis-sample')));

// Reposition the secondary navigation menu.
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_footer', 'genesis_do_subnav', 5);

// Reduce the secondary navigation menu to one level depth.
add_filter('wp_nav_menu_args', 'genesis_sample_secondary_menu_args');
function genesis_sample_secondary_menu_args($args)
{

    if ('secondary' != $args['theme_location']) {
        return $args;
    }

    $args['depth'] = 1;

    return $args;

}

// Modify size of the Gravatar in the author box.
add_filter('genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar');
function genesis_sample_author_box_gravatar($size)
{
    return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter('genesis_comment_list_args', 'genesis_sample_comments_gravatar');
function genesis_sample_comments_gravatar($args)
{

    $args['avatar_size'] = 60;

    return $args;

}

// BEGIN FOOTER
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);


function wpb_footer_creds_text()
{
    $copyright = '';
    return $copyright;
}

add_filter('genesis_footer_creds_text', 'wpb_footer_creds_text');


/**
 * Format phone number, trim all unnecessary characters
 *
 * @param string $string Phone number
 *
 * @return string Formatted phone number
 */
function sanitize_number($string)
{
    return preg_replace('/[^+\d]+/', '', $string);
}

add_filter('genesis_markup_title-area_close', 'insert_html_after_title_area_markup', 10, 2);
/**
 * Appends HTML to the closing markup for .title-area.
 *
 * @param string $close_html HTML tag being processed by the API.
 * @param array $args Array with markup arguments.
 *
 * @return string
 */
function insert_html_after_title_area_markup($close_html, $args)
{
    $header_phone = get_field('header_phone', 'options');
    $header_button = get_field('header_button', 'options');
    $header_button_url = is_page_template('templates/template-about.php') ? get_site_url() . '/contact/' : $header_button['url'];
    $header_text = get_field('next_to_logo_text', 'options');

    if ($close_html) {
        $additional_html = '<div class="next-to-logo-text">' . $header_text . '</div><div class="contact-wrap">

        <a class="header_phone" href="tel:' . sanitize_number($header_phone) . '">' . $header_phone . '</a>
        
        <a class="button button--blue header-contact" href="' . $header_button_url . '">' . $header_button['title'] . '</a>

    </div>';

        $close_html = $close_html . $additional_html;
    }

    return $close_html;
}

// Customize site footer
add_action('genesis_footer', 'sp_custom_footer');

function sp_custom_footer()
{ ?>
    <div class="site-footer__inner">
        <div class="footer__row">
            <div class="footer__content">
                <div class="footer__content-wrapper">


                    <?php if ($footer_logo = get_field('logo_text', 'option')): ?>
                        <div class="footer__logo">
                            <h2><?php echo $footer_logo ?></h2></div>
                    <?php endif; ?>
                    <?php $image = get_field('footer_logo', 'option');
                    if (!empty($image)): ?>
                        <div class="footer__logo">
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                        </div>
                    <?php endif; ?>
                    <?php if (get_field('address_link', 'option') || get_field('address_text', 'option')):
                        $text = get_field('address_text', 'option') ? get_field('address_text', 'option') : 'Address'; ?>
                        <a href="<?php echo get_field('address_link', 'option') ?>" target="_blank"
                           class="footer__address"><?php echo $text ?></a>
                    <?php endif; ?>

                    <?php if (have_rows('social_icons', 'option')) : ?>
                        <ul class="socials">
                            <?php while (have_rows('social_icons', 'option')) : the_row(); ?>
                                <?php
                                $social_icon = get_sub_field('social_icon');
                                $social_link = get_sub_field('social_link');
                                ?>
                                <li>
                                    <a class="social-icon" href="<?php echo $social_link; ?>" target="_blank">
                                        <img src="<?php echo $social_icon['url']; ?>"
                                             alt="<?php echo $social_icon['alt']; ?>">
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if (get_field('copyright', 'option')): ?>
                        <div class="copyright">
                            <?php the_field('copyright', 'option') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($form = get_field('form_home_page', 'option')): ?>
                <div class="footer__form">
                    <div class="footer__form-wrapper">
                        <?php echo $form ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

<?php }

// END FOOTER


/**
 * Custom styles in TinyMCE
 *
 * @param array $buttons
 *
 * @return array
 */

function custom_style_selector($buttons)
{
    array_unshift($buttons, 'styleselect');

    return $buttons;
}

add_filter('mce_buttons_2', 'custom_style_selector');

function insert_custom_formats($init_array)
{
    // Define the style_formats array
    $style_formats = array(
        array(
            'title' => 'Heading 1',
            'classes' => 'h1',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 2',
            'classes' => 'h2',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 3',
            'classes' => 'h3',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 4',
            'classes' => 'h4',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 5',
            'classes' => 'h5',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 6',
            'classes' => 'h6',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Button',
            'classes' => 'button',
            'selector' => 'a',
            'wrapper' => false,
        ),


    );
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;

}

add_filter('tiny_mce_before_init', 'insert_custom_formats');

add_editor_style();

// Disable gutenberg
add_filter('use_block_editor_for_post_type', '__return_false', 10);


if (function_exists('acf_add_options_page')) {

    acf_add_options_page('Theme Settings');

}

function themeprefix_search_button_text($text)
{
    return ('');
}

add_filter('genesis_search_text', 'themeprefix_search_button_text');


add_filter('genesis_pre_get_option_content_archive_limit', 'hs_content_limit');
function hs_content_limit()
{
    return '150'; // number of characters
}

// Custom Logo
add_theme_support('custom-logo', array(
    'height' => '150',
    'flex-height' => true,
    'flex-width' => true,
));

function show_custom_logo($size = 'medium')
{
    if ($custom_logo_id = get_theme_mod('custom_logo')) {
        $attachment_array = wp_get_attachment_image_src($custom_logo_id, $size);
        $logo_url = $attachment_array[0];
    } else {
        $logo_url = get_stylesheet_directory_uri() . '/images/custom-logo.png';
    }
    $logo_image = '<img src="' . $logo_url . '" class="custom-logo" itemprop="siteLogo" alt="' . get_bloginfo('name') . '">';
    $html = sprintf('<a href="%1$s" class="custom-logo-link" rel="home" title="%2$s" itemscope>%3$s</a>', esc_url(home_url('/')), get_bloginfo('name'), $logo_image);
    echo apply_filters('get_custom_logo', $html);
}

function my_login_logo_one()
{
    if ($custom_logo_id = get_theme_mod('custom_logo')) {
        $attachment_array = wp_get_attachment_image_src($custom_logo_id, $size);
        $logo_url = $attachment_array[0];
    } else {
        $logo_url = get_stylesheet_directory_uri() . '/images/custom-logo.png';
    }
    ?>

    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo $logo_url?>);
            padding-bottom: 30px;
            background-size: contain;
            width: 300px;

        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'my_login_logo_one');

// add excerpts search page result
add_action('genesis_before_loop', 'sk_excerpts_search_page');
function sk_excerpts_search_page()
{
    if (is_search()) {
        add_filter('genesis_pre_get_option_content_archive', 'sk_show_excerpts');
    }
}

function sk_show_excerpts()
{
    return 'excerpt';
}

add_action('plugins_loaded', 'ao_defer_inline_init');
function ao_defer_inline_init()
{
    if (get_option('autoptimize_js_include_inline') != 'on') {
        add_filter('autoptimize_html_after_minify', 'ao_defer_inline_jquery', 10, 1);
    }
}

function ao_defer_inline_jquery($in)
{
    if (preg_match_all('#<script.*>(.*)</script>#Usmi', $in, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            if ($match[1] !== '' && (strpos($match[1], 'jQuery') !== false || strpos($match[1], '$') !== false)) {
                // inline js that requires jquery, wrap deferring JS around it to defer it.
                $new_match = 'var aoDeferInlineJQuery=function(){' . $match[1] . '}; if (document.readyState === "loading") {document.addEventListener("DOMContentLoaded", aoDeferInlineJQuery);} else {aoDeferInlineJQuery();}';
                $in = str_replace($match[1], $new_match, $in);
            } else if ($match[1] === '' && strpos($match[0], 'src=') !== false && strpos($match[0], 'defer') === false) {
                // linked non-aggregated JS, defer it.
                $new_match = str_replace('<script ', '<script defer ', $match[0]);
                $in = str_replace($match[0], $new_match, $in);
            }
        }
    }
    return $in;
}

function year_shortcode()
{
    $year = date('Y');
    return $year;
}

add_shortcode('year', 'year_shortcode');

//* Modify the Genesis content limit read more link
add_filter('get_the_content_more_link', 'sp_read_more_link');
function sp_read_more_link()
{
    return '... <a class="more-link button" href="' . get_permalink() . '">Read More</a>';
}

function gngf_filter_posts_scripts()
{

    wp_localize_script('custom', 'gngf_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        )
    );
}

add_action('wp_enqueue_scripts', 'gngf_filter_posts_scripts', 100);
function gngf_filter_get_posts($taxonomy)
{

    $category = $_POST['category'];
    $paged = $_POST['paged'];
    $paged = !empty($paged) ? (int)$paged : 1;
    $category = !empty($category) && $category != '-1' ? array(
        'taxonomy' => 'faqs_category',                //(string) - Taxonomy.
        'field' => 'slug',                    //(string) - Select taxonomy term by ('id' or 'slug')
        'terms' => $category,    //(int/string/array) - Taxonomy term(s).
    ) : '';

    $args = array(
        'post_type' => 'faq',
        'post_status' => 'publish',
        'tax_query' => array(
            $category,
        ),
        'posts_per_page' => get_option('posts_per_page'),
        'paged' => $paged,
    );
    if (!$taxonomy) {
        unset($args['tag']);
    }
    $wp_query = new WP_Query($args);
    if ($wp_query->have_posts()) : ?>
        <?php while ($wp_query->have_posts()) : $wp_query->the_post();
            get_template_part('parts/faqs/faq-item');
        endwhile; ?>
        <?php
        $paginateArgs = array(
            'base' => '%#%',
            'format' => '%#%',
            'current' => $paged,
            'prev_next' => false,
            'total' => $wp_query->max_num_pages
        ); ?>
        <div class="cn-pagination">
            <?php echo str_replace(array('http:', '//'), array('', ''), paginate_links($paginateArgs)); ?>
        </div>
    <?php else: ?>
        <h2><?php _e('No posts found', 'default'); ?></h2>
    <?php endif;

    wp_die();
}

add_action('wp_ajax_filter_posts', 'gngf_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'gngf_filter_get_posts');

/** CSS Cache Buster */
//remove style.css version
add_filter('style_loader_src', 'sdt_remove_ver_css_js', 9999, 2);
add_filter('script_loader_src', 'sdt_remove_ver_css_js', 9999, 2);

function sdt_remove_ver_css_js($src, $handle)
{
    $handles_with_version = ['genesis-sample']; // <-- Adjust to your needs!

    if (strpos($src, 'ver=') && !in_array($handle, $handles_with_version, true))
        $src = remove_query_arg('ver', $src);

    return $src;
}


define('CHILD_THEME_VERSION', filemtime(get_stylesheet_directory() . '/style.css'));

add_filter('stylesheet_uri', 'child_stylesheet_uri');
/**
 * Cache bust the style.css reference.
 *
 */
function child_stylesheet_uri($stylesheet_uri)
{
    return add_query_arg('v', filemtime(get_stylesheet_directory() . '/style.css'), $stylesheet_uri);
}


//Breadcrumbs
add_filter('wpseo_breadcrumb_links', 'wpseo_breadcrumb_remove_limited');

function wpseo_breadcrumb_remove_limited($links)
{
    if (is_singular('testimonial')) {
        $breadcrumb[] = array(
            'url' => site_url('/testimonials/'),
            'text' => 'Testimonials',
        );
        array_splice($links, 1, -1, $breadcrumb);
    }
    if (is_singular('team')) {
        $breadcrumb[] = array(
            'url' => site_url('/team/'),
            'text' => 'Attorneys',
        );
        array_splice($links, 1, -1, $breadcrumb);
    }
    if (is_singular('faq')) {
        $breadcrumb[] = array(
            'url' => site_url('/faqs/'),
            'text' => 'FAQs',
        );
        array_splice($links, 1, -1, $breadcrumb);
    }
    if (is_singular('staff')) {
        $breadcrumb[] = array(
            'url' => site_url('/staff/'),
            'text' => 'Staff',
        );
        array_splice($links, 1, -1, $breadcrumb);
    }
    return $links;
}

function retrieve_latest_gform_submissions() {
    $site_url = get_site_url();
    $search_criteria = [
        'status' => 'active'
    ];
    $form_ids = 1; //search all forms
    $sorting = [
        'key' => 'date_created',
        'direction' => 'DESC'
    ];
    $paging = [
        'offset' => 0,
        'page_size' => 5
    ];
    
    $submissions = GFAPI::get_entries($form_ids, null, $sorting, $paging);
    $start_date = date('Y-m-d H:i:s', strtotime('-5 day'));
    $end_date = date('Y-m-d H:i:s');
    $entry_in_last_5_days = false;
    
    foreach ($submissions as $submission) {
        if( $submission['date_created'] > $start_date  && $submission['date_created'] <= $end_date ) {
            $entry_in_last_5_days = true;
        } 
    }
    if( !$entry_in_last_5_days ) {
        wp_mail('webdev@postali.com', 'Submission Status', "No submissions in last 5 days on $site_url");
    }
}
add_action('check_form_entries', 'retrieve_latest_gform_submissions');