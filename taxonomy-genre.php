<?php get_header(); ?>

<main class="books-archive">

    <div class="books-header">
        <h2 class="books-title">
            <?php single_term_title(); ?>
        </h2>
    </div>

    <?php get_template_part('template-parts/books-loop'); ?>

</main>

<?php get_footer(); ?>