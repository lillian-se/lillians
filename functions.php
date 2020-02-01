<?php

//adding CSS and JS files
function lill_setup(){
  wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Roboto+Slab&display=swap');
  wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Dancing+Script:700&display=swap');
  wp_enqueue_style('fontawesom', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_script('main', get_theme_file_uri('/js/main.js'), NULL, '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'lill_setup');

// adding theme support
function lill_init(){
  add_theme_support('post-thumbnails');
  add_theme_support('title-tag');
  add_theme_support('html5',
  array('comment-list', 'comment-form', 'search-form')
  );
}
add_action('after_setup_theme', 'lill_init');

// projects post type
function lill_custom_post_type(){
  register_post_type('project', 
    array(
      'rewrite' => array('slug' => 'projects'),
      'labels' => array(
        'name' => 'Projects',
        'singular_name' => 'Project',
        'add_new_item' => 'Add New Project',
        'edit_item' => 'Edit Project'
      ),
      'menu-icon' => 'dashicons-clipboard',
      'public' => true,
      'has_archive' => true,
      'supports' => array(
        'title', 'thumbnail', 'editor','excerpt', 'comments'
      )
    )
  );
}
add_action('init', 'lill_custom_post_type');

// sidebar
function lillians_widgets(){
  register_sidebar(
   array(
     'name'=> 'Main Sidebar',
     'id'=> 'main_sidebar',
     'before-title'=> '<h3>',
     'after-title'=> '</h3>'
   ) 
   );
}
add_action('widgets_init', 'lillians_widgets');

// filters

function search_filter($query){
  if($query -> is_search()){
   $query -> set('post_type',array('post', 'project'));
  }
}
add_filter('pre_get_posts', 'search_filter');


?>