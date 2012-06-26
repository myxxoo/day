<?php 
/**********************************************************************
 Copyright © 2007-2012 秦唐网 (http://ui90.com)
 本作品采用知识共享署名-非商业性使用-相同方式共享 2.5 中国大陆许可协议
 进行许可(http://creativecommons.org/licenses/by-nc-sa/2.5/cn/)
**********************************************************************/



//登陆显示头像
function qintag_get_avatar($email, $size = 48){
return get_avatar($email, $size);
}
//禁用半角符号自动转换为全角
remove_filter('the_content', 'wptexturize');

//////////////////////////////标题文字截断//////////////////////////////
function cut_str($src_str,$cut_length) {
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length)) {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224) {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192) {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90) {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length) {
        $return_str = $return_str . '';
    }
    if (get_post_status() == 'private') {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}
// -------- END -------------------------------------------------------

//////////////////////////////支持外链缩略图///////////////////////////
function get_featcat_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/random.jpg';
  }
  return $first_img;
}
// -------- END -------------------------------------------------------

//////////////////////////////版权年份自动化//////////////////////////////
function comicpress_copyright() {
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
		SELECT
        YEAR(min(post_date_gmt)) AS firstdate,
        YEAR(max(post_date_gmt)) AS lastdate
        FROM
        $wpdb->posts
        WHERE
        post_status = 'publish'");
    $output = '';
    if($copyright_dates) {
        $copyright = "© " . $copyright_dates[0]->firstdate;
        if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
            $copyright .= '-' . $copyright_dates[0]->lastdate;
        }
        $output = $copyright;
    }
    return $output;
}
// -------- END -------------------------------------------------------

//////////////////////////////彩色标签云///////////////////////////////
function colorCloud($text) {
    $text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
    return $text;
}
function colorCloudCallback($matches) {
    $text = $matches[1];
    for($a=0;$a<6;$a++){    //采用#ffffff方法
       $color.=dechex(rand(1,15));//累加随机的数据--dechex()将十进制改为十六进制
    }
    $pattern = '/style=(\'|\")(.*)(\'|\")/i';
    $text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
    return "</a><a $text>";
    unset($color);//卸载color
}
add_filter('wp_tag_cloud', 'colorCloud', 1);
// -------- END -------------------------------------------------------


//////代码实现WordPress归档页面模板 http://zww.me/archives/25589/////
 function qintag_archives_list() {
     if( !$output = get_option('qintag_archives_list') ){
         $output = '<div id="archives"><p>[<a id="al_expand_collapse" href="#">全部展开/收缩</a>] <em>(注: 点击月份可以展开)</em></p>';
         $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
         $year=0; $mon=0; $i=0; $j=0;
         while ( $the_query->have_posts() ) : $the_query->the_post();
             $year_tmp = get_the_time('Y');
             $mon_tmp = get_the_time('m');
             $y=$year; $m=$mon;
             if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
             if ($year != $year_tmp && $year > 0) $output .= '</ul>';
             if ($year != $year_tmp) {
                 $year = $year_tmp;
                 $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
             }
             if ($mon != $mon_tmp) {
                 $mon = $mon_tmp;
                 $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
             }
             $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a><em>('. get_comments_number('0', '1', '%') .')</em></li>'; //输出文章日期和标题
         endwhile;
         wp_reset_postdata();
         $output .= '</ul></li></ul></div>';
         update_option('qintag_archives_list', $output);
     }
     echo $output;
 }
 function clear_zal_cache() {
     update_option('qintag_archives_list', ''); // 清空 qintag_archives_list
 }
 add_action('save_post', 'clear_zal_cache'); // 新发表文章/修改文章时

// -------- END -------------------------------------------------------



//////////////////////////////3.0菜单支持//////////////////////////////
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' ); //添加缩略图功能支持
	set_post_thumbnail_size( 150, 200, true ); // Normal post thumbnails
	add_image_size( 'gallery150cc200', 150, 200, true ); // 列表缩略图
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( '主导航'),
	) );
    add_theme_support( 'menus' ); // new nav menus for wp 3.0
}

function revert_wp_menu_category() { //revert back to normal if in wp 3.0 and menu not set ?>

<?php }
// -------- END -------------------------------------------------------
///////////////////////////主题设置////////////////////////////////////
$themename = "L1(free)";
$shortname = str_replace(' ', '_', strtolower($themename));
function get_qintag_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}
$number_entries = array("Number of post:","1","2","3","4","5","6","7","8","9","10");

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "请选择...");


