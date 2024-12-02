<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** Database username */
define('DB_USER', 'wordpressuser');

/** Database password */
define('DB_PASSWORD', 'secret');

/** Database hostname */
define('DB_HOST', 'db');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Q]MlG>EciFg[CG$kiYSg#ng)+9$C^,duoaB#f0+Yda(M_#07jOF@f2|TS{|q|$x;');
define('SECURE_AUTH_KEY',  'TI1P#>!f+)3Q||y7hiW#)r}G!(Delgl^d/WwpjK4WrRMqOjMX|@V]y3eo~t$[O@Y');
define('LOGGED_IN_KEY',    'jK=R?DVSt<xb ?%VUJgp{XMi_EP~N}cbjYglbh$V:XF$nNGOZ;$g3,Dv<0b_l<p1');
define('NONCE_KEY',        'E_Vb8w(US=K-j +Hu%O)#6fA9?z{_?tgFv{aHH8Yr#r%lo7Dg^cm:zwT6NqCE3H1');
define('AUTH_SALT',        ']V:a_]qTaGTP2{|u$SUY!KJ4qg/=4/v3:tb=LGQ4[33?(0jq-5~]RaokXaw@+/Kq');
define('SECURE_AUTH_SALT', '1dN]V^Q$?q:G$j0eb;C 1-Q|2C}/j^&$Ikse(#})2[C(b^IILkxp+a_gf2lck0D8');
define('LOGGED_IN_SALT',   'Oy17G[}Moix`h762U5*KY-4Mt5N>DItADjDTm4n-]!x6`?{h/LzX%C9[Vk]T2!AI');
define('NONCE_SALT',       '#0+rg.8;dOX{9zhp|bKM>Fas{mG>;tDC.|8o(Tdq,{+IvjiR&`@Dk7VtwiiLDXPM');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
  define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
