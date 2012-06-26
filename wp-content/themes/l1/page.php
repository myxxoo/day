<?php get_header(); ?>
<div id="content">
    <div id="post_entry">
        <div class="past_mata">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2><?php echo cut_str($post->post_title,60); ?></h2>
                <p>
                    <span>作者:<?php the_author_posts_link(); ?></span>
                    <span>发表于:<?php the_time('Y年m月d日'); ?> </span> | 
                    <span><?php if(function_exists('the_views')) { echo"人气:"; the_views(); } ?></span>
                    <span class="edit_link right"><?php edit_post_link('编辑'); ?></span>
                </p>
    
                <div class="past_content">
                    <?php the_content(); ?><!-- 文章内容 -->
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