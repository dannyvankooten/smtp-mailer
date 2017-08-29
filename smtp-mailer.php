<?php
/*
Plugin Name: SMTP Mailer
Description: This plugin will configure wp_mail to use SMTP for sending your email.
Author: Danny van Kooten
Version: 1.0
Author URI: https://dannyvankooten.com/
Private: True
*/

namespace SMTP_Mailer;

if( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Plugin {

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'phpmailer_init', array( $this, 'setup_phpmailer' ) );
    }

    /**
     * Alter the PHPMailer object
     *
     * @param $phpmailer
     */
    public function setup_phpmailer( \PHPMailer $phpmailer ) {

        // make sure all configuration constants are given
        if( ! defined( 'SMTP_HOST' ) || ! defined( 'SMTP_PORT' ) ) {
            return;
        }

        $phpmailer->Mailer = 'smtp';
        $phpmailer->Host = SMTP_HOST;
        $phpmailer->Port = SMTP_PORT;

        if( defined( 'SMTP_USER' ) && ! empty( SMTP_USER ) ) {
            $phpmailer->SMTPAuth = true;
            $phpmailer->Username = SMTP_USER;
            $phpmailer->Password = defined( 'SMTP_PASSWORD' ) ?  (string) SMTP_PASSWORD : '';
        }

        $phpmailer->SMTPSecure = defined( 'SMTP_ENCRYPTION' ) ? (string) SMTP_ENCRYPTION : 'ssl';
    }

}

new Plugin;

// remove plugin from update check response
add_filter( 'site_transient_update_plugins', function( $value ) {

    if( is_object( $value ) && isset( $value->response ) ) {
        $plugin_slug = plugin_basename( __FILE__ );
        unset( $value->response[ $plugin_slug ] );
    }

    return $value;
} );