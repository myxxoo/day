<?php get_header(); ?>
<div id="content">

    <div id="post_entry">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="past_mata">
                <h2><a target="_blank" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,60); ?></a></h2>
                <p>
                    <span>发表于:<?php the_time('Y年m月d日'); ?> </span>
                    <span>标签有:<?php the_tags('', ', ', ''); ?></span>
                    <span><?php if(function_exists('the_views')) { echo"人气:"; the_views(); } ?></span>
                </p>
        
                <div class="past_content">
                    <?php if (has_excerpt()) { ?> <?php the_excerpt() ?> <?php } else{
                        echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 600,"......"); } ?>
                </div>
            
                <p>
                    <span>分类:<?php the_category(', ') ?></span> | 
                    <span><?php comments_popup_link('发表回复'); ?></span>  | 
                    <span><a target="_blank" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">继续阅读</a></span>
                    <span class="edit_link right"><?php edit_post_link('编辑'); ?></span>
                </p>
                <div class="comments_link"><?php comments_popup_link('0', '1', '%'); ?></div>
            </div><!-- past_mata end -->
		<?php endwhile; ?><?php else : ?>
			<p class="center">抱歉!</p>
			<p class="center">无法搜索到与之相匹配的信息。</p>
		<?php endif; ?>
        <div class="clearfix"></div>
    </div><!-- post_entry end -->
	<div id="paginatios"><?php wp_pagenavi(); ?></div>   
</div><!-- content end -->
<?php get_footer(); ?>