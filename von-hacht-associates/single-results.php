<?php get_header(); ?>

<section class="banner banner-single-post">
    <div class="featured-img-hone">
        <?php $featured_img = get_field('case_results_banner_image', 'options'); if($featured_img) {
            echo wp_get_attachment_image( $featured_img['ID'], 'full' );
        } ?>
    </div>    
    <div class="banner__content">
        <h1 class="banner__title"><?php the_field('case_results_title', 'options'); ?></h1>
        <h3><?php the_field('case_results_subtitle', 'options'); ?></h3>
        <div class="title-text"><?php the_field('case_results_copy', 'options'); ?></div>
    </div>
</section>

<div class="site-inner">

    <div class="parallax floaty-shapes floaty1" data-jarallax-element="160">
        <img src="/wp-content/themes/von-hacht-associates/vectors/blue-lined-circle.svg" alt="textured svg">
    </div>

    
    <div class="parallax floaty-shapes floaty6" data-jarallax-element="100">
        <img src="/wp-content/themes/von-hacht-associates/vectors/dark-blue-lined-circle.svg" alt="textured svg">
    </div>


    <div class="grid-container">
        <div class="grid-x grid-margin-x list-decor">
            <?php get_template_part('parts/core/breadcrumbs', null); ?>
        </div>

        <div class="cell row2">
            <?php if(have_posts()) : ?>
                <div class="results">
                    <?php while(have_posts()) : the_post();
                    $active_cat = wp_get_post_terms($post->ID, 'result_category'); ?>
                    <div class="single-result focus-element">
                        <p class="cateogry"><?php echo $active_cat[0]->name; ?></p>
                        <h2><?php the_field('title'); ?></h2>
                        <h3><?php the_field('subtitle'); ?></h3>
                        <?php the_field('copy'); ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="cell">
            <?php 
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( 'Previous Page', 'honelaw23' ),
                'next_text' => __( 'Next Page', 'honelaw23' ),
            ) );
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>