<?php
 // 获取选项
error_reporting(0);
$copyright = cs_get_option( 'i_foot_copyright' );  
$gotop = cs_get_option( 'i_gotop' );  
$qrcode = cs_get_option( 'i_qrcode' );  
$qrcodeimg = cs_get_option( 'i_qrcode_image' );  
$loadmore = cs_get_option( 'i_ajax_loading' );  
$loadend = cs_get_option( 'i_ajax_end' ); 
$loadnum = cs_get_option( 'i_ajax_num' ); 
$pagination = cs_get_option('i_pagination'); 	
$comment = cs_get_option( 'i_comment_switch' ); 
$player_id = cs_get_option( 'i_player_id' ); 
$player = cs_get_option('i_player');
$player_mobi = cs_get_option('i_player_mobi');
$unlock = cs_get_option( 'i_comment_unlock' ); 
$share = cs_get_option( 'i_share' ); 
$share_img = cs_get_option( 'i_share_img' ); 
$share_word = cs_get_option( 'i_share_word' ); 
$tongji = cs_get_option( 'i_js_tongji' );
$circle = cs_get_option( 'i_circle' ); 
$snowfall = cs_get_option( 'i_snowfall' ); 
$modal = cs_get_option( 'i_modal' ); 
$modal_title = cs_get_option( 'i_modal_title' ); 
$modal_main = cs_get_option( 'i_modal_main' ); 
$shengming = cs_get_option( 'i_download_shengming' ); 
$layout = cs_get_option( 'i_layout' );
$sliders = cs_get_option( 'i_slider' );
?> 
	
	<footer id="footer">
        <div class="footer-inner">
            <div class="container clearfix">
				<?php
					$column = cs_get_option( 'i_topbar_col' );
					$column_style = '';
					switch ($column) {
						case "col_1":
							$column_style = 'columns1';
							break;

						case "col_2":
							$column_style = 'columns2';
							break;

						case "col_3":
							$column_style = 'columns3';
							break;

						case "col_4":
							$column_style = 'columns4';
							break;
					}
				 ?>
                <div id="drawer-inside" class="widgets clearfix <?php echo $column_style; ?>">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Drawer') ) : else : ?>		
                    <?php endif; ?>		
                </div>
            </div>
        </div>
        <div class="footer-end">
            <div class="container clearfix">
                <?php if( ! empty( $copyright ) ){ echo ''.$copyright.'';}else{
                    echo'&copy; '.date("Y").' All Rights Reserved.';
                } ?>	

                <a href="http://zhw-island.com/" target="_blank"> Theme by Island</a>

                <?php if( ! empty( $tongji ) ){ echo '<script>'.$tongji.'</script>';}else{
                    echo' ';
                } ?>			
            </div>
        </div>
	</footer>

    <?php if (!is_mobile()) { ?>
		<div id="footer_btn">
			<ul>
				<?php if ($gotop == true) {
					echo '<li class="mate-gotop">
							<a href="#totop" class="scrolltotop" title="回到顶部"><i class="fa fa-chevron-up"></i></a>
						</li>';
				}?>
	
				<?php if ($share == true) {
					echo '<li class="baidu_share">
							<a href="javascript:void(0)" class="share_icon" title="分享">
								<i class="fa fa-share"></i>
							</a>								
								<div class="share_show" style="display: none;">
									<div class="bdsharebuttonbox">
										<a href="#" class="bds_mshare" data-cmd="mshare" title="一键分享">一键分享</a>
										<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">新浪微博</a>
										<a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博">腾讯微博</a>
										<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">微信</a>
										<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间">QQ空间</a>
										<a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣">豆瓣</a>
										<a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网">人人网</a>									
										<a href="#" class="bds_twi" data-cmd="twi" title="分享到 Twitter">Twitter</a>
										<a href="#" class="bds_fbook" data-cmd="fbook" title="分享到 Facebook">Facebook</a>
									</div>
									<div class="clear"></div>
								</div>
						<script>
							window._bd_share_config = {
								"common": {
									"bdSnsKey": {},
									"bdText": "",
									"bdMini": "2",
									"bdPic": "",
									"bdStyle": "0",
									"bdSize": "16"
								},
								"share": {},';
				}?>	
				<?php if ($share == true && $share_img == true) {	
						echo '				
								"image": {
									"viewList": ["qzone", "tsina", "tqq", "renren", "weixin"],
									"viewText": "分享到：",
									"viewSize": "16"
								},';
				}?>	
				<?php if ($share == true && $share_word == true) {	
						echo '
								"selectShare": {
									"bdContainerClass": null,
									"bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"]
								}';
				}?>		
				<?php if ($share == true) {
					echo '	
							};
							with(document) 0[(getElementsByTagName("head")[0] || body).appendChild(createElement("script")).src = "http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=" + ~ (-new Date() / 36e5)];
						</script>				
					</li>';
				}?>		
				
				<?php if ($comment == true && is_single ()) {
					echo '<li class="mate-com">
							<a href="#comment-jump" class="comment_btn" title="评论"><i class="fa fa-comment-o"></i></a>
						  </li>';
				}?>								
				
				<?php if ($qrcode == true) {
					echo '<li class="mate-qrcode">
							<a style="" title="二维码" href="javascript:void(0)" id="r-wx">
							<i class="fa fa-qrcode"></i>
								<div id="fi-wx-show" style="display: none;">
									<img src="'. $qrcodeimg .'">
								</div>
							</a>
						</li>';
				}?>	

			</ul>
		</div>
	<?php }?>	


	<?php if ($player_mobi == true && is_mobile() ) { }else{ ?>
		<?php if ($player == true && ! empty( $player_id ) && function_exists('cue_playlist') ) {?>
			<!-- 音乐播放器 -->
				<?php cue_playlist( $player_id ); ?>
		<?php }	 ?>
	<?php }	 ?>

	<?php if ($modal == true && !is_mobile() ) {?>		
		<?php
		setcookie('modal','show',time()+3600);
		if(isset($_COOKIE["modal"])){
		}else{?>	
			<div class="modal-bg">
				<div class="modal-body">
					<div class="modal-head clearfix">
						<div class="modal-title"><?php echo $modal_title ?></div>
						<div class="modal-close"><a href="javascript:void(0)"><i class="fa fa-times"></i></a></div>
					</div>
					<div class="modal-main"><?php echo $modal_main ?></div>
				</div>
			</div>
		<?php }	?>	
	<?php }	?>	

	<?php if ( is_single() && !is_mobile() ) {?>		
        <div class="download-bg modal-bg hide">
            <div class="modal-body">
                <div class="modal-head clearfix">
                    <div class="modal-title"><i class="fa fa-download"></i>资源下载</div>
                    <div class="modal-close"><a href="javascript:void(0)"><i class="fa fa-times"></i></a></div>
                </div>
                <div class="modal-main">
                    <div class="dl-btn"><a href="javascript:void(0)" target="_black"><i class="fa fa-download"></i>点击下载</a></div>
                    <div class="dl-tqcode">提取码：<span></span></div>
                </div>
                <div class="modal-bottom">
                    <span>下载声明：<?php echo $shengming ?></span>
                </div>
            </div>
        </div> 
	<?php }	?>

	<?php get_sidebar(); ?>

    <?php if ( !is_user_logged_in() ) { ?>
        <div class="cd-user-modal">
            <a href="#" class="cd-close-form"></a>
            <div class="cd-user-modal-container">
                <div class="login-img"></div>
            	<div class="login-form">
                    <?php
                        $login_form_args = array (
                            'form_id' => 'login-form',
                            'label_log_in' => '登录',
                            'remember' => false,
                            'value_remember' => false
                        );
                    ?>
                    <?php wp_login_form($login_form_args); ?>
                    <p class="login-links clearfix">
                        <span class="alignleft">
                            <a href="<?php echo htmlspecialchars(wp_lostpassword_url(get_permalink()), ENT_QUOTES); ?>"><?php echo __('忘记密码', 'pinthis'); ?></a>
                        </span>
                        <?php if (get_option('users_can_register')) { ?>
                            <span class="alignright"><?php wp_register('', ''); ?></span>
                        <?php } ?>
                    </p>
            	</div>
            </div>
        </div>
	<?php }	?>

	<?php wp_footer(); ?>
	<script>

    <?php if ($sliders == true) { ?>    
        
        <?php 
            $effect = cs_get_option( 'i_slider_effect' );  
            $effect_style = '';
            switch ($effect) {
                case "i_sliceDown":
                    $effect_style = 'sliceDown';
                    break;
                case "i_sliceDownLeft":
                    $effect_style = 'sliceDownLeft';
                    break;
                case "i_sliceUp":
                    $effect_style = 'sliceUp';
                    break;
                case "i_sliceUpLeft":
                    $effect_style = 'sliceUpLeft';
                    break;	
                case "i_sliceUpDown":
                    $effect_style = 'sliceUpDown';
                    break;
                case "i_sliceUpDownLeft":
                    $effect_style = 'sliceUpDownLeft';
                    break;
                case "i_fold":
                    $effect_style = 'i_fold';
                    break;
                case "i_fade":
                    $effect_style = 'fade';
                    break;	
                case "i_random":
                    $effect_style = 'random';
                    break;
                case "i_slideInRight":
                    $effect_style = 'slideInRight';
                    break;
                case "i_slideInLeft":
                    $effect_style = 'slideInLeft';
                    break;
                case "i_boxRandom":
                    $effect_style = 'boxRandom';
                    break;	  
                case "i_boxRain":
                    $effect_style = 'boxRain';
                    break;
                case "i_boxRainReverse":
                    $effect_style = 'boxRainReverse';
                    break;
                case "i_boxRainGrow":
                    $effect_style = 'boxRainGrow';
                    break;
                case "i_boxRainGrowReverse":
                    $effect_style = 'boxRainGrowReverse';
                    break;	                    
            } 
         ?>	
        
        jQuery(window).load(function() {
            jQuery('.nivoSlider').nivoSlider({
                effect: '<?php echo $effect_style; ?>', 
                boxCols: 10, 
                boxRows: 5,
                animSpeed: 300,
                prevText: '',
                nextText: '',      
                controlNav: false,
            });
        });
    <?php } ?>     	
        
        
	jQuery(document).ready(function($) {
	
	<?php if ( $snowfall == true && !is_mobile()  ) { ?>
		$(document).snowfall({flakeCount : 200});
	<?php }?>		

	<?php if ( $pagination == 'i_ajax' && is_home() || $pagination == 'i_ajax' && is_archive()) { ?>
		// ajax加载			
		var ias = $.ias({
			container: ".posts",
			item: ".post",
			pagination: ".post-nav-inside",
			next: ".post-nav-right a",
		});

		ias.extension(new IASTriggerExtension({
			textPrev: ' ',
			text: '<?php echo $loadmore ?>',
			offset: <?php echo $loadnum ?>,
		}));
		ias.extension(new IASNoneLeftExtension({
			text: '<?php echo $loadend ?>',
		}));
		ias.extension(new IASSpinnerExtension());
		ias.extension(new IASPagingExtension());
		ias.extension(new IASHistoryExtension({
			prev: '.post-nav-right a',
		}));

		ias.on('rendered', function(items) {
			echo.init({
				offset: 100,
				throttle: 250,
				unload: false,
			});

			if($(".audio-wrapper audio").length>0){
				$('.audio-wrapper audio').mediaelementplayer();
			}
			
		});	
	<?php } ?>		
	});
	</script>
	<?php if ( $circle == true && !is_mobile()  ) { ?>
		<canvas id="pixie"></canvas>
	<?php }?>		
	
</body>
</html>