<?php
define('WP_AUTO_UPDATE_CORE', 'minor');

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

define( 'DB_NAME', 'palmetto_mypalmetto' );


/** MySQL database username */

define( 'DB_USER', 'palmetto_passport' );


/** MySQL database password */

define( 'DB_PASSWORD', 'admin@mypalmetto' );


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

define( 'AUTH_KEY',         '<owDElfjLpgx=VQd^z2S^%Pn CqY].zuxzfy: H+:u#p,Db_Kq|V#~MF-cV<M-)o' );

define( 'SECURE_AUTH_KEY',  'I1TanA@;$n>Z>y~NXH~(>2<3-n[zX7w5fft`2,Y0q6&(A.|7f7gca10;<!R$E[}z' );

define( 'LOGGED_IN_KEY',    '6QKfJQ@0<-T^_X#PFuj;WP1^lv/l+L*GarS|OI<<vh-8`G5BjzSM]snDd!&2JxqV' );

define( 'NONCE_KEY',        '!.X 9e5w!o.JId!o.aFOnNQXYr8:c#El{ZMV j9tl|S6/9MJ$]f1F470.Ep0ei><' );

define( 'AUTH_SALT',        'Hq6o7/2DMj8 XplaXlaO>G0$JEBZnKtIe8eMMsNi0-);z}4v~G36B!a8~Q9V:2&<' );

define( 'SECURE_AUTH_SALT', 'GszvtPYjVya]CFHFj}?A>MX:%{W`rSLE*]X`v4zJo!S68YL7W=o/MUBQ?tcJ>;%Q' );

define( 'LOGGED_IN_SALT',   '>h#B^=3l`?5lEJ6Ts%KabDd~?-.ADr2i`do^X<Bd8YOJwQ$.tS3VMh<jWuG5.Cg|' );

define( 'NONCE_SALT',       'z7Z>]7|>ui0[_=2Me[7Qy,)uNP+DwR[*5R66bp&~{EJ0Y)>,{5`b%BVMsqI(C B0' );


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

