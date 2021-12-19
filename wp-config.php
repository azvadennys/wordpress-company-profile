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
define( 'DB_NAME', 'company' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '<b&L*vQRITT5dRs7W=xyi6g{KI@el)YW_+9z]TDNN^x#N-!ckNkj<QGi2e ysIbP' );
define( 'SECURE_AUTH_KEY',  'q[_+#}NOyl6;j0yO7p6CuyXU8anGW~PssCCirv^<idkC(=CP-3Jg#F46,s#<F(6t' );
define( 'LOGGED_IN_KEY',    '22e<?9VfxM)t~OK!SGl_)ozN$(?z59:8PjMmQQ01:4q/GX2As8,GQ~4fATWaI**t' );
define( 'NONCE_KEY',        '^Z3Ri2j4DO*+O>8$@Hgo2bZWF07-<WMDJjV5O:KK,MJ0D9>R&zaDv1EX0?A{x=A<' );
define( 'AUTH_SALT',        ' kMtBz|:Qw{o(S[YntHV[f2o6&-Ao(N1cBh{8:z_543W#0:Ux!mt$ Us&<904n)-' );
define( 'SECURE_AUTH_SALT', '$3`(o1Sge{TuTO(_^2__,]z,l_&Ud;y1BPfP@Q/azwO.O%g+Sh5$*SYJF%6%OWOz' );
define( 'LOGGED_IN_SALT',   'FuS-2x_<h47e:`7g@4?4O?X0|s?sTEXDy6~tUO^MTm%qj<5h_ifp0W)K=Sumz8>{' );
define( 'NONCE_SALT',       '?d*Exj(H,:$L}tE[p03vdmT0Zdwh[K>Q3YM3> S36GEjLBA735n9{u)KSOg{L)rT' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp7_';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
