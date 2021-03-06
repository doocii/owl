<?php
 // 获取选项
$layout = cs_get_option('i_layout');
$excerpt = cs_get_option( 'i_post_readmore' ); 
$next = cs_get_option( 'i_post_next' ); 
$author = cs_get_option( 'i_post_author' ); 
$link = cs_get_option( 'i_post_link' ); 
$related = cs_get_option( 'i_post_related' ); 
$mbx = cs_get_option( 'i_post_mbx' ); 
$like = cs_get_option( 'i_post_like' );
$like_style = cs_get_option( 'i_like_style' );
$avatar_bg = cs_get_option( 'i_avatar_bg' );
$avatar_image = cs_get_option( 'i_avatar_image' );
$avatar_content = cs_get_option( 'i_avatar_content' );
$me = cs_get_option( 'i_me_switch' );
$bulletin = cs_get_option( 'i_bulletin' );
$like = cs_get_option( 'i_post_like' );
?> 

<?php get_header(); ?>

<section id="content">
    <div class="container"> 
        <div class="content-inner">

        <?php if (!is_mobile()) { ?>
            <div class="main_header colbox m_hide">
                <div class="avatar_box col">
                    <div class="me_img">
                        <div class="me_avatar">
                            <img src="<?php echo $avatar_image; ?>">
                        </div>
                        <ul class="me_name">
                            <li>
                                <p class="me_num"><?php $count_posts = wp_count_posts(); echo $published_posts =$count_posts->publish;?></p>
                                <p class="me_title">文章</p>
                            </li>
                            <li>
                                <p class="me_num"><?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?></p>
                                <p class="me_title">评论</p>
                            </li>
                            <li>
                                <p class="me_num"><?php $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); echo $link; ?></p>
                                <p class="me_title">邻居</p>
                            </li>
                        </ul>                   
                    </div>
                <?php if ($bulletin) { ?>
                    <div class="bulletin">
                        <?php
                            $my_bulletins = cs_get_option( 'i_bulletin_custom' );
                            echo '<ul class="bulletin_list">';
                            if( ! empty( $my_bulletins ) ) {
                              foreach ( $my_bulletins as $bulletin ) {
                                echo '<li style="display:none">';
                                if( ! empty( $bulletin['i_bulletin_link'] ) ){ echo '<a href="'. $bulletin['i_bulletin_link'] .'"';}
                                if ( ! empty( $bulletin['i_bulletin_link'] ) && $bulletin['i_bulletin_newtab'] == true) { echo 'target="_black">';}else{ if ( ! empty( $bulletin['i_bulletin_link'] )){ echo '>';}}
                                echo ''. $bulletin['i_bulletin_text'] .'';
                                if( ! empty( $bulletin['i_bulletin_link'] ) ){ echo '</a>';}
                                echo '</li>';
                              }
                            }
                            echo '</ul>';
                        ?>
                    </div>
                <?php } ?>
                </div>
                <div class="main-menu col">
                    <?php wp_nav_menu(array('theme_location' => 'main', 'container' => 'div', 'container_class' => 'header-menu-wrapper', 'menu_class' => 'header-menu-list')); ?>
                </div>
            </div>
        <?php } ?>


             <div class="main_body colbox">
                 <?php if (!is_mobile() && $layout == 'i_layout_two') { ?>
                     <aside id="sidebar" class="col m_hide">
                         <?php if ($me == true) {?>
                             <div id="about">
                                 <p class="me_content">
                                     <?php echo $avatar_content; ?>
                                 </p>
                                 <div class="social_link">
                                     <?php
                                         $my_socials = cs_get_option( 'i_social' );
                                         echo '<ul class="clearfix">';
                                         if( ! empty( $my_socials ) ) {
                                           foreach ( $my_socials as $social ) {
                                             $iconstyle = $social['i_icon_style'];
                                             echo '<li>';
                                             if( ! empty( $social['i_social_link'] ) ){echo '<a href="'. $social['i_social_link'] .'" title="'. $social['i_social_title'] .'"';}else{echo '<a href="javascript:void(0)" title="'. $social['i_social_title'] .'" ';}
                                             if ( $social['i_social_newtab'] == true) { echo 'target="_black"';}
                                             if ($iconstyle == 'i_icon') {echo '><i class="'. $social['i_social_icon'] .'"></i>';} else {echo '><img src="'. $social['i_social_image'] .'">';}
                                             echo '</a>';
                                             echo '</li>';
                                           }
                                         }
                                         echo '</ul>';
                                     ?>
                                 </div>
                             </div>
                         <?php } ?>
                         <div id="widget" class="widgets">
                             <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Aside') ) : else : ?>
                             <?php endif; ?>
                         </div>
                     </aside>
                 <?php }?>

                    <div id="main" class="col">
                        <div class="main-inner">
                            <div id="posts-box">
                                <div class="posts">
                                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                    <?php setPostViews(get_the_ID());?>
                                    <article <?php post_class('post'); ?>>
                                     <div class="post-wrap">
                                        <?php
											get_template_part('format', 'standard');
                                        ?>

                                        <?php if ($link == true && !is_mobile()) { ?>
                                        <div class="post-copyright m_hide">
                                            转载原创文章请注明，转载自： <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> » <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                        </div>
                                        <?php } ?>

                                        <div class="post-related m_hide">
                                            <?php if ($related == true && !is_mobile()) { ?>
                                            <ul class="related_box clearfix">
                                                <?php
                                                $post_num = 5;
                                                $exclude_id = $post->ID;
                                                $posttags = get_the_tags(); $i = 0;
                                                if ( $posttags ) {
                                                    $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
                                                    $args = array(
                                                        'post_status' => 'publish',
                                                        'tag__in' => explode(',', $tags),
                                                        'post__not_in' => explode(',', $exclude_id),
                                                        'caller_get_posts' => 1,
                                                        'orderby' => 'comment_date',
                                                        'posts_per_page' => $post_num
                                                    );
                                                    query_posts($args);
                                                    while( have_posts() ) { the_post(); ?>
                                                        <li class="related_box"  >
                                                        <div class="r_pic">
                                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
                                                        <img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
                                                        </a>
                                                        </div>
                                                        <div class="r_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"  rel="bookmark"><?php the_title(); ?></a></div>
                                                        </li>
                                                    <?php
                                                        $exclude_id .= ',' . $post->ID; $i ++;
                                                    } wp_reset_query();
                                                }
                                                if ( $i < $post_num ) {
                                                    $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
                                                    $args = array(
                                                        'category__in' => explode(',', $cats),
                                                        'post__not_in' => explode(',', $exclude_id),
                                                        'caller_get_posts' => 1,
                                                        'orderby' => 'comment_date',
                                                        'posts_per_page' => $post_num - $i
                                                    );
                                                    query_posts($args);
                                                    while( have_posts() ) { the_post(); ?>
                                                    <li>
                                                        <div class="r_pic">
                                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
                                                        <img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
                                                        </a>
                                                        </div>
                                                        <div class="r_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"  rel="bookmark"><?php the_title(); ?></a></div>
                                                    </li>
                                                    <?php $i++;
                                                    } wp_reset_query();
                                                }
                                                if ( $i  == 0 )  echo '<div class="r_title"></div>';
                                                ?>
                                            </ul>
                                            <?php } ?>
                                        </div>
                                            <ul class="bottom_meta clearfix">
                                                <li class="mate-time fl"><i class="fa fa-clock-o"></i><?php echo ''.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
                                                <li class="mate-cat fl m_hide"><i class="fa fa-bookmark"></i><?php the_category(' '); ?></li>
                                                <?php $posttags = get_the_tags(); if ($posttags) { ?>
                                                    <li class="meta_tabs fl m_hide"><i class="fa fa-tags"></i><?php the_tags('', ' ', ''); ?></li>
                                                <?php } ?>

                                                <?php if ($like == true) { ?>
                                                    <li class="meta_like fr">
                                                        <?php echo getPostLikeLink( get_the_ID() ); ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                     </div>
                                    </article>
                                    <?php endwhile; ?>
                                    <?php endif; ?>

                                    <?php if( is_single () ) { ?>
                                        <?php if ('open' == $post->comment_status) { ?>
                                        <div id="comment-jump" class="comments">
                                            <?php comments_template(); ?>
                                        </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
		</div>
    </div>
</section>

<?php get_footer(); ?>