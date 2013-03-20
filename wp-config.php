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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

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
define('AUTH_KEY',         'Gp<xuGNa,g.mv<J@ZbD+G{FT4K}kVYaBQE# _R!CC:<3t.Z(VJ] tRNw,+%0+Lo7');
define('SECURE_AUTH_KEY',  'cRv2*XMfA|LH]58_y?ip3QWNI$*5JCY^Z7JpOjts07ps8m6P&&84H7|10BQg19?C');
define('LOGGED_IN_KEY',    'nMn]H82MSwV:/OUhC.qLWx%,O2/7x1>.Gu&&=gh-ah>mx#a2<WSCe8.z~KJ9fT`,');
define('NONCE_KEY',        '<w)j[m1ol1L._d.@m>ePujeDq3*cP)rD*_B8d$TD1e#^;QR+Pg_~ryL&FFpT)j36');
define('AUTH_SALT',        'g]uvSMu)o5;&z@G&oV`Lsl93.B0j:<sV1+ fOm:[9|yWHQCSWoqK,/[E)qMl@tGe');
define('SECURE_AUTH_SALT', '=jb+J?{0uGm`=1k7LZMN^}H2CR1vQWg)4Tp{Jdbz:5NaQhliF;=YnXFP}CcLRRc.');
define('LOGGED_IN_SALT',   'AG.ie) $-^$$z>nBw<c6AkWx#x#vi;&@[J/=jWySLHyG+oV;@iTn+>wKcfj9t:#D');
define('NONCE_SALT',       'A9d7B)-w3._uVK=u2i]1i<Rkr3}lN:],m@jYN`DS9ew~^~A@2<R2(CsE$9&9G4iS');

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
