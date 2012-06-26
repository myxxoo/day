<?php
/*
Template Name: Archives
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
                    <?php qintag_archives_list(); ?>
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

<script type="text/javascript">
jQuery(document).ready(function($){
 //===================================存档页面 jQ伸缩
     (function(){
         $('#al_expand_collapse,#archives span.al_mon').css({cursor:"pointer"});
         $('#archives span.al_mon').each(function(){
             var num=$(this).next().children('li').size();
             var text=$(this).text();
             $(this).html(text+'<em> ( '+num+' 篇文章 )</em>');
         });
         var $al_post_list=$('#archives ul.al_post_list'),
             $al_post_list_f=$('#archives ul.al_post_list:first');
         $al_post_list.hide(1,function(){
             $al_post_list_f.show();
         });
         $('#archives span.al_mon').click(function(){
             $(this).next().slideToggle(400);
             return false;
         });
         $('#al_expand_collapse').toggle(function(){
             $al_post_list.show();
         },function(){
             $al_post_list.hide();
         });
     })();
 });
</script>
<?php get_footer(); ?>