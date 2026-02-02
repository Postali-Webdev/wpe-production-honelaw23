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


    <?php if(have_posts() ) {
        $post_total = $wp_query->post_count;
    } ?>

    <div class="parallax floaty-shapes floaty1" data-jarallax-element="160">
        <img src="/wp-content/themes/von-hacht-associates/vectors/blue-lined-circle.svg" alt="textured svg">
    </div>

    <?php if( $post_total >= 3 ) : ?>
    <div class="parallax floaty-shapes floaty2" data-jarallax-element="160">
        <img src="/wp-content/themes/von-hacht-associates/vectors/dotted-parallelogram.svg" alt="textured svg">
    </div>

    <div class="parallax floaty-shapes floaty3" data-jarallax-element="100">
        <img src="/wp-content/themes/von-hacht-associates/vectors/marble-circle.svg" alt="textured svg">
    </div>
    
    <div class="parallax floaty-shapes floaty4" data-jarallax-element="100">
        <img src="/wp-content/themes/von-hacht-associates/vectors/pale-blue-circle.svg" alt="textured svg">
    </div>
    <?php endif; ?>

    <div class="parallax floaty-shapes floaty5" data-jarallax-element="160">
        <img src="/wp-content/themes/von-hacht-associates/vectors/pale-blue-dotted-parallelogram.svg" alt="textured svg">
    </div>
    
    <div class="parallax floaty-shapes floaty6" data-jarallax-element="100">
        <img src="/wp-content/themes/von-hacht-associates/vectors/dark-blue-lined-circle.svg" alt="textured svg">
    </div>


    <div class="grid-container">
        <div class="grid-x grid-margin-x list-decor">
            <?php get_template_part('parts/core/breadcrumbs', null); ?>
        </div>
        <?php $results_categories = get_categories('taxonomy=result_category&type=custom_post_type'); //var_dump($results_categories); 
        if( $results_categories ) : $count = 0;
        ?>        
        <div class="cell row1">
            <p>Select A Topic</p>
            <ul class="team-tab-list about-tab-list">
                <li class="team-tab-li"><a href="/results/">All</a></li>
                <?php
                $current_term = is_tax('result_category') ? get_queried_object() : null;
                foreach ( $results_categories as $result ) : $count++;
                    $is_current = ( $current_term && isset($current_term->slug) && $current_term->slug === $result->slug );
                ?>
                    <li class="team-tab-li<?php echo $is_current ? ' open' : ''; ?>">
                        <a href="/blog/result_category/<?php echo esc_attr($result->slug); ?>"><?php echo esc_html(isset($result->cat_name) ? $result->cat_name : $result->name); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        <div class="cell row2">
            <?php if(have_posts()) : ?>
                <div class="results">
                    <?php while(have_posts()) : the_post();
                    $active_cat = wp_get_post_terms($post->ID, 'result_category'); ?>
                    <div class="single-result">
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