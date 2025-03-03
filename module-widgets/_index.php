<?php

add_action('widgets_init', '_hwc_unregister_widgets', 100);
add_action('widgets_init', '_hwc_register_widgets');

add_filter('acf/settings/load_json', '_hwc_load_acf_json_widgets', 20);

/**
 * @action widgets_init 100
 */
function _hwc_unregister_widgets() {
  $disabled_widgets = apply_filters('hwc_disabled_widgets', [
    'WC_Widget_Products',
    'WC_Widget_Product_Tag_Cloud',
    'WC_Widget_Layered_Nav_Filters',
    'WC_Widget_Layered_Nav',
    'WC_Widget_Price_Filter',
    // 'WC_Widget_Cart',
    'WC_Widget_Product_Categories',
    'WC_Widget_Product_Search',
    'WC_Widget_Top_Rated_Products',
    'WC_Widget_Recent_Reviews',
    'WC_Widget_Rating_Filter',
    'WC_Widget_Recently_Viewed',
  ]);

  foreach ($disabled_widgets as $w) { 
    unregister_widget($w);
  }
}

/**
 * @action widgets_init
 */
function _hwc_register_widgets() {
  require_once __DIR__ . '/widget-cart.php';
  require_once __DIR__ . '/widget-myaccount.php';

  register_widget('HWC_Widget_Cart');
  register_widget('HWC_Widget_MyAccount');
}

/**
 * Load the ACF JSON for WooCommerce widgets
 * 
 * @filter acf/settings/load_json
 */
function _hwc_load_acf_json_widgets($paths) {  
  $paths[] = plugin_dir_path(__FILE__) . '/acf-json';
  return $paths;
}

/////

if (!class_exists('HWC_Widget')):
/**
 * Class to create a new widget
 */
class HWC_Widget extends WP_Widget {
  function __construct($slug, $name, $args) {
    parent::__construct($slug, $name, $args);
  }


  /**
   * Outputs the content of the widget
   */
  function widget($args, $instance) {
    $content = '';
    echo $args['before_widget'] . $content . $args['after_widget'];
  }

  /**
   * Leave empty, will be handled by ACF
   */
  function form($instance) {
    
  }

  /**
   * Leave empty, will be handled by ACF
   */
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  

  /**
   * Add ACF fields for this widget
   */
  function add_acf_fields() {
    acf_add_local_field_group([]);
  }
}
endif;
