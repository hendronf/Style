<?php
add_action( 'init', 'register_cpt_docs' );

function register_cpt_docs() {

    $labels = array( 
        'name' => _x( 'Docs', 'docs' ),
        'singular_name' => _x( 'Doc', 'docs' ),
        'add_new' => _x( 'Add New', 'docs' ),
        'add_new_item' => _x( 'Add New Doc', 'docs' ),
        'edit_item' => _x( 'Edit Doc', 'docs' ),
        'new_item' => _x( 'New Doc', 'docs' ),
        'view_item' => _x( 'View Doc', 'docs' ),
        'search_items' => _x( 'Search Docs', 'docs' ),
        'not_found' => _x( 'No docs found', 'docs' ),
        'not_found_in_trash' => _x( 'No docs found in Trash', 'docs' ),
        'parent_item_colon' => _x( 'Parent Doc:', 'docs' ),
        'menu_name' => _x( 'Docs', 'docs' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Docuemtnation ',
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'custom-fields', 'revisions' ),
        'taxonomies' => array( 'category', 'post_tag' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'docs', $args );
}
?>