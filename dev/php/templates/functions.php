<?php
  // Register the sitemap menu
  add_action( 'init', 'register_menu_sitemap' );
  define("GF_THEME_IMPORT_FILE", "includes/gravityforms-contactform.xml");

  function register_menu_sitemap(){
  register_nav_menus( array(
  'sitemap' => 'Sitemap'
      ));
  }
   

  include_once('includes/initialize_pages.php');
?>