$options = array (
array( "name" => $themename." Options", "type" => "title"),

array( "name" => "首要设置", "type" => "section"),
array( "type" => "open"),
	
array( "name" => "网站关键词",
	"desc" => "网站关键字，例如：秦唐网,胖子马,forigi,purple,mapeimapei,qintag",
	"id" => $shortname."_indexkeyword",
	"type" => "textarea",
	"std" => ""),

array( "name" => "网站描述",
	"desc" => "例如：秦唐网，小马PE，专注于网站建设、网络营销和电脑技术的研究与分享",
	"id" => $shortname."_indexdescription",
	"type" => "textarea",
	"std" => ""),
	


array( "type" => "close"),

///////////////////////////////////////////////////////////////////////
array( "name" => "网站广告管理", "type" => "section"),
array( "type" => "open"),
	
array( "name" => "文章开头广告",
	"desc" => "大小300*250",
	"id" => $shortname."_ads300",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "文章结尾广告",
	"desc" => "大小728*90",
	"id" => $shortname."_ads728",
	"type" => "textarea",
	"std" => ""),
	
	
array( "name" => "评论框的邻居",
	"desc" => "大小为180*150的广告，代码，图片随意",
	"id" => $shortname."_ad_comment_180_150",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "浮动、悬浮广告",
	"desc" => "悬浮广告代码",
	"id" => $shortname."_floating_adsense",
	"type" => "textarea",
	"std" => ""),

array( "type" => "close"),



//////////////////////////////////////////////////////////////////////////////

array( "name" => "页脚部分", "type" => "section"),
array( "type" => "open"),

array( "name" => "ICP备案号",
	"desc" => "您的ICP备案信息，如：陕ICP备11004443号",
	"id" => $shortname."_icpbeian",
	"type" => "texts",
	"std" => "陕ICP备12345678号"),
	
array( "name" => "统计代码",
	"desc" => "cnzz等网站统计代码，这个就不多解释了",
	"id" => $shortname."_cnzztongji",
	"type" => "textarea",
	"std" => ""),


array( "type" => "close"),

);

