<?php
/*
Template Name: Links
*/
?>
<?php get_header(); ?>
<div id="content">
    <div id="post_entry">
        <div class="past_mata">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2><?php echo cut_str($post->post_title,60); ?></h2>

                <div class="past_content">
                    <?php the_content(); ?><!-- 文章内容 -->


                    <ul class="links">
                        <?php wp_list_bookmarks('title_li=&categorize=&category=2&orderby=rand'); ?>
                        <div class="clearfix"></div>
                        

                        
                        
                    </ul>

					<div class="clearfix"></div>
                </div>
                <div class="comments_link"><?php comments_popup_link('0', '1', '%'); ?></div>
				<?php if(get_qintag_option('ads728') == '') { ?>
                    <?php { /* nothing */ } ?>
                <?php } else { ?>
                    <div class="past_bot_ads mt20">
                        <?php echo get_qintag_option('ads728'); ?>
                    </div>
                <?php } ?>
            <?php endwhile; endif; ?>
        </div><!-- past_mata end -->
        <?php comments_template( '', true ); ?>
    </div><!-- post_entry end -->
</div><!-- content end -->

<?php get_footer(); ?>