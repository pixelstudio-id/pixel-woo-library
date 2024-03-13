<?php

if (is_admin()) {
  add_action('enqueue_block_editor_assets', 'px_enqueue_shop_gutenberg_assets', 100);

  add_action('after_setup_theme', function() {
    if (get_theme_support('px-product-gutenberg')) {
      add_filter('use_block_editor_for_post_type', 'px_enable_gutenberg_in_product', 10, 2);
    }
  }, 20);
}

/**
 * Add assets for WooCommerce blocks
 * 
 * @action enqueue_block_editor_assets
 */
function px_enqueue_shop_gutenberg_assets() {
  if (!is_admin()) { return; }
  
  $dir = plugin_dir_url(__FILE__) . 'dist';
  $assets = [
    'h-shop-editor',
    // 'h-products' // error because it's a dynamic block
  ];

  foreach ($assets as $a) {
    wp_enqueue_script($a, $dir . "/$a.js", [ 'wp-blocks', 'wp-dom' ] , HWC_VERSION, true);
    wp_enqueue_style($a, $dir . "/$a.css", [ 'wp-edit-blocks' ], HWC_VERSION);
  }
}

/**
 * Allow Product post-type to use Gutenberg
 * 
 * @filter use_block_editor_for_post_type
 */
function px_enable_gutenberg_in_product($can_edit, $post_type) {
  if ($post_type == 'product') {
    $can_edit = true;
  }
  return $can_edit;
}