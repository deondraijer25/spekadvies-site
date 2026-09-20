<?php
   if (!defined('ABSPATH')){ exit; }

   global $insonis_post;
   if( !$insonis_post || $insonis_post->post_type != 'product' ||  !$insonis_post->post_excerpt ){ return; }
   
   $post_id = $insonis_post->ID;
   $this->add_render_attribute('block', 'class', [ 'cf-item-social-share' ]);
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <?php wpcf_function()->template('include/social-share'); ?>
</div>