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
define( 'DB_NAME', 'sql_mimosadreamt' );

/** Database username */
define( 'DB_USER', 'sql_mimosadreamt' );

/** Database password */
define( 'DB_PASSWORD', 'b8920415c697' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '^gh?dP?Y2A. Qz_.MP3nVKYzzoOk9ZDC>EL rY6n+In_{4Xq`yy).,uA]I1jRh>h' );
define( 'SECURE_AUTH_KEY',  '@W#cxViIJKj7!=a}lf[fq<_mVU-J,Tf,EKds/+-_z2<>Q.r9<Cqp@<OOCM4).TYa' );
define( 'LOGGED_IN_KEY',    'uBbCu7&IQD$0td5KMB=,Wvb7@/vT!]+(;&Eg@J|9pY 8Yf_YTK6F|P6Zjv1Q-Zke' );
define( 'NONCE_KEY',        '1gqR($#nr)o>kw_knloJl5ro=ovh7X!c8QlS>e+Tchd8}>s?z9,ZzmbXM^f:sH_f' );
define( 'AUTH_SALT',        'E1t`zRS]TYd}qs%X1[giiO|.wy]ibTWLstXqKwX,cmyQi^38v{0+/J{xbK^7IAGn' );
define( 'SECURE_AUTH_SALT', '),Bob,u~pY,Rb1p]Iuy1L!k*:{~3}]/S0Y}CH6.k%mK!{{3:+4C9}0a/>Zt5y|Sb' );
define( 'LOGGED_IN_SALT',   ' o4roDX]ASM4R]VL!6kq3e>1S-?Au~)j2HB*G`P)^&LQN28:ZeP|ZBKaS:vmLN,l' );
define( 'NONCE_SALT',       'Db~2R?+|NabgLET@qT0mG@/uCPJ?QbT.: (J5rWC9LB5T>CtQf]u4;jQIx(0^UMS' );

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
$table_prefix = 'wp_28c875_';

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

define( 'RT_WP_NGINX_HELPER_CACHE_PATH', '/www/server/fastcgi_cache' );

define('DISALLOW_FILE_MODS', false);

ini_set('display_errors', 'off');
define('WP_DEBUG_DISPLAY', false);
ini_set('log_errors', 'off');
define('WP_DEBUG_LOG', false);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
