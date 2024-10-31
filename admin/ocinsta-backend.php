<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCInsta_menu')) {

    class OCInsta_menu {

        protected static $instance;
        function add_menu() {
            add_submenu_page( 'options-general.php', __('Instagram Slider', 'ocinsta'), esc_html__('Instagram Slider', 'ocinsta'), 'manage_options', OCINSTA_DOMAIN, array($this, 'settings_instagram')); 
        }

        function settings_instagram() {
            ?>
            <div class="ocinsta_container">
                <h2>Instagram Setting</h2>
                <P>Copy this shortcode and paste in which page you want to display instagram gallery/Slider</P>
                <div class="ocinsta_shortcode">
                    <span><?php echo __( 'Shortcode:', OCINSTA_DOMAIN );?></span><input type="text" id="ocinsta-selectdata" value="[ocinsta-carousel]" size="30" onclick="ocinsta_select_data()" readonly>
                </div>
                <form method="post" >
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="tab-default">
                            <?php echo __( 'Default Settings', OCINSTA_DOMAIN );?>
                        </li>
                        <li class="tab-link" data-tab="tab-general">
                            <?php echo __( 'Filter Settings', OCINSTA_DOMAIN );?>
                        </li>
                    </ul>
                    <div id="tab-default" class="tab-content current">
                        <?php wp_nonce_field( 'insta_nonce_action', 'insta_nonce_field' ); ?>
                        
                        <h3>Get Access Token</h3>
                        <p>Get Your Access Token <a href="https://instagram.pixelunion.net/" target="_blank">here!!!</a> </p>
                        <table>
                            <tr>
                                <td><h3>Genral Setting</h3></td>
                            </tr>
                            <tr>
                                <td>Access Token</td>
                                <td>
                                    <input type="text" name="insta_ac_tkn" value="<?php if(!empty(get_option( 'ocinsta_access_tkn' ))){ echo get_option( 'ocinsta_access_tkn' ); }else{ echo "9276393864.1677ed0.e6d88f122aab448783eb25215e125c72"; }?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Limit</td>
                                <td>
                                    <input type="number" name="insta_post_limit" value="<?php if(!empty(get_option( 'ocinsta_post_limit' ))){ echo get_option( 'ocinsta_post_limit' ); }else{ echo "10"; }?>">
                                </td>
                            </tr>
                            <tr>
                                <td><h3>Likes & Comment Setting</h3></td>
                            </tr>
                            <tr>
                                <td>Display likes</td>
                                <td>
                                    <input type="checkbox" name="insta_dis_lik" value="yes" <?php if(get_option( 'ocinsta_dis_lik' ) == "yes" || empty(get_option( 'ocinsta_dis_lik' ))){ echo "checked"; }?>>
                                </td>
                            </tr> 
                            <tr>
                                <td>Display Comment</td>
                                <td>
                                    <input type="checkbox" name="insta_dis_cmt" value="yes" <?php if(get_option( 'ocinsta_dis_cmt' ) == "yes" || empty(get_option( 'ocinsta_dis_cmt' ))){ echo "checked"; }?>>
                                </td>
                            </tr> 
                            <tr>
                                <td>Display Description</td>
                                <td>
                                    <input type="checkbox" name="insta_dis_discri" value="yes" <?php if(get_option( 'ocinsta_dis_discri' ) == "yes" || empty(get_option( 'ocinsta_dis_discri' ))){ echo "checked"; }?>>
                                </td>
                            </tr>
                            <tr>
                                <td>Display Time</td>
                                <td>
                                    <input type="checkbox" name="insta_dis_time" value="yes" <?php if(get_option( 'ocinsta_dis_time' ) == "yes" || empty(get_option( 'ocinsta_dis_time' ))){ echo "checked"; } ?>>
                                </td>
                            </tr>  
                            <tr>
                                <td><h3>Instagram Button</h3></td>
                            </tr>
                            <tr>
                                <td>Instagram Button</td>
                                <td>
                                    <input type="checkbox" name="insta_btn" value="yes" <?php if(get_option( 'ocinsta_btn' ) == "yes" || empty(get_option( 'ocinsta_btn' ))){ echo "checked"; }?>>
                                </td>
                            </tr> 
                            <tr>
                                <td>Instagram button text</td>
                                <td>
                                    <input type="text" name="insta_btn_txt" value="<?php if(!empty(get_option( 'ocinsta_btn_txt' ))){ echo get_option( 'ocinsta_btn_txt' ); }else{ echo "View On Instagram"; }?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Instagram button background</td>
                                <td>
                                    <input type="color" name="insta_btn_bg_clr" value="<?php if(!empty(get_option( 'ocinsta_btn_bg_clr' ))){ echo get_option( 'ocinsta_btn_bg_clr' ); }else{ echo "#116cf4"; }?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Instagram text color</td>
                                <td>
                                    <input type="color" name="insta_btn_txt_clr" value="<?php if(!empty(get_option( 'ocinsta_btn_txt_clr' ))){ echo get_option( 'ocinsta_btn_txt_clr' ); }else{ echo "#ffffff"; }?>">
                                </td>
                            </tr>
                            <tr>
                                <td><h3>Sharing Button</h3></td>
                            </tr>
                            <tr>
                                <td>Display Share button</td>
                                <td>
                                    <div class="insta_getpro">
                                        <input type="checkbox" name="insta_dis_share" value="yes">
                                    </div>
                                    <a href="https://www.xeeshop.com/product/social-feed-slider/" target="_blank" class="instaget_pro">Get Pro</a>
                                </td>
                            </tr>  
                        </table>   
                    </div>
                    <div id="tab-general" class="tab-content">
                        <table>
                            <tr>
                                <td><h3>Template Setting</h3></td>
                            </tr>
                            <tr>
                                <td>Select Template</td>
                                <td>
                                    <input type="radio" name="galtem" value="galtem1" <?php if(get_option('ocinsta_gallery_templet') == "galtem1"){ echo "checked"; } ?>>Template 1
                                    <input type="radio" name="galtem" value="galtem2" <?php if(get_option('ocinsta_gallery_templet') == "galtem2"){ echo "checked"; } ?>>Template 2
                                    <div class="insta_getpro">
                                        <input type="radio" name="galtem" value="galtem3">Template 3
                                        <input type="radio" name="galtem" value="galtem4">Template 4
                                    </div>
                                    <a href="https://www.xeeshop.com/product/social-feed-slider/" target="_blank" class="instaget_pro">Get Pro</a>
                                </td>
                            </tr>
                        </table> 
                        <table class="insta_display_option">
                            <tr>
                                <td><h3>Instagram Option</h3></td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="radio">
                                        <input type="radio" name="insta_option" id="radiogallery" value="gallery" class="insta_option with-gap" <?php if(get_option( 'ocinsta_option' ) == "gallery" || empty(get_option( 'ocinsta_option' ))) { echo 'checked'; } ?>>
                                        <span>Gallery</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="insta_option" id="radioslider" value="carousel" class="insta_option" <?php if(get_option( 'ocinsta_option' ) == "carousel" ) { echo 'checked'; } ?>>
                                        <span>Carousel</span>
                                    </label>
                                    <div class="insta_getpro">
                                        <label class="radio">        
                                            <input type="radio" name="insta_option" id="radiomasonry" value="masonry" class="insta_option" <?php if(get_option( 'ocinsta_option' ) == "masonry" ) { echo 'checked'; } ?>>
                                            <span>Masonry</span>
                                        </label>
                                    </div>
                                    <a href="https://www.xeeshop.com/product/social-feed-slider/" target="_blank" class="instaget_pro">Get Pro</a>
                                </td>
                            </tr>
                        </table>
                  
                        <div class="gallery">
                            <table>
                                <tr>
                                    <td><h3>Gallery Setting</h3></td>
                                </tr>
                                <tr class="columns"> 
                                    <td>Columns</td>
                                    <td>
                                        <input type="number" name="insta_gl_clm" value="<?php if(!empty(get_option( 'ocinsta_gl_clm' ))){ echo get_option( 'ocinsta_gl_clm' ); }else{ echo "3"; }?>">
                                    </td>
                                </tr>
                                
                                <tr class="space_betwwen" style="display: <?php if(get_option( 'ocinsta_gallery_templet' ) == "galtem2"){ echo "none"; }else{ echo "table-row"; } ?>">
                                    <td>Space between images</td>  
                                    <td>
                                        <input type="number" name="insta_space_img" class="insta_space_img" value="<?php if(!empty(get_option( 'ocinsta_space_img' ))){ echo get_option( 'ocinsta_space_img' ); }else{ echo "5"; }?>">
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                        <div class="carousel" style="display: none;">
                            <table>
                                <tr>
                                    <td><h3>Carousel Setting</h3></td>
                                </tr>
                                <tr> 
                                    <td>Slides per row</td>
                                    <td>
                                        <input type="number" name="insta_per_slide" value="<?php if(!empty(get_option( 'ocinsta_per_slide' ))){ echo get_option( 'ocinsta_per_slide' ); }else{ echo "3"; }?>">
                                    </td>
                                </tr>
                                <tr> 
                                    <td>Slides per row(Mobile)</td>
                                    <td>
                                        <input type="number" name="insta_per_slide_mobile" value="<?php if(!empty(get_option( 'ocinsta_per_slide_mobile' ))){ echo get_option( 'ocinsta_per_slide_mobile' ); }else{ echo "2"; }?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Autoplay</td>  
                                    <td>
                                        <input type="checkbox" name="insta_autoplay" value="true" <?php if(get_option( 'ocinsta_autoplay' ) == "true" || empty(get_option( 'ocinsta_autoplay' ))){ echo "checked"; }?>>
                                    </td>
                                </tr>
                                <tr>  
                                    <td>Autoplay Interval</td>
                                    <td>
                                        <input type="number" name="insta_autoplay_inter" value="<?php if(!empty(get_option( 'ocinsta_autoplay_inter' ))){ echo get_option( 'ocinsta_autoplay_inter' ); }else{ echo "1000"; }?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Navigation arrows</td>
                                    <td>
                                        <input type="checkbox" name="insta_nav_arrow" value="true" <?php if(get_option( 'ocinsta_nav_arrow' ) == "true" || empty(get_option( 'ocinsta_nav_arrow' ))){ echo "checked"; }?>>
                                    </td>
                                </tr> 
                            </table>
                        </div>
                        <div class="masonry">
                            <table>
                                <tr>
                                    <td><h3>Masonry Setting</h3></td>
                                </tr>
                                
                                <tr> 
                                    <td>Columns</td>
                                    <td>
                                        <input type="number" name="ocinsta_ms_clm" value="<?php if(!empty(get_option( 'ocinsta_ms_clm' ))){ echo get_option( 'ocinsta_ms_clm' ); }else{ echo "3"; }?>">
                                    </td>
                                </tr>
                                
                                <tr class="space_betwwen"  style="display: <?php if(get_option( 'ocinsta_gallery_templet' ) == "galtem2"){ echo "none"; }else{ echo "table-row"; } ?>"> 
                                    <td>Space Between Column</td>
                                    <td>
                                        <input type="number" name="ocinsta_ms_space" value="<?php if(!empty(get_option( 'ocinsta_ms_space' ))){ echo get_option( 'ocinsta_ms_space' ); }else{ echo "0"; }?>">
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                             
                    </div>
                    <input type="submit" name="insta_save" value="Update">
                </form>
            </div>
            <?php
        }

        function add_data(){
            if( current_user_can('administrator') ) { 
                if(isset($_REQUEST['insta_save'])){
                    if(!isset( $_POST['insta_nonce_field'] ) || !wp_verify_nonce( $_POST['insta_nonce_field'], 'insta_nonce_action' ) ){
                        print 'Sorry, your nonce did not verify.';
                        exit;
                    }else{
                        update_option('ocinsta_access_tkn', sanitize_text_field( $_REQUEST['insta_ac_tkn'] ), 'yes');
                        update_option('ocinsta_post_limit', sanitize_text_field( $_REQUEST['insta_post_limit'] ), 'yes');
                        update_option('ocinsta_space_img', sanitize_text_field( $_REQUEST['insta_space_img'] ), 'yes');

                
                
                        update_option('ocinsta_option', sanitize_text_field( $_REQUEST['insta_option'] ), 'yes');
                        update_option('ocinsta_gallery_templet', sanitize_text_field( $_REQUEST['galtem'] ), 'yes');
                        update_option('ocinsta_gl_clm', sanitize_text_field( $_REQUEST['insta_gl_clm'] ), 'yes');
                        update_option('ocinsta_ms_clm', sanitize_text_field( $_REQUEST['ocinsta_ms_clm'] ), 'yes');
                        update_option('ocinsta_ms_space', sanitize_text_field( $_REQUEST['ocinsta_ms_space'] ), 'yes');
                        update_option('ocinsta_per_slide', sanitize_text_field( $_REQUEST['insta_per_slide'] ), 'yes');
                        update_option('ocinsta_per_slide_mobile', sanitize_text_field( $_REQUEST['insta_per_slide_mobile'] ), 'yes');


                        if(empty(sanitize_text_field( $_REQUEST['insta_autoplay']))){
                            $autoplay = "false";
                        }else{
                            $autoplay = sanitize_text_field( $_REQUEST['insta_autoplay'] );
                        }

                        update_option('ocinsta_autoplay', $autoplay, 'yes');
                        update_option('ocinsta_autoplay_inter', sanitize_text_field( $_REQUEST['insta_autoplay_inter'] ), 'yes');

                        if(empty(sanitize_text_field( $_REQUEST['insta_nav_arrow']))){
                          $nav = "false";
                        }else{
                          $nav = sanitize_text_field( $_REQUEST['insta_nav_arrow'] );
                        }
                        update_option('ocinsta_nav_arrow', $nav, 'yes');
                
                
                        if(empty(sanitize_text_field( $_REQUEST['insta_dis_lik']))){
                          $like = "no";
                        }else{
                          $like = $_REQUEST['insta_dis_lik'];
                        }
                        update_option('ocinsta_dis_lik', $like, 'yes');
                
                        if(empty(sanitize_text_field( $_REQUEST['insta_dis_cmt']))){
                          $comment = "no";
                        }else{
                          $comment = $_REQUEST['insta_dis_cmt'];
                        }
                        update_option('ocinsta_dis_cmt', $comment, 'yes');


                        if(empty(sanitize_text_field( $_REQUEST['insta_dis_discri']))){
                          $description = "no";
                        }else{
                          $description = $_REQUEST['insta_dis_discri'];
                        }
                        update_option('ocinsta_dis_discri', $description, 'yes');



                        if(empty(sanitize_text_field( $_REQUEST['insta_dis_time']))){
                            $time = "no";
                        }else{
                            $time = $_REQUEST['insta_dis_time'];
                        }
                        update_option('ocinsta_dis_time', $time, 'yes');


                    
                        if(empty(sanitize_text_field( $_REQUEST['insta_btn']))){
                          $btn = "no";
                        }else{
                          $btn = $_REQUEST['insta_btn'];
                        }
                        update_option('ocinsta_btn', $btn, 'yes');
                        update_option('ocinsta_btn_txt', sanitize_text_field( $_REQUEST['insta_btn_txt'] ), 'yes');
                        update_option('ocinsta_btn_bg_clr', sanitize_text_field( $_REQUEST['insta_btn_bg_clr'] ), 'yes');
                        update_option('ocinsta_btn_txt_clr', sanitize_text_field( $_REQUEST['insta_btn_txt_clr'] ), 'yes');
                    }
                }
            }
        }

        function init() {
            add_action('admin_menu', array($this, 'add_menu'));
            add_action('init', array($this, 'add_data'));
        }

        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
            }
            return self::$instance;
        }
    }
    OCInsta_menu::instance();
}


// Register and load the widget
function wpb_load_widget() {
    register_widget( 'ocinsta' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
// Creating the widget 
class ocinsta extends WP_Widget {
 
    function __construct() {
        parent::__construct(
     
        // Base ID of your widget
        'ocinsta', 
     
        // Widget name will appear in UI
        __('Instagram Slider', 'ocinsta_domain'), 
     
        // Widget description
        array( 'description' => __( 'Widget area for instagram slider', 'ocinsta' ), ) 
        );
    }
 
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
     
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
     
        // This is where you run the code and display the output
        echo do_shortcode( '[ocinsta-carousel]' );
        echo $args['after_widget'];
    }
             
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = __( 'Instagram Slider', 'ocinsta' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php 
    }
         
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here