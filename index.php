<?php
/*
Plugin Name: Before After Image Slider (AMP)
Plugin URI: http://jamesozz.ie
Description: Easily create a before and after image slider. Great for comparing photos side by side. To implement use the [jozz-ampimageslider] shortcode. 
Author: James Osborne
Version: 1.0.0
Author URI: https://jamesozz.ie
 */
define('jozzampimageslider_PLUGIN_DIR', plugin_dir_path(__FILE__));
// include options file
include plugin_dir_path(__FILE__) . '/options.php';
// create custom plugin settings menu
add_action('admin_menu', 'jozzampimageslider_custom_settings');
function jozzampimageslider_custom_settings()
{
    $page_title = 'Before After Image Slider ';
    $menu_title = 'Before After Image Slider ';
    $capability = 'manage_options';
    $slug = 'jozzampimageslider-settings-cssbacktotop';
    $start = 'jozzampimageslider_custom_settings_start';
    add_options_page($page_title, $menu_title, $capability, $slug, $start);
}
// Create option settings
add_action('admin_init', 'jozzampimageslider_field');
function jozzampimageslider_field()
{
    register_setting('jozzampimageslider-settings', 'viewoption');
    register_setting('jozzampimageslider-settings', 'imageselector_one');
    register_setting('jozzampimageslider-settings', 'jozzampimageslider_width');
    register_setting('jozzampimageslider-settings', 'jozzampimageslider_height');
    register_setting('jozzampimageslider-settings', 'jozzampimageslider_image_1a');
    register_setting('jozzampimageslider-settings', 'jozzampimageslider_image_1b');
}
//set the rendering options
function jozzampimageslider_shortcode() { 
    $imgUrl1a = get_option('jozzampimageslider_image_1a');
    $imgUrl1b = get_option('jozzampimageslider_image_1b');
    $img_width = get_option('jozzampimageslider_width','200');
    $img_height = get_option('jozzampimageslider_height','200');
    if ( get_option( 'viewoption' ) === false ) // Nothing yet saved
    update_option( 'viewoption', 'AMP & Canonical' ); // Set the default
    $jozzampimageslider_viewoption = esc_attr(get_option('viewoption', 'AMP & Canonical'));
    if  ($jozzampimageslider_viewoption == "AMP only"){  
                if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
                 $jozzampimageslider_message =	'	
                 <amp-image-slider id="triangle-hint" width="'.$img_width.'" height="'.$img_height.'" layout="intrinsic">
                   <amp-img src="'.$imgUrl1a.'" alt="before" layout="fill"></amp-img>
                    <amp-img src="'.$imgUrl1b.'" alt="after" layout="fill"></amp-img>
                 </amp-image-slider>
                  ';
                 } else {
                   return;
                }
	} elseif  ($jozzampimageslider_viewoption == "Canonical only"){
              if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
                  return;
               } else {
                  wp_register_script ( 'amp-image-slider', get_template_directory_uri() . 'https://cdn.ampproject.org/v0/amp-image-slider.js' );
                    wp_enqueue_script ( 'amp-image-slider' );
                    wp_register_script ( 'amp-library', get_template_directory_uri() . 'https://cdn.ampproject.org/v0.js' );
                    wp_enqueue_script ( 'amp-library' );
                    $jozzampimageslider_message =	'	
                    <amp-image-slider id="triangle-hint" width="'.$img_width.'" height="'.$img_height.'" layout="intrinsic">
                    <amp-img src="'.$imgUrl1a.'" alt="before" layout="fill"></amp-img>
                    <amp-img src="'.$imgUrl1b.'" alt="after" layout="fill"></amp-img>
                    </amp-image-slider>
                    ';
              }
	} else{
        wp_register_script ( 'amp-image-slider', get_template_directory_uri() . 'https://cdn.ampproject.org/v0/amp-image-slider.js' );
        wp_enqueue_script ( 'amp-image-slider' );
        wp_register_script ( 'amp-library', get_template_directory_uri() . 'https://cdn.ampproject.org/v0.js' );
        wp_enqueue_script ( 'amp-library' );
        $jozzampimageslider_message =	'	
        <amp-image-slider id="triangle-hint" width="'.$img_width.'" height="'.$img_height.'" layout="intrinsic">
        <amp-img src="'.$imgUrl1a.'" alt="before" layout="fill"></amp-img>
        <amp-img src="'.$imgUrl1b.'" alt="after" layout="fill"></amp-img>
        </amp-image-slider>
		';
    }
 return $jozzampimageslider_message;
}
add_shortcode('jozz-ampimageslider', 'jozzampimageslider_shortcode');
// Add the style - blank at this stage until custom buttons implemented
function jozzampimageslider_load_plugin_css()
{
    $plugin_url = plugin_dir_url(__FILE__);
    wp_enqueue_style('style1', $plugin_url . 'css/style.css');
}
add_action('wp_enqueue_scripts', 'jozzampimageslider_load_plugin_css');
// create link to the settings page from plugins page
function jozzampimageslider_plugin_settings_link($links)
{
    $settings_link =
        '<a href="options-general.php?page=jozzampimageslider-settings-cssbacktotop.php">Settings</a>';
    array_push($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'jozzampimageslider_plugin_settings_link');
// load media uploader
function jozzampimageslider_media_uploader_enqueue() {
    wp_enqueue_media();
    wp_register_script('media-uploader', plugins_url('media-uploader.js' , __FILE__ ), array('jquery'));
    wp_enqueue_script('media-uploader');
}
add_action('admin_enqueue_scripts', 'jozzampimageslider_media_uploader_enqueue');