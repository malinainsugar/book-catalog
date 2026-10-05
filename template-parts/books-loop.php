<?php
$query = $args['query'] ?? $wp_query;
?>

<?php if ($query->have_posts()) : ?>

    <div class="books-grid">

        <?php while ($query->have_posts()) : $query->the_post(); ?>

            <article class="book-card" onclick="window.location='<?php the_permalink(); ?>'">

                    <div class="book-cover">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>

                    <div class="book-card-content">

                        <h3 class="book-card-title"><?php the_title(); ?></h3>

                        <div class="book-card-meta">
                            <span class="book-author"><?php the_field('author'); ?></span>
                            <span class="book-year"><?php the_field('year'); ?></span>
                        </div>

                        <div class="book-card-rating">
                            <span class="rating-number"><?php the_field('rating'); ?></span>
                            <?php get_template_part('template-parts/book-rating'); ?>
                        </div>

                    </div>

                </article>

        <?php endwhile; ?>

    </div>

<?php else : ?>
    <p>Книг пока нет.</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>