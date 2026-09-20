<?php
	if (!defined('ABSPATH')){ exit; }

	global $insonis_post, $post;
	if( !$insonis_post ){ return; }
	if( $insonis_post->post_type != 'product' ){ return; }
   $post_id = $insonis_post->ID;
	if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $post->post_type == 'gva__template'){
      global $product;
      $product = wc_get_product($post_id);
   }
?>

<div class="product-item-price">
	<?php woocommerce_template_single_price() ?>
</div>