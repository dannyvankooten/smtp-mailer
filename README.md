This repository moved to https://git.sr.ht/~dvko/wp-smtp-mailer on 2022-12-07 :warning:

---

# WP SMTP Mailer

This plugin will configure the default WordPress email function (`wp_mail`) to use PHPMailer with SMTP.

[![Build Status](https://api.travis-ci.org/dannyvankooten/wp-smtp-mailer.png?branch=master)](https://travis-ci.org/dannyvankooten/wp-smtp-mailer)
[![Stable Version](https://poser.pugx.org/dannyvankooten/wp-smtp-mailer/v/stable.svg)](https://packagist.org/packages/dannyvankooten/wp-smtp-mailer)
[![License](https://poser.pugx.org/dannyvankooten/wp-smtp-mailer/license.svg)](https://packagist.org/packages/dannyvankooten/wp-smtp-mailer)
[![Code Climate](https://codeclimate.com/github/dannyvankooten/wp-smtp-mailer/badges/gpa.svg)](https://codeclimate.com/github/dannyvankooten/wp-smtp-mailer)
[![Test Coverage](https://codeclimate.com/github/dannyvankooten/wp-smtp-mailer/badges/coverage.svg)](https://codeclimate.com/github/dannyvankooten/wp-smtp-mailer)

Usage
=========

Define all of the following constants in your `/wp-config.php` file. If either one of these constants is not defined, the plugin won't configure PHPMailer to use SMTP.

```php
define( 'SMTP_HOST', 'smtp.gmail.com' );
define( 'SMTP_PORT', 465 );
define( 'SMTP_USER', 'your email' );
define( 'SMTP_PASSWORD', 'your password' );
```

That's all. 

PS. I recommend using something like [MailCatcher](http://mailcatcher.me/) as the SMTP server in your development environments.
