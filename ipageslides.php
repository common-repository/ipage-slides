<?php
/*
  Plugin Name: IPage Slides
  Plugin URI: http://www.innovativephp.com/ipage-slides
  Description: Innovative Page Slides.
  Version: 1.1
  Author: Rakhitha Nimesh
  Author URI: http://www.innovativephp.com/about
 */

function ipslides_plugin_scripts() {

    $plugin_dir = WP_PLUGIN_URL . "/";

    wp_register_script('jquery_plugins', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
    wp_register_script('ipage_slides_js', $plugin_dir."iblocks/js/innovative-pslides-switch.js");            

    wp_enqueue_script('jquery_plugins');
    wp_enqueue_script('ipage_slides_js');

}    
 
add_action('wp_enqueue_scripts', 'ipslides_plugin_scripts');



function ipslides_page_slider_common($atts, $content, $data) {

    $plugin_dir = WP_PLUGIN_URL . "/";

    //default settings
    $data['text_size'] = isset($atts['text_size']) ? $atts['text_size'] : '16';
    $data['text_color'] = isset($atts['text_color']) ? $atts['text_color'] : 'white';
    $data['border_size'] = isset($atts['border_size']) ? $atts['border_size'] : '15';
    $data['border_color'] = isset($atts['border_color']) ? $atts['border_color'] : '#eee';
    $data['slide_speed'] = isset($atts['slide_speed']) ? $atts['slide_speed'] : '5';
    $data['button_status'] = isset($atts['button_status']) ? $atts['button_status'] : 'yes';
    


    $con_block = explode("@item:", $content);
    array_shift($con_block);
    $content = json_encode($con_block);

    $ht .= '<style type="text/css">
                    #single-page-slider-nav input[type="button"] {
                        background-color: #FFFFFF;
                        border: 1px solid #CFCFCF;
                        display: block;
                        float: right;
                        margin-right: 16px;
                        padding: 3px;
                        width: 70px;
                    }
                    #single-page-slider-nav {
                        display: block;
                        float: right;
                        padding: 10px 0;
                        width: 100%;height:30px;
                    }
                    #single-page-slider-nav img{
                        padding:0 10px;
                    }
                </style>';


    switch ($data['class']) {
        case 'slide_switcher_small':
            $data['image'] = isset($atts['image']) ? $atts['image'] : $plugin_dir . 'ipage-slides/images/slide-switch-' . $data['color'] . '-half.png';
            $ht .= '<style type="text/css">
                                    .slide_container_small{

                                        border: ' . $data['border_size'] . 'px  solid ' . $data['border_color'] . ';
                                        margin-bottom: 20px;
                                        outline: 1px solid #CFCFCF;
                                        overflow: hidden;
                                        height:215px
                                    }
                                </style>';
            $data['class'] = "slide_container_small";
            break;

        case 'slide_switcher_medium':
            $data['image'] = isset($atts['image']) ? $atts['image'] : $plugin_dir . 'ipage-slides/images/slide-switch-' . $data['color'] . '.png';
            $ht .= '<style type="text/css">
                                    .slide_container_medium{
                                        
                                        border: ' . $data['border_size'] . 'px  solid ' . $data['border_color'] . ';
                                        margin-bottom: 20px;
                                        outline: 1px solid #CFCFCF;
                                        overflow: hidden;
                                        height:445px
                                    }
                                </style>';
            $data['class'] = "slide_container_medium";
            break;
    }

    $containerStyle = "text-align:center;padding:30px 5% 10px;height:" . $data['height'] . "px;color:" . $data['text_color'] . ";font-size:" . $data['text_size'] . "px;font-weight:bold;";
    $ht .= '<script type="text/javascript">
			$(document).ready(function() {

				var content = ' . $content . ';
				$.page_slide_switch.init({
					content:content,
					path:"' . $plugin_dir . 'ipage-slides",
                                        container:"' . $data['container'] . '",
                                        slideSpeed      : "' . ($data['slide_speed'] * 1000) . '",
                                        buttonStatus    : "' . $data['button_status'] . '",
					containerStyle : "' . $containerStyle . '",
				});
			});
		</script><div id="' . $data['container'] . '" class="' . $data['class'] . '" style="background: url('.$data['image'].') repeat scroll 0 0 transparent;">&nbsp;</div>';

    return $ht;
}

function ipslides_slide_switcher_small($atts, $content) {


    $data['class'] = "slide_switcher_small";
    $data['height'] = '135';
    $data['container'] = $atts['id'];
    $data['color'] = isset($atts['color']) ? $atts['color'] : 'black';


    $ht = ipslides_page_slider_common($atts, $content, $data);

    return $ht;
}

add_shortcode('slide_switcher_small', 'ipslides_slide_switcher_small');

function ipslides_slide_switcher_medium($atts, $content) {

    $plugin_dir = WP_PLUGIN_URL . "/";


    $data['class'] = "slide_switcher_medium";
    $data['height'] = '345';
    $data['container'] = $atts['id'];
    $data['color'] = isset($atts['color']) ? $atts['color'] : 'black';

    $ht = ipslides_page_slider_common($atts, $content, $data);

    return $ht;
}

add_shortcode('slide_switcher_medium', 'ipslides_slide_switcher_medium');


?>
