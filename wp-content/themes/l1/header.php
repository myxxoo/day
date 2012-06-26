<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/main.css" />
<!--[if lt IE 7]>
<div style="color:red;font-size:14px; background:#FFDF7B; text-align:center;line-height:36px; height:36px;">你正在使用的浏览器版本太低，将不能正常浏览本站。请升级 <a href="http://windows.microsoft.com/zh-CN/internet-explorer/downloads/ie">Internet Explorer</a>或使用<a href="http://www.google.com/chrome/">Chrome</a> 浏览器</div>
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="Shortcut Icon" href="<?php bloginfo('template_directory');?>/images/favicon.ico" type="image/x-icon" /><!-- 网站fav图标 -->
<link rel="Bookmark" href="<?php bloginfo('template_directory');?>/images/favicon.ico" />
<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
<div id="container">

<div id="header">
	<div class="siteinfo left">
		<div class="site_title">
			<a href="<?php bloginfo('siteurl');?>" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a>
		</div><!-- site_title end -->	
		<div class="site_description mt10"><?php bloginfo( 'description' ); ?></div>
	</div><!-- siteinfo end -->


	<div class="top_extend right">
		<div class="topsearch right mt10">
			<form method="get" class="searchform" action="<?php bloginfo('home'); ?>/">
				<input type="submit" class="searchsubmit" value="搜 索" />
				<input type="text" name="s" class="s" placeholder="文章标题 关键词..." value="" x-webkit-speech="" required="" />
			</form>
		</div>

		<ul class="navigation right clear bold mt15">
			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
		</ul>
	</div>
	<div class="clearfix"></div>
</div><!-- header end -->
    

