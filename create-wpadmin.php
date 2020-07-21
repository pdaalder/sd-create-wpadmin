<?php

/**
 * Plugin Name: SD Create WP Admin
 * Description: A small plugin you can use to create a new WP user account that has administrator priviliges.
 * Version: 1.2
 * Author: Pieter Daalder
 * License: GPLv3
 */

if ( !class_exists( 'SD_Create_WP_Admin' ) ) {

    class SD_Create_WP_Admin {
        
        public static function create_admin() {
            $newuser = 'new-admin';
            $pass    = wp_generate_password();
            $mail    = 'you@example.com';
            if ( ! username_exists( $newuser ) ) {
                $user_id = wp_create_user( $newuser, $pass, $mail );
                $user = new WP_User( $user_id );
                $user->set_role( 'administrator' );
                wp_new_user_notification( $user_id, null, $notify = 'user' );
            }
        }
    }

    add_action( 'init', function() {
        SD_Create_WP_Admin::create_admin();
        unlink( __FILE__ );
    } );
}
?>
