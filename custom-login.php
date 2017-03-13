<?php

/*
  Plugin Name: Custom Login Page
  Description: A plugin to add a custom login page.
  Version: 1.0
  Author: Jen Downs
  Author URI: https://github.com/jendowns/
*/


// Setting login page URL as a constant
define("LOGIN_PAGE", home_url('/login/'));


// Making sure the correct template is loaded
function load_custom_login_page($page_template){
  if (is_page('login')){
    $page_template = dirname( __FILE__ ) . '/page-login.php';
  }
  return $page_template;
}
add_filter('page_template', 'load_custom_login_page');


// When plugin is activiated, create a login page
function create_custom_login_page(){
  $new_post = array(
    'comment_status' => 'closed',
    'ping_status' =>  'closed' ,
    'post_date' => date('Y-m-d H:i:s'),
    'post_name' => 'login',
    'post_status' => 'publish' ,
    'post_title' => 'Login',
    'post_type' => 'page',
  );
  // Insert page & save ID
  $new_value = wp_insert_post( $new_post, false );
  // Save page's ID in the database
  update_option( 'customloginpage', $new_value );
}
register_activation_hook( __FILE__, 'create_custom_login_page');


// Redirect to new login page
function redirect_custom_login_page() {
  $page_viewed = basename($_SERVER['REQUEST_URI']);

  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect(constant("LOGIN_PAGE"));
    exit;
  }
}
add_action('init','redirect_custom_login_page');


// Catch a failed login
function catch_login_error() {
  wp_redirect(constant("LOGIN_PAGE") . '?login=failed');
  exit;
}
add_action('wp_login_failed', 'catch_login_error');


// Catch an empty login form
function catch_empty_form($user, $username, $password) {
  if($username == "" || $password == "") {
    wp_redirect( constant("LOGIN_PAGE") . "?login=empty" );
    exit;
  }
}
add_filter('authenticate', 'catch_empty_form', 10, 3);


// Redirect after logout
function log_out() {
  wp_redirect(home_url());
  exit;
}
add_action('wp_logout','log_out');

?>
