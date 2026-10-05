<?php get_header(); ?>

<main class="books-archive">

    <div class="books-header">
        <h2 class="books-title">Каталог книг</h2>
        <div class="books-filter">
            <form method="GET" action="">
                <select name="genre" onchange="this.form.submit()">
                    <option value="">Все жанры (All)</option>

                    <?php 
                    $genres = get_terms([
                        'taxonomy'   => 'genre',
                        'hide_empty' => true,
                        'parent'     => 0,
                    ]);?>
                    

                    <?php foreach ($genres as $parent_genre) : ?>

                        <option value="<?php echo $parent_genre->slug; ?>"
                            <?php selected($_GET['genre'] ?? '', $parent_genre->slug); ?>>
                            <?php echo $parent_genre->name; ?>
                        </option>

                        <?php
                        $child_genres = get_terms([
                            'taxonomy'   => 'genre',
                            'hide_empty' => true,
                            'parent'     => $parent_genre->term_id,
                        ]);
                        ?>

                        <?php foreach ($child_genres as $child) : ?>
                            <option value="<?php echo $child->slug; ?>"
                                <?php selected($_GET['genre'] ?? '', $child->slug); ?>>
                                — <?php echo $child->name; ?>
                            </option>
                        <?php endforeach; ?>

                    <?php endforeach; ?>

                </select>
            </form>
        </div>
    </div>

    

    <?php

    $tax_query = [];

    if (!empty($_GET['genre'])) {
        $tax_query[] = [
            'taxonomy' => 'genre',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($_GET['genre']),
        ];
    }

    $args = [
        'post_type' => 'books',
        'posts_per_page' => 10,
        'orderby' => 'date',
        'order' => 'DESC'
    ];

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $books_query = new WP_Query($args);
    

    get_template_part('template-parts/books-loop', null, [
        'query' => $books_query
    ]);
    
    ?>

</main>

<?php get_footer(); ?>