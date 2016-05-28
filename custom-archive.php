<?php 
/* 
Template Name: 归档页面
*/ 
$meta_data = get_post_meta( get_the_ID(), 'archive_page', true );
$featured = $meta_data['i_page_image'];
?>

<?php get_header(); ?>

		<!-- 归档页面 -->
		<div id="content">
			<div class="posts fade out">	
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article <?php post_class('post'); ?>>			
					<div class="box-wrap">
						<div class="box">
							 <?php if (!empty($featured)) { ?>		
									<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured; ?>" class="attachment-large-image wp-post-image ajax_gif"></a>
							 <?php } else { ?>
								<?php if ( has_post_thumbnail()) { ?>
									<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
								<?php } ?>
							<?php } ?>			
							<div class="post-content">
								<header>
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									<ul class="top_meta"></ul>
								</header>
								<div class="content">
									<?php the_content(__( 'Read More','island')); ?>
									<div id="archives">      
										<div id="archives-content">      
										<?php       
											$the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' );      
											$year=0; $mon=0; $i=0; $j=0;      
											$all = array();      
											$output = '';      
											while ( $the_query->have_posts() ) : $the_query->the_post();      
												$year_tmp = get_the_time('Y');      
												$mon_tmp = get_the_time('n');      
												$y=$year; $m=$mon;      
												if ($mon != $mon_tmp && $mon > 0) $output .= '</div></div>';      
												if ($year != $year_tmp) { // 输出年份      
													$year = $year_tmp;      
													$all[$year] = array();      
												}      
												if ($mon != $mon_tmp) { // 输出月份      
													$mon = $mon_tmp;      
													array_push($all[$year], $mon);      
													$output .= "<div class='archive_title' id='arti-$year-$mon'><h3>$year-$mon</h3><div class='archives archives-$mon' data-date='$year-$mon'>";      
												}      
												$output .= '<div class="brick"><a href="'.get_permalink() .'"><span class="time">'.get_the_time('n-d').'</span>'.get_the_title() .'<em>('. get_comments_number('0', '1', '%') .')</em></a></div>';      
											endwhile;      
											wp_reset_postdata();      
											$output .= '</div></div>';      
											echo $output;      
										 
											$html = "";      
											$year_now = date("Y");      
											foreach($all as $key => $value){// 输出 左侧年份表      
												$html .= "<li class='year' id='year-$key'><a href='#' class='year-toogle' id='yeto-$key'>$key</a><ul class='monthall'>";      
												for($i=12; $i>0; $i--){      
													if($key == $year_now && $i > $value[0]) continue;      
													$html .= in_array($i, $value) ? ("<li class='month monthed' id='mont-$key-$i'>$i</li>") : ("<li class='month'>$i</li>");      
												}      
												$html .= "</ul></li>";   
											}      
										?>     
										</div>   
										<?php if (!is_mobile()) { ?>
											<div id="archive-nav" class="fade out">      
												<ul class="archive-nav"><?php echo $html;?></ul>      
											</div>  
										<?php }?>	
									</div><!-- #archives -->  										
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>	
				</article>	
				<?php endwhile; ?>
				<?php endif; ?>
		   </div>
		</div>
		<?php if (!is_mobile()) { ?>
		<script>
			jQuery(document).ready(function($) {  
				$(".content #archive-nav").hide();	  
				var old_top = $("#archives").offset().top,   
					_year = parseInt($(".year:first").attr("id").replace("year-", ""));   
				$(".year:first, .year .month:first").addClass("selected");   
				$(".month.monthed").click(function() {   
					var _this = $(this),   
						_id = "#" + _this.attr("id").replace("mont", "arti");   
					if (!_this.hasClass("selected")) {   
						var _stop = $(_id).offset().top - 10,   
							_selected = $(".month.monthed.selected");   
						_selected.removeClass("selected");   
						_this.addClass("selected");   
						$("body, html").scrollTop(_stop)   
					}   
				});   
				$(".year-toogle").click(function(e) {   
					e.preventDefault();   
					var _this = $(this),   
						_thisp = _this.parent();   
					if (!_thisp.hasClass("selected")) {   
						var _selected = $(".year.selected"),   
							_month = _thisp.children("ul").children("li").eq(0);   
						_selected.removeClass("selected");   
						_thisp.addClass("selected");   
						_month.click()   
					}   
				});   
				$(window).scroll(function() {   
					var _this = $(this),   
						_top = _this.scrollTop();     
					$(".archive_title").each(function() {   
						var _this = $(this),   
							_ooid = _this.attr("id"),   
							_newyear = parseInt(_ooid.replace(/arti-(\d*)-\d*/, "$1")),   
							_offtop = _this.offset().top - 40,   
							_oph = _offtop + _this.height();   
						if (_top >= _offtop && _top < _oph) {   
							if (_newyear != _year) {   
								$("#year-" + _year).removeClass("selected");   
								$("#year-" + _newyear).addClass("selected");   
								_year = _newyear   
							}   
							var _id = _id = "#" + _ooid.replace("arti", "mont"),   
								_selected = $(".month.monthed.selected");   
							_selected.removeClass("selected");   
							$(_id).addClass("selected")   
						}   
					})   
				})   
			}); 
		</script>
		<?php }?>	
		<?php get_footer(); ?>