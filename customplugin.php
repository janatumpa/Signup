<?php
/*
   Plugin Name: Singup
   Plugin URI: #
   description: A simple Sign up
   Version: 1.0.0
   Author: Tumpa Jana
   Author URI: #
*/

// Create a new table
function customplugin_table(){

  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();

  $tablename = $wpdb->prefix."customplugin";

  $sql = "CREATE TABLE $tablename (
  id mediumint(11) NOT NULL AUTO_INCREMENT,
  
  username varchar(80) NOT NULL,
  password varchar(80) NOT NULL,
  user_proof varchar(80) NOT NULL,
   user_proof_ans varchar(80) NOT NULL,
  PRIMARY KEY  (id)
  ) $charset_collate;";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );

}
register_activation_hook( __FILE__, 'customplugin_table' );

// Add menu
function customplugin_menu() {

    add_menu_page("Sign up", "Sign up","manage_options", "myplugin", "displayList",plugins_url('/customplugin/img/icon.png'));
    add_submenu_page("myplugin","All Entries", "All entries","manage_options", "allentries", "displayList");
    add_submenu_page("myplugin","Add new Entry", "Add new Entry","manage_options", "addnewentry", "addEntry");

}
add_action("admin_menu", "customplugin_menu");

function displayList(){
  include "displaylist.php";
}

function addEntry(){
  include "addentry.php";
}