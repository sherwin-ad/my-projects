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
define( 'DB_NAME', 'wordpress' );
/** Database username */
define( 'DB_USER', 'wpuser' );
/** Database password */
define( 'DB_PASSWORD', 'wppass' );
/** Database hostname */
define( 'DB_HOST', 'db' );
/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );
/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('FS_METHOD', 'direct');
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
define( 'AUTH_KEY',         '5/DF@Kz)H#A=E(M.[6uMY-LKjbKz3#|,PKb<56<m&[S6cEMEpggR>`}l4IqsUY(c' );
define( 'SECURE_AUTH_KEY',  '+uLt.:dHV%j_$*:@y`CO|g.WPXD/2P&P_Ge7iN-,)I4+{X>iK!pUU|S@H&FN(07e' );
define( 'LOGGED_IN_KEY',    'G$cl-sa=zkm8F*[D|bNeCRc<-ei_LCWJ`.IpM[`=.#[&SQ}u+X7,*}*5.WB?tySu' );
define( 'NONCE_KEY',        'ZSdlYx699I1-;}0f)i$290Zx1oM[xzhPy5[St+*3F9gF;4?y]B{r bQ5Gw*wp}>%' );
define( 'AUTH_SALT',        'GUpg+k.W`{N-3!D#hlPUVD!C5mSUl6Y*>X.1bBP:wXTiySl?U~sttc4IokG+XdS3' );
define( 'SECURE_AUTH_SALT', 'HWXFs%jp0,$A4)ebN8u]_z1b@^2B!;qDWrjuI_Np.P>.5$@E<)XF-,S;]0S[$MWA' );
define( 'LOGGED_IN_SALT',   'd%i1.FO3a<3gu[38tR[I|hpawR*Y}*?4DGH[?g7q;xeqz$L`Njq0O+75|X`Fd%XP' );
define( 'NONCE_SALT',       'Rj;ON:cf,m`6fHHo::@B8<1_.y:Kd:rAqW[l_QcRLQkeA#VU9lx+m$DKBM1&~hW`' );
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
define( 'WP_DEBUG', false );
/* Add any custom values between this line and the "stop editing" line. */
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';