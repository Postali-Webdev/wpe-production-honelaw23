<?php
/**
 * Template Name: About Page
 **/

//* Force full width content layout
// add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_entry_content'); // Add custom loop
add_action('genesis_after_header', 'genesischild_top_wrap_widgets');

function genesischild_top_wrap_widgets()
{
    $hero_url = get_the_post_thumbnail_url(get_the_ID(), 'full_hd');
    $background_mobile = get_field('background_mobile', get_the_ID());
    ?>
    <section class="banner banner-single-post <?php echo (empty($hero_url)) ? 'empty' : null ?>">

        <div class="featured-img-hone">

            <?php /*if (!empty($background_mobile)): ?>
                <style>
                    @media screen and (max-width: 960px) {
                        .banner__rotate {
                            background-image: url(<?php echo $background_mobile ?>) !important;
                        }
                </style>
            <?php endif; */?>
			
			<img src="<?php echo $hero_url;?>">
			
		</div>

            <div class="banner__content">

                <h1 class="banner__title"><?php the_title() ?></h1>

                <?php if ($item2 = get_field('subtitle')): ?>
                    <h3><?php echo $item2 ?></h3>
                <?php endif; ?>
                <?php if ($link = get_field('contact_link')): ?>
                    <div class="button__container">
                        <a class="button button--tranperent" href="<?php echo $link['url']; ?>"
                           target="<?php if ($link['target']) {
                               echo $link['target'];
                           } else {
                               echo '_parent';
                           } ?>"><?php echo $link['title']; ?></a>
                    </div>
                <?php endif; ?>
				<?php if(get_field('title_excerpt')):?>
					<div class="title-text">
						<?php the_field('title_excerpt');?>
					</div>
				<?php endif;?>
            </div>
    </section>



<?php }

function custom_entry_content()
{ ?>
    <div id="main_container">
        <div class="default-page-container">

            <div class="grid-container">
                <div class="grid-x grid-margin-x list-decor">

                    <div class="cell">
                        <?php get_template_part('parts/core/breadcrumbs', null); ?>
                    </div>
					<div class="cell">
                        <ul class="team-tab-list about-tab-list">
                          <?php $i = 1;
                          while (have_rows('tabs')): the_row();
                          	$title = get_sub_field('tab_name') ? get_sub_field('tab_name') : 'Tab-' . $i; ?>
                               <li class="team-tab-li <?php if ($i == '1') {
                               		echo 'open';
                               } ?>"><a href="<?php the_sub_field('tab_anchor');?>"><?php echo $title ?></a></li>
                          <?php $i++; endwhile; ?>
                    	</ul>
					</div>
					<?php if( have_rows('columns') ):
					$image = get_field('background_image');?>
					<section class="banner about-columns" id="the-hone-law-difference">
						<div class="banner__rotate bg-cover" id="team-tab-id-1" style="background-image: url(<?php echo esc_url($image['url']);?>);">
							<div class="banner__content">
								<div class="banner__grid">
									<h2><?php the_field('title');?></h2>
									<?php while( have_rows('columns') ) : the_row();?>
										<div class="about-column"><?php the_sub_field('column');?></div>
									<?php endwhile;?>
								<?php if(get_field('video_section')):?>
									<div class="video-section">
										<?php the_field('video_section');?>
									</div>
								<?php endif;?>
								</div>
							</div>
						</div>
					</section>
					<?php endif;?>
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="cell" id="benefits-to-our-practice">
                                <?php the_field('our_practice_content');?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
					
					<div id="team-members" class="cell about-attorneys-text"><?php the_field('meet_the_team_content');?></div>
					
					<section class="about-attorneys">
						<?php
						$posts = get_field('attorneys_list');
						if ($posts): ?>
						<?php foreach ($posts as $p): // variable must NOT be called $post (IMPORTANT) ?>
							<div class="cell medium-6 small-12 semper_portitor_sed__single semper_portitor_sed__single--team-template">
								<?php if (get_field('mobile_image', $p->ID)): ?>
									<a href="<?php echo get_permalink($p->ID); ?>"
									   style="background-image: url(<?php echo get_the_post_thumbnail_url($p->ID) ?>);"
									   class="semper_portitor_sed__post bg-cover hide-for-small-only">
									</a>
									<a href="<?php echo get_permalink($p->ID); ?>"
									   style="background-image: url(<?php echo get_field('mobile_image', $p->ID)['url'] ?>);"
									   class="semper_portitor_sed__post bg-cover show-for-small-only">
									</a>
									<a href="<?php echo get_permalink($p->ID); ?>">
										<span class="semper_portitor_sed__post-title"><?php echo get_the_title($p->ID); ?></span>
									</a>
									<?php if ($item2 = get_field('position', $p->ID)): ?>
										<p class="attorney__position"><?php echo $item2 ?></p>
									<?php endif; ?>
								<?php else: ?>
									<a href="<?php echo get_permalink($p->ID); ?>"
									   style="background-image: url(<?php echo get_the_post_thumbnail_url($p->ID) ?>);"
									   class="semper_portitor_sed__post bg-cover">
									</a>
									<a href="<?php echo get_permalink($p->ID); ?>">
										<span class="semper_portitor_sed__post-title"><?php echo get_the_title($p->ID); ?></span>
									</a>
									<?php if ($item2 = get_field('position', $p->ID)): ?>
										<p class="attorney__position"><?php echo $item2 ?></p>
									<?php endif; ?>
								<?php endif; ?>

							</div>
						<?php endforeach; ?>
						<?php endif;?>
					</section>
					
					<div class="cell">
						<section class="memoriam">
							<?php the_field('memoriam_text');?>
						</section>
					</div>
					
					<div class="cell">
						<section class="careers" id="careers">
							<?php the_field('careers_text');?>
						</section>
					</div>
                </div>

            </div>
        </div>
    </div>
<?php }

genesis();