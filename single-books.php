<?php get_header(); ?>

<main class="book-single">
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="book-wrapper">
        <?php if (has_post_thumbnail()) : ?>
            <div class="book-image">
                <?php the_post_thumbnail('medium'); ?>
            </div>
        <?php endif; ?>

        <div class="book-info">
            <h3 class="book-title"><?php the_title(); ?></h3>
            
            <div class="book-meta">
                <?php if (get_field('author')) : ?>
                    <p><span class="meta-label">Автор:</span> <?php the_field('author'); ?></p>
                <?php endif; ?>

                <p class="book-genres-wrapper">
                    <span class="meta-label">Жанры:</span>
                    <span class="book-genres">
                        <?php
                        $genres = get_the_terms(get_the_ID(), 'genre');
                        if ($genres && !is_wp_error($genres)) {
                            foreach ($genres as $i => $genre) {
                                echo '<span class="genre-item">' . '<a href="' . get_term_link($genre). '">'.  esc_html($genre->name) . '</a>' . '</span>';
                            }
                        }
                        ?>
                    </span>
                </p>

                <?php if (get_field('year')) : ?>
                    <p><span class="meta-label">Год издания:</span> <?php the_field('year'); ?></p>
                <?php endif; ?>

                <?php if (get_field('rating')) : ?>
                    <div class="book-rating-wrapper">
                        <span class="meta-label">Рейтинг:</span>
                        <span class="rating-number"><?php the_field('rating'); ?></span>
                        <?php get_template_part('template-parts/book-rating'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="book-description">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
<?php endif; ?>
</main>


<?php get_footer(); ?>