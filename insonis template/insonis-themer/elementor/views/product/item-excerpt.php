<?php
   if (!defined('ABSPATH')){ exit; }

   global $insonis_post, $post;
   if( !$insonis_post ){ return; }
   if( $insonis_post->post_type != 'product' ){ return; }

   $this->add_render_attribute('block', 'class', [ 'product-item-excerpt' ]);
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <div itemprop="description">
      <?php echo apply_filters( 'woocommerce_short_description', $insonis_post->post_excerpt ) ?>
   </div>
</div>
