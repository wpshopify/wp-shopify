<?php

if (empty($collection->image)) {
  $src = WP_PLUGIN_URL . '/wp-shopify/public/imgs/placeholder.png';

} else {
  $src = $collection->image;

}

?>

<img
  itemprop="image"
  src="<?php echo $src; ?>"
  alt="<?php echo $collection->title . ' collection '; ?>"
  class="wps-collection-img <?php echo apply_filters('wps_collections_single_img_class', ''); ?>">
