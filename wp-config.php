<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'arcturusmc_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '(=B?7$|z_^CH=&LpAH7j(5?2)@<w^z7yO+H%=nu3<?b[iPlC943u0P&c ]w6,hZI' );
define( 'SECURE_AUTH_KEY',  '9(cmWDiIJcA4%[0i_/{^rjk;P/~H5H_@>jb jbPvu30wyPn wFTHEEmZ449J~cv)' );
define( 'LOGGED_IN_KEY',    'U_poe[BQ!D8$I*X#le5Aq1UL46GU?}aIr>Q7.$iU}O^.{N;xjYSR_iS-V=e;Di`M' );
define( 'NONCE_KEY',        '/T`C<s22)5G);[feBc6O.6-&<jX7qRV_pwy_RL-beo6*(:mmwQnv;G~ng=Bn2!2E' );
define( 'AUTH_SALT',        'WYh*RbVUN?7g;w};SK+KcU_CoRS]E5kB@w,Y|$^h:>z:.m@uXmmAzS*<Yle}LAnu' );
define( 'SECURE_AUTH_SALT', '*>MPN69=^Edy,t)0exG._-HewCJQBl{LmcDM `3k5B}BxSRpGt]xhS GBtC4;]pb' );
define( 'LOGGED_IN_SALT',   '*=3^X]YhOEH_i0Yc[tx7X&dq54({IU&Hmq=Usz7Fb6i8~OJ7+/vY3{i7Roqvp8Yg' );
define( 'NONCE_SALT',       '0JXjvKQ:8n3J01/JGxs%HOiMwK5pIx%85grRp6q?r-mk`;SbS;}h^347u[]IIN2N' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