//////////////////////////////////////////////////////////////////////////////
function qintag_add_admin() {
	global $themename, $shortname, $options;
		if ( $_GET['page'] == basename(__FILE__) ) {
			if ( 'save' == $_REQUEST['action'] ) {
				foreach ($options as $value) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
				foreach ($options as $value) {
					if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
				header("Location: admin.php?page=functions.php&saved=true");
				die;
				} 
			else if( 'reset' == $_REQUEST['action'] ) {
				foreach ($options as $value) {
					delete_option( $value['id'] ); }
					header("Location: admin.php?page=functions.php&reset=true");
					die;
			}
		}
	add_theme_page($themename." Options", "设置当前主题", 'edit_themes', basename(__FILE__), 'qintag_admin');
}

//////////////////////////////////////////////////////////////////////////////
function qintag_add_init() {
	$file_dir=get_bloginfo('template_directory');
	wp_enqueue_style("functions", $file_dir."/css/functions/functions.css", false, "1.0", "all");
	wp_enqueue_script("rm_script", $file_dir."/css/functions/rm_script.js", false, "1.0");
}

//////////////////////////////////////////////////////////////////////////////
function qintag_admin() {
	global $themename, $shortname, $options;
	$i=0;
		if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置完成.</strong></p></div>';
		if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 重置完成.</strong></p></div>';
?>


<div class="rm_wraps">
<form method="post">
<div class="rm_wrap">
	<h2><?php echo $themename; ?> 主题设置</h2>
		<p>当前使用主题: <?php echo $themename; ?> | 设计者:<a href="http://www.ui90.com" target="_blank"> 胖子马</a> | <a href="http://www.ui90.com/original/wordpress-l1.html" target="_blank">查看主题更新</a></p>
	<div class="rm_opts">
		<?php foreach ($options as $value) {
			switch ( $value['type'] ) {
			case "open":
		?>
		<?php break;
			case "close":
		?>
	</div>
</div>
	
<?php break;
case "title":
?>

<div id="announce">
	<h1>欢迎您使用 <?php echo "$themename"; ?> 主题</h1>
	<span>更方便的使用：
		(1) <a href="http://www.ui90.com/" target="_blank">胖子马主题作品集合</a>;
		(2) <a href="http://blog.ui90.com/" target="_blank">app主题帮助中心</a>;
		(3) <a href="http://weibo.com/qintag" target="_blank">新浪博客</a>;
		(4) <a href="http://feed.ui90.com" target="_blank"><img border="0" src="http://img.feedsky.com/images/icon_sub_c1s14.gif" alt="feedsky" vspace="2"  style="margin:10px 0 0 0;" ></a>
	</span>
</div>

<?php
break;
case 'texts':
?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
</div>

<?php
break;
case 'textarea':
?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
</div>

<?php
break;
case 'select':
?>
<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option value="<?php echo $option;?>" <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
		<?php
		if ((empty($option) || $option == '' ) && isset($value['default_option_value'])) {
			echo $value['default_option_value'];
		} else {
			echo $option; 
		}?>
		
		</option><?php } ?>
</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php
break;
case "checkbox":
?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
</div>

<?php break; 
case "section":
$i++;
?>
<div class="rm_section">
	<div class="rm_title">
		<h3><img src="<?php bloginfo('template_directory')?>/css/functions/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="保存设置" /></span>
		<div class="clearfix"></div>
	</div>

	<div class="rm_options">
		<?php break;
			}
			}
		?>

		<input type="hidden" name="action" value="save" />
	</div>
</form>

	<form method="post">
		<p class="submit">
			<input name="reset" type="submit" value="恢复默认" /><font color=#ff0000>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
			<input type="hidden" name="action" value="reset" />
		</p>
	</form>


	<div id="sthiks">
		<h1>其 它</h1>
		<p>本人在<?php echo $themename; ?>主题制作中，也倾入了诸多心血，所以不能保留底部链接的，不尊重我的劳动成果的人，请绕行，不欢迎你使用本主题！</p>
		<p class="note">本作品采用<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/cn/">知识共享署名-非商业性使用-相同方式共享 2.5 中国大陆许可协议</a>进行许可。</p>
	</div>
</div>

<div id="other">
	<h1>扩展</h1>
	<div id="other_c">
    
    <a class="dingyue" target="_blank" href="http://list.qq.com/cgi-bin/qf_invite?id=3fcd15e2424f850821b53d879c5cca3b72aa40a8b3b9a890">订阅90主题网</a>
    
    
		<form id="search" method="get" action="http://www.ui90.com/">
			<input class="other_s" type="text" name="s" id="textfield" onblur="if (this.value == '') {this.value = '输入关键词搜索...';}" onfocus="if (this.value == '输入关键词搜索...') {this.value = '';}" value="输入关键词搜索..." />
			<input class="other_btn" type="submit" id="submit" value="搜索" />
		</form>

		<?php // Get RSS Feed(s)
			include_once(ABSPATH . WPINC . '/feed.php');
			$rss = fetch_feed('http://www.ui90.com/feed');			
			// Of the RSS is failed somehow.
			if ( is_wp_error($rss) ) {
				$error = $rss->get_error_code();
				if($error == 'simplepie-error') {
					//Simplepie Error
					echo "<div class='updated fade'><p>An error has occured with the RSS feed. (<code>". $error ."</code>)</p></div>";
				}
				return;
				} 
		?>
        <?php
			$items = $rss->get_items(0, 10);
        ?>
		<h2 class="bg2">主题相关文章</h2>	
        <ol>
			<?php
				if (empty($items))
					echo '<li>No items</li>';
				else
					foreach ( $items as $item ) : ?>
					<li>
						<a target="_blank" href='<?php echo esc_url( $item->get_permalink() ); ?>' title='<?php echo $item->get_title(); ?>'><?php echo ( $item->get_title() ); ?></a>
					</li>
			<?php endforeach; ?>
			<a style="float:right;padding-top:5px;padding-right:10px;font-weight:700;" target="_blank" href='http://www.ui90.com/'>更多内容>></a>
        </ol>
		
		<h2 class="bg3">捐助：</h2>
		<p>您的支持，是对胖子马最大的鼓励和肯定！<br />
		<strong>支付宝：<font color=#21759b>qintag@sina.com</font></strong> 姓名:马沛</p>
		<a target="_blank" href='http://me.alipay.com/qintag'> <img src='https://img.alipay.com/sys/personalprod/style/mc/btn-index.png' /> </a>
	</div>
</div>
<?php } ?>
<?php
//add_action('wp_head', 'mytheme_wp_head');
add_action('admin_init', 'qintag_add_init');
add_action('admin_menu', 'qintag_add_admin');
//全部结束，如果下边出现什么函数，需要注意哦！
?>