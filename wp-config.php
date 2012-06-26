<?php
/** 
 * WordPress 基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL 设置、数据库表名前缀、密钥、
 * WordPress 语言设定以及 ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑 wp-config.php} Codex 页面。MySQL 设置具体信息请咨询您的空间提供商。
 *
 * 这个文件用在于安装程序自动生成 wp-config.php 配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后输入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress 数据库的名称 */
define('DB_NAME', 'day');

/** MySQL 数据库用户名 */
define('DB_USER', 'root');

/** MySQL 数据库密码 */
define('DB_PASSWORD', 'root');

/** MySQL 主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密匙设定。
 *
 * 您可以随意写一些字符
 * 或者直接访问 {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org 私钥生成服务}，
 * 任何修改都会导致 cookie 失效，所有用户必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|(<hgA(%XS6UlWD7]} (cSbA?DW;em|a3U-pH:.-hnLVH/?_Af:,h(*f9q9<yLw5');
define('SECURE_AUTH_KEY',  'eg!leJkR4cZN#@v|{3m[t( khdu?Y&^H;pJO`6z|8.=.PsB;p(+eC.msyizM8p=C');
define('LOGGED_IN_KEY',    'OD<5{]6 SxVW$U(?v7(w+%XCw2ZA+1gu ?n#]e4QFU^Wu8GG;+ 4:G[0T@|cSfY8');
define('NONCE_KEY',        'v-c.ek^b=K>PjLYAAyUE:w+,/n?/&E.7t^2HmEmY6c;iR^E(K7M9GB5$j* w-KC$');
define('AUTH_SALT',        '2d{M5x5Wb?jxK97m@xWX7Am(H--n#H%$jR+y:&<VpS7b/~Fc~jqQ+%M:V3+NEBh@');
define('SECURE_AUTH_SALT', '}|7=@EHM*kENpJO@%q6Fm>E?*?vPYgcI+/#x(Q-fr:yTW:gvonPDy_Axx*6AkbFa');
define('LOGGED_IN_SALT',   'hx@|xpxkcB2ORzSe`H,fftG$-T%l,$x>8J5;mV2(*=|gi/}q%ws.F?pNyG[K@Cif');
define('NONCE_SALT',       '>!fT]4SQf$n6Mv1cCFZ`QE=-#TmC|d3cb3`1N)%XLfOml6le|+>}wS.|u~79}sCW');

/**#@-*/

/**
 * WordPress 数据表前缀。
 *
 * 如果您有在同一数据库内安装多个 WordPress 的需求，请为每个 WordPress 设置不同的数据表前缀。
 * 前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'd_';

/**
 * WordPress 语言设置，中文版本默认为中文。
 *
 * 本项设定能够让 WordPress 显示您需要的语言。
 * wp-content/languages 内应放置同名的 .mo 语言文件。
 * 要使用 WordPress 简体中文界面，只需填入 zh_CN。
 */
define('WPLANG', 'zh_CN');

/**
 * 开发者专用：WordPress 调试模式。
 *
 * 将这个值改为“true”，WordPress 将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用本功能。
 */
define('WP_DEBUG', false);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress 目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置 WordPress 变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');

