<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCInsta_shortcode')) {

  	class OCInsta_shortcode {

    	protected static $instance;
    	function OCInsta_carousel_code($atts, $content = null) {
     
      		ob_start();
      

		    //get default setting
		    $ocinsta_access_tkn = get_option( 'ocinsta_access_tkn' );
		    if(empty($ocinsta_access_tkn)){
		        $ocinsta_access_tkn = "9276393864.1677ed0.e6d88f122aab448783eb25215e125c72";
		    }else{
		        $ocinsta_access_tkn = get_option( 'ocinsta_access_tkn' );
		    }


      		$ocinsta_post_limit = get_option( 'ocinsta_post_limit' );
      		if(empty($ocinsta_post_limit)){
        		$ocinsta_post_limit = "10";
      		}else{
        		$ocinsta_post_limit = get_option( 'ocinsta_post_limit' );
      		}


      		$ocinsta_space_img = get_option( 'ocinsta_space_img' );
      		if(empty($ocinsta_space_img)){
        		$ocinsta_space_img = "5";
      		}else{
        		$ocinsta_space_img = get_option( 'ocinsta_space_img' );
      		}

      
      		$ocinsta_option = get_option( 'ocinsta_option' );
      		if(empty($ocinsta_option)){
        		$ocinsta_option = "gallery";
      		}else{
        		$ocinsta_option = get_option( 'ocinsta_option' );
      		}

      		$ocinsta_gallery_templet = get_option( 'ocinsta_gallery_templet' );
      		if(empty($ocinsta_gallery_templet)){
        		$ocinsta_gallery_templet = "galtem1";
      		}else{
        		$ocinsta_gallery_templet = get_option( 'ocinsta_gallery_templet' );
      		}


	      	$ocinsta_gl_clm = get_option( 'ocinsta_gl_clm' );
	      	if(empty($ocinsta_gl_clm)){
	        	$ocinsta_gl_clm = "3";
	      	}else{
	      	  	$ocinsta_gl_clm = get_option( 'ocinsta_gl_clm' );
	      	}

	      	$ocinsta_ms_clm = get_option( 'ocinsta_ms_clm' );
	      	if(empty($ocinsta_ms_clm)){
	        	$ocinsta_ms_clm = "3";
	      	}else{
	      	  	$ocinsta_ms_clm = get_option( 'ocinsta_ms_clm' );
	      	}

	      	$ocinsta_ms_space = get_option( 'ocinsta_ms_space' );
	      	if(empty($ocinsta_ms_space)){
	        	$ocinsta_ms_space = "0";
	      	}else{
	      	  	$ocinsta_ms_space = get_option( 'ocinsta_ms_space' );
	      	}


      		$ocinsta_per_slide = get_option( 'ocinsta_per_slide' );
      		if(empty($ocinsta_per_slide)){
        		$ocinsta_per_slide = "3";
      		}else{
        		$ocinsta_per_slide = get_option( 'ocinsta_per_slide' );
      		}

      		$ocinsta_dis_time = get_option( 'ocinsta_dis_time' );
      		if(empty($ocinsta_dis_time)){
        		$ocinsta_dis_time = "yes";
      		}else{
        		$ocinsta_dis_time = get_option( 'ocinsta_dis_time' );
      		}


      		$ocinsta_dis_lik = get_option( 'ocinsta_dis_lik' );
      		if(empty($ocinsta_dis_lik)){
        		$ocinsta_dis_lik = "yes";
      		}else{
        		$ocinsta_dis_lik = get_option( 'ocinsta_dis_lik' );
      		}


      		$ocinsta_dis_cmt = get_option( 'ocinsta_dis_cmt' );
      		if(empty($ocinsta_dis_cmt)){
        		$ocinsta_dis_cmt = "yes";
      		}else{
        		$ocinsta_dis_cmt = get_option( 'ocinsta_dis_cmt' );
      		}

     		$ocinsta_dis_discri = get_option( 'ocinsta_dis_discri' );
      		if(empty($ocinsta_dis_discri)){
        		$ocinsta_dis_discri = "yes";
      		}else{
        		$ocinsta_dis_discri = get_option( 'ocinsta_dis_discri' );
      		}

      		
      		

      		function rudr_instagram_api_curl_connect( $api_url ){
        		$connection_c = curl_init();
        		curl_setopt( $connection_c, CURLOPT_URL, $api_url );
        		curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 );
        		curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
        		$json_return = curl_exec( $connection_c );
        		curl_close( $connection_c );
        		return json_decode( $json_return );
      		}


      		$url = rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/self/media/recent/?access_token=".$ocinsta_access_tkn);
      		$count = 0;

      		?>

      		<div class="oc_insta_class">
	      		<div class="instagram_main_class <?php echo $ocinsta_gallery_templet; ?>">
	        		<?php
				        if ($ocinsta_option == "gallery") {
				        	?>
		          			<div class="insta_gallery">
					            <ul>
					              	<?php
						               	$width = 100 / $ocinsta_gl_clm;
						                foreach ($url->data as $key => $value) {
						                	// echo "<pre>";
						                	// print_r($value);
						                	// echo "</pre>";
						                	
						                  	if($count < $ocinsta_post_limit){
						                    	$count++;
						                    	$fulldate    = date('Y-m-d h:i:s', $value->created_time);
						                    	$date  = date('d', $value->created_time);
						                    	$month = date('F', $value->created_time);
						                    	$year  = date('Y', $value->created_time);
						                    	
						                    	$current = strtotime(date("Y-m-d"));
 												$dates    = strtotime(date('Y-m-d', $value->created_time));
 												$datediff = $dates - $current;
												$difference = floor($datediff/(60*60*24));
						                    	?>
						                    	<li style="width: <?php echo $width;?>%;padding:0px <?php echo $ocinsta_space_img; ?>px;" class="insta_gallery_li">
						                      		<div class="insta_li_div">
						                      			<div class="slide_img">
							                        		<img src="<?php echo $value->images->standard_resolution->url ?>" class="insta_img">
							                        	</div>
							                        	<div class="like_comment_div hover_data">

							                        		<div class="inner_comment_like_div">
							                        			<?php if($ocinsta_dis_time == "yes"){ ?>
								                        			<div class="ocinsta_time">
									                        			<?php 
										                        			if (date('Y') == date('Y', $value->created_time)) {
										                        				if(date("W") == date("W", $value->created_time)){
																				    if($difference == 0) {
																				    	echo $this->time_elapsed_string($fulldate);
																					}else{
																						echo $this->time_elapsed_string($fulldate);
																					}
																				}else{
																					echo $month." ".$date; 
																				}
										                        			}else{
										                        				echo $month." ".$date.", ".$year;
										                        			}
									                        			?>
									                        		</div>
								                        		<?php } ?>
									                        	<?php if($ocinsta_dis_lik == "yes"){ ?>
									                            	<div class="ocinsta_like">
									                              		<a href="<?php echo $value->link ?>" target="_blank">
									                              			<?php if($ocinsta_gallery_templet == "galtem4") { ?>
									                              				<img src="<?php echo OCINSTA_PLUGIN_DIR ?>/includes/images/heart_black.png">
									                              			<?php }else{ ?>
									                              				<img src="<?php echo OCINSTA_PLUGIN_DIR ?>/includes/images/heart.png">
									                              			<?php } ?>
									                              			<span><?php echo $value->likes->count; ?></span>
									                              		</a>
									                            	</div>
									                        	<?php } ?>
									                        	<?php if($ocinsta_dis_cmt == "yes"){ ?>
										                            <div class="ocinsta_comment">
										                              	<a href="<?php echo $value->link ?>" target="_blank">
										                              		<?php if($ocinsta_gallery_templet == "galtem4") { ?>
									                              				<img src="<?php echo OCINSTA_PLUGIN_DIR ?>/includes/images/comment_black.png">
									                              			<?php }else{ ?>
									                              				<img src="<?php echo OCINSTA_PLUGIN_DIR ?>/includes/images/comment.png">
									                              			<?php } ?>
										                              		
										                              		<span><?php echo $value->comments->count; ?></span>
										                              	</a>
										                            </div> 
										                        <?php } ?>
										                        <?php if($ocinsta_dis_discri == "yes"){ ?>
											                        <div class="insta_discription">
											                        	<?php 
																			echo mb_strimwidth($value->caption->text, 0, 40, "..."); 
											                        	?>
								                        			</div>
							                        			<?php } ?>
							                        			
									                    	</div> 
									                    	
							                        	</div>
						                      		</div>
						                    	</li>
						                    	<?php
						                  	} 
						                }
					              	?>
					            </ul>
		          			</div>
		        			<?php
		        		}
		        		if ($ocinsta_option == "carousel") {
		        			?>
							<div class="insta_slide owl-carousel owl-theme">
					            <?php
					              	foreach ($url->data as $key => $value) {
					                    $username = $value->user->username;
					                  	if($count < $ocinsta_post_limit) {
					                    	$count++;
					                    	$fulldate    = date('Y-m-d h:i:s', $value->created_time);
					                    	$date  = date('d', $value->created_time);
					                    	$month = date('F', $value->created_time);
					                    	$year  = date('Y', $value->created_time);
					                    	
					                    	$current = strtotime(date("Y-m-d"));
												$dates    = strtotime(date('Y-m-d', $value->created_time));
												$datediff = $dates - $current;
											$difference = floor($datediff/(60*60*24));
					                    	?>
					                    	<div class="slide_main_div">
					                    		<div class="slide_img">
					                      			<img src="<?php echo $value->images->standard_resolution->url ?>" class="insta_img">
					                      		</div>
					                      		<div class="like_comment_div hover_data">
					                      			<div class="inner_comment_like_div">
					                      				<?php if($ocinsta_dis_time == "yes"){ ?>
						                        			<div class="ocinsta_time">
							                        			<?php 
								                        			if (date('Y') == date('Y', $value->created_time)) {
								                        				if(date("W") == date("W", $value->created_time)){
																		    if($difference == 0) {
																		    	echo $this->time_elapsed_string($fulldate);
																			}else{
																				echo $this->time_elapsed_string($fulldate);
																			}
																		}else{
																			echo $month." ".$date; 
																		}
								                        			}else{
								                        				echo $month." ".$date.", ".$year;
								                        			}
							                        			?>
							                        		</div>
								                        <?php } ?>
					                        			<?php if($ocinsta_dis_lik == "yes"){ ?>
					                          				<div class="ocinsta_like">
					                            				<a href="<?php echo $value->link ?>" target="_blank">
					                            					<?php if($ocinsta_gallery_templet == "galtem4") { ?>
							                              				<img src="<?php echo OCINSTA_PLUGIN_DIR ?>/includes/images/heart_black.png">
							                              			<?php }else{ ?>
							                              				<img src="<?php echo OCINSTA_PLUGIN_DIR ?>/includes/images/heart.png">
							                              			<?php } ?>
					                            					<span><?php echo $value->likes->count; ?></span>
					                            				</a>
								                          	</div>
								                        <?php } ?>
								                        <?php if($ocinsta_dis_cmt == "yes"){ ?>
								                          	<div class="ocinsta_comment">
								                            	<a href="<?php echo $value->link ?>" target="_blank">
								                            		<?php if($ocinsta_gallery_templet == "galtem4") { ?>
							                              				<img src="<?php echo OCINSTA_PLUGIN_DIR ?>/includes/images/comment_black.png">
							                              			<?php }else{ ?>
							                              				<img src="<?php echo OCINSTA_PLUGIN_DIR ?>/includes/images/comment.png">
							                              			<?php } ?>
									                            	<span><?php echo $value->comments->count; ?></span>
									                            </a>
								                          	</div> 
								                        <?php } ?> 
								                        <?php if($ocinsta_dis_discri == "yes"){ ?>
									                        <div class="insta_discription">
						                        				<?php echo mb_strimwidth($value->caption->text, 0, 40, "...");
						                        				?>
						                        			</div>
						                        		<?php } ?> 
						                        		
					                        		</div> 
					                        		
						         				</div>
					                    	</div>
					                   		<?php
					                  	} 
					                }
					            ?>
					        </div>     
		      
		      
					        <!--  Slider Settings -->
					        <script type="text/javascript">
					            jQuery(document).ready(function(){
					                jQuery('.insta_slide').owlCarousel({
					                    loop:true,
					                    nav:true,
					                    dots: true,
					                    margin:<?php if(get_option( 'ocinsta_gallery_templet' ) == "galtem2"){ echo "0"; }else{ echo get_option( 'ocinsta_space_img' ); } ?>,
					                    autoplay: <?php echo  get_option( 'ocinsta_autoplay' ); ?>,
					                    autoplayTimeout: <?php echo  get_option( 'ocinsta_autoplay_inter' ); ?>,
					                    responsive:{
					                        0:{
					                            items:<?php echo  get_option('ocinsta_per_slide_mobile');?>,
					                        },
					                        600:{
					                            items:<?php echo  get_option('ocinsta_per_slide');?>,
					                        },
					                        1000:{
					                            items:<?php echo  get_option('ocinsta_per_slide');?>,
					                        }
					                    }
					                });
					              
					                var ocinsta_main_class = jQuery(".insta_slide"); 
					                var ocinsta_nav_arrow = <?php echo get_option( 'ocinsta_nav_arrow' ); ?>;
					                if(ocinsta_nav_arrow == true) {
					                  
					                    ocinsta_main_class.find('.owl-nav').removeClass('disabled');
					                    ocinsta_main_class.on('changed.owl.carousel', function(event) {
					                          ocinsta_main_class.find('.owl-nav').removeClass('disabled');
					                    });
					                }
					                if(ocinsta_nav_arrow == false) {
					                  
					                    ocinsta_main_class.find('.owl-nav').addClass('disabled');
					                    ocinsta_main_class.on('changed.owl.carousel', function(event) {
					                                ocinsta_main_class.find('.owl-nav').addClass('disabled');
					                    });
					                }
								}); 
					        </script>
		        			<?php 
		        		} 
	        		?>
	      		</div> 

	      		
      		</div>
			<script type="text/javascript">
		        jQuery(document).ready(function(){
		          	var btn = "<?php if(empty(get_option( 'ocinsta_btn' ))){ echo "yes"; }else{ echo get_option( 'ocinsta_btn' ); } ?>";
		            var user_nm = "<?php if(empty($username)){ echo "ocean.vaishali"; }else{ echo $username; }  ?>";
                  	if(btn == "yes"){
                    	btn_txt = "<?php if(empty(get_option( 'ocinsta_btn_txt' ))){ echo "View On Instagram"; }else{ echo get_option( 'ocinsta_btn_txt' ); } ?>";
                    	btn_bg_color = "<?php if(empty(get_option( 'ocinsta_btn_bg_clr' ))){ echo "#116cf4"; }else{ echo get_option( 'ocinsta_btn_bg_clr' ); } ?>";
                    	btn_txt_clr = "<?php if(empty(get_option( 'ocinsta_btn_txt_clr' ))){ echo "#ffffff"; }else{ echo get_option( 'ocinsta_btn_txt_clr' ); } ?>";
                    	jQuery(".oc_insta_class").append("<div class='insta_btn_div'><a class='insta_btn' style='background-color:"+btn_bg_color+"; color:"+btn_txt_clr+"' href='https://www.instagram.com/"+user_nm+"' target='_blank'>"+btn_txt+"</a></div>");
                  	}



		        });
      		</script> 

      		<?php
      		return $var = ob_get_clean();

    	}

    	function time_elapsed_string($datetime, $full = false) {
		    $now = new DateTime;
		    $ago = new DateTime($datetime);
		    $diff = $now->diff($ago);

		    $diff->w = floor($diff->d / 7);
		    $diff->d -= $diff->w * 7;

		    $string = array(
		        'y' => 'year',
		        'm' => 'month',
		        'w' => 'week',
		        'd' => 'day',
		        'h' => 'hour',
		        'i' => 'minute',
		        's' => 'second',
		    );
		    foreach ($string as $k => &$v) {
		        if ($diff->$k) {
		            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		        } else {
		            unset($string[$k]);
		        }
		    }

		    if (!$full) $string = array_slice($string, 0, 1);
		    return $string ? implode(', ', $string) . ' ago' : 'just now';
		}

	    function init() {
	      add_shortcode( 'ocinsta-carousel', array($this,'OCInsta_carousel_code'));
	    }

	    public static function instance() {
		    if (!isset(self::$instance)) {
		        self::$instance = new self();
		        self::$instance->init();
		    }
	      	return self::$instance;
	    }

  	}

  	OCInsta_shortcode::instance();
}

