<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'alexandralash');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'b@-`j+9a-M#d-8)|9UC7LoraobE8;2[% 7rYD;]4gXIlf`c$%+-nWx%LDy5:7 M`');
define('SECURE_AUTH_KEY',  '#}c82y-1hBUcx<y[ww;mY-1IK||cw}-<%|B-/Y^l@4nGV3(:c]YW^IQ1~gvL4n2a');
define('LOGGED_IN_KEY',    'gA[Ent@;U~/.bya-+yw-~T&C-c:EXD!d)=+9u`+@NH^2)!-8tK>5<YU]l/!p7/ac');
define('NONCE_KEY',        'p-(R,G9pRLo+1,$?BQb`M)fdF5{YcdL;R4W=P{__7Z 4Dp3~}d[zJ_*R~oxZ9%iP');
define('AUTH_SALT',        'l|Pt!#|Q:{{(;jZXA.R(5+z WVTUB`,?9W}Kydf+BD$#VJIh;VrOgn^ct]pRnE6~');
define('SECURE_AUTH_SALT', '+~7#asu--2D[>cP~o+kgBZ}S-p8;<[!x,C_N|lvWq{|{MgXTA=U|#ycw:a7]Fj^z');
define('LOGGED_IN_SALT',   'JflF}iVUg7nB7WSH||PGQs+kOMI%!aE7t6%sueMJ[v~a1b`7vGH {6f--tmir$y6');
define('NONCE_SALT',       'b&,Y%VC}pQjbs?D/=P7yk:JoS> ^Tx<B? JW#L)bp@m*:<Gt6<@fe*fJ%&c/b6v~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
