<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
  include( dirname( __FILE__ ) . '/local-config.php' );
  define( 'WP_LOCAL_DEV', true ); // We'll talk about this later
} else {

define('DB_NAME', 'nnamdinw_wrd11');

/** MySQL database username */
define('DB_USER', 'nnamdinw_wrd11');

/** MySQL database password */
define('DB_PASSWORD', 'PVbEMgmoNS');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'F>Q~XL&Xj~TS~`Ar,x0%H>ze62=09bR+Iy`g~)j|8Dj%Zc1_x^P0]78s)!Ayrch6');
define('SECURE_AUTH_KEY',  'ojb@LH@-Z}E=;a-{<&qBo9%WjP_{zB+9d.C+An/W+G^4=/T.`3/dh45RB3K;9|nm');
define('LOGGED_IN_KEY',    'W(eh@W,o;)n1}Nlu I[Ce3}|6+|Va01-FPt+Zu=eQ&`NJ4d.H {s]{p{3+=cT%a<');
define('NONCE_KEY',        '%[TYXqn{<%I1KjU6[v`m6mM~-z!|c~h@<ETpWH*BqFF^K4!88U++6CM!R,L$9/9W');
define('AUTH_SALT',        '/ZB[f;`84]gl3GJTQ`#_3WM`6#Au3{]Y-9$c06_,N^FpVC~d|@gv?amacM3SMgCl');
define('SECURE_AUTH_SALT', 'sRP/vw%A> J=`~+EX1N2 !UB~{O?)8wEM*`X[XMBPBU-2<f=*Jat5nW+D{?%o{gH');
define('LOGGED_IN_SALT',   '9}l-X+mx8gBGwN(mAXh,U$WN]SRgZ*Yl7A#c;!):kfxl6:Fkt<+>?B;+y7Jjd|/K');
define('NONCE_SALT',       '-$nvU*Y[u]!m!~6p:t4Y~~bi~PaRS.LS_BYK~%`KHqPv7IE-UJ(58cIk#hIE-Of0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
