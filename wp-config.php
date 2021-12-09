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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'lighthouserentals_db_new' );

/** MySQL database username */
define( 'DB_USER', 'lighthouserentals_db_usr' );

/** MySQL database password */
define( 'DB_PASSWORD', 'jFx469*c' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

	//echo "<pre>";print_r(site_url());exit();

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'W&o{OMKBWgQt/fg&iA3L9x[`Q!53TOQasiX6T;bSAB)lucye`I~]eg78vD*/z%t-' );
define( 'SECURE_AUTH_KEY',  '<mO*uS!(sW0S aK/kxMso%/<!S`)|i(.3&{/=JR$Z%YhV[:o|=L:bB[:8[s6Zs82' );
define( 'LOGGED_IN_KEY',    ';2Hw/&q,[i[yS6}C3R-:,iVf#k;7}<^;m)G[*3^a]iT(RWSb?Zz`BP:S%vw*~8B=' );
define( 'NONCE_KEY',        '82M!IcM75{&t)vS+za6 VQrmGzM-3Bs- 83#QfIh*)uQTN_/ ;hF(NcU%3N(#:2y' );
define( 'AUTH_SALT',        'ZLKF5$d%75l&0r_1K@e5+vR<lAYYzB{NBQxv4nBprpg x7q1hUq6l+rZD1&=[/(V' );
define( 'SECURE_AUTH_SALT', 'OaM:{eJ9tSo?olONV7M6r;{lTI;B|y%;0*vSKY/.7gV<+N*g_Pf5+m._ES1BVRm!' );
define( 'LOGGED_IN_SALT',   'LI/{(#0F1r(7S&h %H,O{FK5}:BH!+h9/5]PiAm68ydZ??Ggcv~Wy<>pK+8T` ud' );
define( 'NONCE_SALT',       '!Y;sGZXp.H(5 YkVA)YTiW` eDkY>R[ma?*Fyoi3WJUl1<hZp{5*h1^}vKLQGgi/' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
//define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
