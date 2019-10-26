<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'reverbera' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'v2>Ej4qs`=8lIM|+%pw{+L}kdc63;g-=<Mf&3U5:wAh4Y(G,2Cg[8EY.yx4|2`YG' );
define( 'SECURE_AUTH_KEY',  'gW5FGN0SA0sJWRk+4U-$%%;6vg0xNwS#?>T(9ryfI]dN*VAv.Z#{Yn01.lSQ_y L' );
define( 'LOGGED_IN_KEY',    'sJ> 9HEES`M&DN$>jfsC%!~;5WD6G?%^l_4x5}[RzJy8q 0.+S^6~UZYlvm>;}xL' );
define( 'NONCE_KEY',        '{|/W1f@:`jX0Q#r,MwOv8Jty84 (<,<-kTL?Z.w@(<Czwm0qt1fJaD*NC-=*-(TG' );
define( 'AUTH_SALT',        '(b.H6$`K_izYE6YNM$T9$$y(.HThn]J+-c>u;7{>.fovDINv2~f;zpKvm#E3Q,uF' );
define( 'SECURE_AUTH_SALT', 'DbyQHm-$xKMdGQ0EA. yhIhbP#{Tl7I/)NNgK.#[}rZD23e/R?p~{ELV_bMJj%>=' );
define( 'LOGGED_IN_SALT',   'E7WA#?($)ElQQYn/v)Y}#|QMMV2Zk8}E!.i7V!Nw3A{R/Ut-f!C Brk;yB>vjC&Y' );
define( 'NONCE_SALT',       's)r+RkFoIKp7r`CRNV#vt^6w2*r[geN!}BS^rVXe>~[4m;I6`ED3bF=*PhWzFU}a' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
