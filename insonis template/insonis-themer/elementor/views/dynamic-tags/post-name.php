<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $insonis_post;
   if (!$insonis_post){
      return;
   }
   $html_tag = $settings['html_tag'];
?>

<div class="insonis-post-title">
   <<?php echo esc_attr($html_tag) ?> class="post-title">
      <span><?php echo get_the_title($insonis_post) ?></span>
   </<?php echo esc_attr($html_tag) ?>>
</div>   