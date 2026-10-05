<?php
$rating = get_field('rating');

if ($rating !== '') :

    $full_stars = floor($rating); 
    $half_star = ($rating - $full_stars >= 0.5) ? 1 : 0; 
    $empty_stars = 5 - $full_stars - $half_star;
?>

<div class="book-rating" aria-label="Рейтинг книги: <?php echo esc_html($rating); ?> из 5">
    <?php for ($i = 0; $i < $full_stars; $i++) : ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/star-full.svg" alt="★">
    <?php endfor; ?>

    <?php if ($half_star) : ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/star-half.svg" alt="★ половина">
    <?php endif; ?>

    <?php for ($i = 0; $i < $empty_stars; $i++) : ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/star-empty.svg" alt="☆">
    <?php endfor; ?>
</div>

<?php endif; ?>