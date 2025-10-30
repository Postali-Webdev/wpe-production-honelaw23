<article class="faq<?php echo get_the_ID() === 3175 ? ' exception' : ''; ?>">
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="faq__image-link">
            <?php the_post_thumbnail('large', array(
                'class' => 'faq__image'
            )); ?>
        </a>
    <?php endif; ?>
    <div class="faq__content">
        <a href="<?php the_permalink(); ?>" class="faq__link"><h2 class="faq__title"><?php the_title(); ?></h2></a>
        <p class="entry-meta">
            <time class="entry-time"><?php echo get_the_time('F d, Y'); ?></time>
            <span class="entry-author">
                <a href="<?php echo get_the_author_link(); ?>" class="entry-author-link">
                    <?php echo _e('by ', 'honelaw') . get_the_author(); ?>
                </a>
                </span>
        </p>
        <?php
        //Delete post->ID If in post loop
        $content = get_extended(get_post_field('post_content'));
        if (!empty($content)): ?>
            <p><?php echo $content['extended'] ? $content['main'] : wp_trim_words(get_the_content(null, false), 55); ?></p>
        <?php endif; ?>
        <a class="faq__read-more" href="<?php the_permalink(); ?>"><?php _e('Read More') ?></a>
    </div>
</article>