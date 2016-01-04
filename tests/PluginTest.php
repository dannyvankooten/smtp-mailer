<?php

use SMTP_Mailer\Plugin;

// Mock constant
define( 'ABSPATH', true );

// Mock add_action
$GLOBALS['actions'] = array();
function add_action( $hook, $callback, $priority = 10, $arguments = 2 ) {
	$GLOBALS['actions'][$hook] = $callback;
}

function add_filter( $hook, $callback, $priority = 10, $arguments = 2 ) {}


// Load plugin class
require __DIR__ .'/../smtp-mailer.php';

class PluginTest extends PHPUnit_Framework_TestCase {

	/**
	 * Test if the action is added correctly.
	 * @covers SMTP_Mailer\Plugin::__construct
	 */
	public function test_action_is_added() {
		$instance = new Plugin;
		$this->assertEquals( $GLOBALS['actions']['phpmailer_init'], array( $instance, 'setup_phpmailer' ) );
	}

	/**
	 * @covers SMTP_Mailer\Plugin::setup_phpmailer
	 */
	public function test_setup_phpmailer() {
		$phpmailer = new StdClass;
		$instance = new Plugin();

		// test without constant defined
		$instance->setup_phpmailer( $phpmailer );
		$this->assertEquals( $phpmailer, new StdClass );

		// define just one constant
		define( 'SMTP_HOST', 'smtp.gmail.com' );
		$this->assertEquals( $phpmailer, new StdClass );

		// define all configuration constants
		define( 'SMTP_USER', 'user@email.com' );
		define( 'SMTP_PASSWORD', 'password' );
		define( 'SMTP_PORT', 465 );

		$instance->setup_phpmailer( $phpmailer );
		$this->assertEquals( $phpmailer->Mailer, 'smtp' );
		$this->assertEquals( $phpmailer->SMTPSecure, 'ssl' );
		$this->assertEquals( $phpmailer->Host, SMTP_HOST );
		$this->assertEquals( $phpmailer->Port, SMTP_PORT );
		$this->assertEquals( $phpmailer->SMTPAuth, true );
		$this->assertEquals( $phpmailer->Username, SMTP_USER );
		$this->assertEquals( $phpmailer->Password, SMTP_PASSWORD );
	}


}