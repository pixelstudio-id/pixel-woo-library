<?php

add_filter('woocommerce_background_image_regeneration', '__return_false');

if (is_admin()) {
  add_action('admin_enqueue_scripts', 'hwc_admin_assets', 100);
}

/**
 * @action admin_enqueue_scripts 100
 */
function hwc_admin_assets() {
  wp_enqueue_script('hwc-admin', HWC_DIST . '/hwc-admin.js', [], HWC_VERSION , true);
  wp_enqueue_style('hwc-admin', HWC_DIST . '/hwc-admin.css', [], HWC_VERSION);
}