<div id="back-top"></div>
<div id="footer">
	<?php if (is_home()&&!is_paged()) { ?>
    <ul class="links_list">
            <span><a href="<?php bloginfo('url'); ?>/links" target="_blank">友情链接</a></span>
			<?php wp_list_bookmarks('orderby=id&categorize=0&category=2&orderby=rand&title_li='); ?>
			<!-- 为了保证后期可以得到持续的技术支持，请您保留此连接 -->
			<li><a href="http://www.ui90.com/" target="_blank">90主题网</a></li>
        <div class="clearfix"></div>
    </ul>
    <div class="clearfix"></div>
	<?php } ?>

	<script type="text/javascript">
    $(document).ready(function(){
        $('.links_list').find('li:last').css('border-right','none');
    })
    </script>

	<p>
    	<a target="_blank" href="<?php bloginfo('url'); ?>/"> <?php bloginfo('nome'); ?></a>版权所有 <?php echo comicpress_copyright(); ?> | <a target="_blank" rel="nofollow" href="http://wordpress.org/">WordPress</a> 强力驱动 | Theme by <a target="_blank" href="http://www.qintag.com/">qintag</a>
		<?php if(get_qintag_option('icpbeian') == '') { ?>
            <?php { /* nothing */ } ?>
        <?php } else { ?>
        	| <a target="_blank" rel="nofollow" href="http://www.miibeian.gov.cn/"> <?php echo get_qintag_option('icpbeian'); ?></a> 
        <?php } ?>
        
        <?php if(get_qintag_option('cnzztongji') == '') { ?>
            <?php { /* nothing */ } ?>
        <?php } else { ?>
        	| <?php echo get_qintag_option('cnzztongji'); ?>
        <?php } ?>
 | <a href="<?php bloginfo('url'); ?>/sitemap">网站地图</a>  | <a href="<?php bloginfo('url'); ?>/tags">标签云</a> | <a href="<?php bloginfo('url'); ?>/?feed=rss2">RSS</a> 
        
    </p>

</div><!-- footer end -->
</div><!-- container end -->


<?php if(get_qintag_option('floating_adsense') == '') { ?>
	<?php { /* nothing */ } ?>
<?php } else { ?>
	<?php echo get_qintag_option('floating_adsense'); ?>
<?php } ?>

</div><!-- wrapper end -->
<?php wp_footer(); ?>
</body>
</html>