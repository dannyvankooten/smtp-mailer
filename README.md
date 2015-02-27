# WP SMTP Mailer

This plugin will configure `wp_mail` to use PHPMailer with SMTP.

Usage
=========

Define the following constants in your `/wp-config.php` file.

```php
define( 'SMTP_HOST', 'smtp.gmail.com' );
define( 'SMTP_PORT', 465 );
define( 'SMTP_USER', 'your email' );
define( 'SMTP_PASSWORD', 'your password' );
```

That's all. 

PS. if either one of the above constants is not defined, the plugin will not modify the `PHPMailer` object. This can be useful if you only want to 
use SMTP in your production environments, while using something like MailCatcher in your development or staging environment.