<?php
/*
  Plugin Name: Welcart exclude from delivery day 
  Plugin URI:
  Description: welcartの配送希望日から指定の日付けを除外することが可能になるプラグインです。
  Version: 1.0.1
  Author: mochimochihesoo
  Author URI: https://hesolog.com
  License: GPL2
 */

define( 'MHWEFD_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define('MHWEFD_BASE_URL',plugin_dir_url( __FILE__ ));

require_once('class.php');

add_action( 'admin_enqueue_scripts',function(){
  wp_enqueue_style( 'mhwefd_css', MHWEFD_BASE_URL.'css/style.css' );
});