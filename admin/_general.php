<?php

add_filter('woocommerce_background_image_regeneration', '__return_false');

if (is_admin()) {
  add_action('admin_enqueue_scripts', 'hwc_admin_assets', 100);

  // add_action('plugins_loaded', function() {
  //   if (!class_exists('Woo_Variation_Swatches')) { return; }

  //   add_filter('custom_menu_order', '__return_true');
  //   add_filter('menu_order', '_hwc_remove_woo_swatches_menu');
  //   add_action('admin_menu', '_hwc_add_woo_swatches_menu', 100);
  // });
}

/**
 * @action admin_enqueue_scripts 100
 */
function hwc_admin_assets() {
  wp_enqueue_script('hwc-admin', HWC_DIST . '/hwc-admin.js', [], HWC_VERSION , true);
  wp_enqueue_style('hwc-admin', HWC_DIST . '/hwc-admin.css', [], HWC_VERSION);
}

/**
 * @filter menu_order
 */
function _hwc_remove_woo_swatches_menu($menu_order) {
  $index1 = array_search('separator-getwooplugins', $menu_order);
  $index2 = array_search('getwooplugins', $menu_order);

  unset($menu_order[$index1]);
  unset($menu_order[$index2]);

  return $menu_order;
}

/**
 * @action admin_menu
 */
function _hwc_add_woo_swatches_menu() {
  add_submenu_page(
    'woocommerce',
    'Swatches Settings',
    'Swatches Settings',
    'manage_options',
    'getwooplugins-settings',
  );
}