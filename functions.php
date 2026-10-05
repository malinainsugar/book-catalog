<?php

add_theme_support('post-thumbnails');

function theme_register_menus() {
    register_nav_menus([
        'header_menu' => 'Header Menu',
    ]);
}

add_action('after_setup_theme', 'theme_register_menus');

function book_catalog_enqueue_scripts() {

    wp_enqueue_style(
        'book-catalog-fonts', // уникальный идентификатор
        'https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;500;600;700&family=Goudy+Bookletter+1911&family=Lora:wght@400;500&display=swap',
        [],
        null
    );
    
    // Главный файл темы (с переменными)
    wp_enqueue_style(
        'book-catalog-main-style', // уникальный идентификатор
        get_stylesheet_uri(), // путь к style.css темы
        [], // зависимости (если есть)
        filemtime(get_stylesheet_directory() . '/style.css') // версия для кеша
    );

    // Header
    wp_enqueue_style(
        'book-catalog-header-style',
        get_template_directory_uri() . '/css/header-style.css',
        ['book-catalog-main-style'], // зависимость!
        filemtime(get_template_directory() . '/css/header-style.css')
    );

    // Footer
    wp_enqueue_style(
        'book-catalog-footer-style',
        get_template_directory_uri() . '/css/footer-style.css',
        ['book-catalog-main-style'], // зависимость!
        filemtime(get_template_directory() . '/css/footer-style.css')
    );

    // Страница одной книги
    wp_enqueue_style(
        'book-catalog-single-style',
        get_template_directory_uri() . '/css/single-books-style.css',
        ['book-catalog-main-style'], // зависимость!
        filemtime(get_template_directory() . '/css/single-books-style.css')
    );

    // Каталог кнги
    wp_enqueue_style(
        'book-catalog-archive-style',
        get_template_directory_uri() . '/css/archive-books-style.css',
        ['book-catalog-main-style'], // зависимость!
        filemtime(get_template_directory() . '/css/archive-books-style.css')
    );
}
add_action('wp_enqueue_scripts', 'book_catalog_enqueue_scripts');

function register_books_post_type() {
    register_post_type('books', [
        'labels' => [
            'name'=> 'Книги',
            'singular_name' => 'Книга',
            'add_new_item' => 'Добавить книгу',
            'edit_item' => 'Редактировать книгу',
            'all_items' => 'Все книги',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'books'],
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
     ] );
}
add_action('init','register_books_post_type');

function register_book_taxonomy() {
    register_taxonomy('genre', ['books'], [
        'labels' => [
                'name' => 'Жанры',
                'singular_name' => 'Жанр',
                'add_new_item' => 'Добавить жанр',
                'edit_item' => 'Редактировать жанр',
                'all_items' => 'Все жанры',
        ],
        'public' => true,
        'hierarchical' => true, // как категории (true) или как теги (false)
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'genre']
    ] );
}
add_action('init','register_book_taxonomy');
?>