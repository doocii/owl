<?php 
/* 
Template Name: 友链页面
*/ 
error_reporting(0);
$avatar_image = cs_get_option( 'i_avatar_image' );
$avatar_name = cs_get_option( 'i_avatar_name' );
$avatar_content = cs_get_option( 'i_avatar_content' );
$me = cs_get_option( 'i_me_switch' );
?>

<?php get_header(); ?>

		<section id="content">
            <div class="container">
                <div class="content-inner">
                    <div class="main_header colbox">
                        <div class="avatar_box col">
                            <div class="me_img">
                                <div class="me_avatar">
                                    <img src="<?php echo $avatar_image; ?>">
                                </div>
                                <span class="me_name"><?php echo $avatar_name; ?></span>
                            </div>
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
                        </div>
                        <div class="main-menu col">
                            <?php wp_nav_menu(array('theme_location' => 'main', 'container' => 'div', 'container_class' => 'header-menu-wrapper', 'menu_class' => 'header-menu-list', 'walker' => new description_walker())); ?>
                        </div>
                    </div>

                    <div class="main_body colbox">
                        <?php if (!is_mobile()) { ?>
                            <aside id="sidebar" class="col">
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
                                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Main Sidebar') ) : else : ?>
                                    <?php endif; ?>
                                </div>
                            </aside>
                        <?php }?>
                        <div id="main" class="col">
                            <div class="main-inner">
        	                    <div id="posts-box">
        	                        <div class="posts clearfix">
        								<article>
        									<div class="post-wrap">
        										<div class="post-inner">
        											<div class="post-body">
        												<header>
															<h2 class="entry-title">
																<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
																	<?php the_title(); ?>
																</a>
															</h2>
        												</header>
        												<div class="post-content">
        													<div calss="content">
        														<?php the_content(); ?>
                                                                <?php wp_list_bookmarks('orderby=id&category_orderby=id'); ?> 
        													</div>
        												</div>
        											</div>
        										</div>
        									</div>
        								</article>
        	                        </div>

									<!-- 评论 -->
									<?php if ('open' == $post->comment_status) { ?>
									<div id="comment-jump" class="comments">
										<?php comments_template(); ?>
									</div>
									<?php } ?>

        	                    </div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php get_footer(); ?>