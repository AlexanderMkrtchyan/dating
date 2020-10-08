<?php
function artist_post_type()
{
    register_post_type('couple_blog', array(
        'public' => true,
        'labels' => array(
            'name' => 'Couple Blog',
            'edit_item' => 'Edit Couple Blog',
            'all_items' => 'All Couple Blogs',
            'singular_name' => 'Couple Blog',
            'has_archive' => true
        ), 
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        'menu_icon' => 'dashicons-universal-access'
    ));
    register_post_type('mens_world', array(
        'public' => true,
        'labels' => array(
            'name' => 'Mens World',
            'edit_item' => 'Edit Men World',
            'all_items' => 'All Men Worlds',
            'singular_name' => 'Men World',
            'has_archive' => true
        ), 
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        'menu_icon' => 'dashicons-universal-access'
    ));
    register_post_type('girls_blog', array(
        'public' => true,
        'labels' => array(
            'name' => 'Girls Blog',
            'edit_item' => 'Edit Girl Blog',
            'all_items' => 'All Girl Blogs',
            'singular_name' => 'Girl Blog',
            'has_archive' => true
        ),
        'menu_icon' => 'dashicons-heart',
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',)
    ));
}

add_action('init', 'artist_post_type');

//creating custom taxonomies for hotels custom post

//registration of taxonomies

function my_taxonomies_hotel()
{

    //labels array

    $labels = array(
        'name' => _x('Mens Categories', 'taxonomy general name'),
        'singular_name' => _x('Mens Category', 'taxonomy singular name'),
        'search_items' => __('Search Mens Categories'),
        'all_items' => __('All Mens Categories'),
        'parent_item' => __('Parent Mens Category'),
        'parent_item_colon' => __('Parent Mens Category:'),
        'edit_item' => __('Edit Mens Category'),
        'update_item' => __('Update Mens Category'),
        'add_new_item' => __('Add New Mens Category'),
        'new_item_name' => __('New Mens Category'),
        'menu_name' => __(' Mens Categories'),
    );

    //args array

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy('hotel_category', 'mens_world', $args);
}