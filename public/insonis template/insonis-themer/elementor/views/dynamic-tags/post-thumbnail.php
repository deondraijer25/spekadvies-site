<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $insonis_post;
   if (!$insonis_post){
      return;
   }
?>

<?php 
   $thumbnail_size = $settings['insonis_image_size'];

   if(has_post_thumbnail($insonis_post)){
      echo get_the_post_thumbnail($insonis_post, $thumbnail_size);
   }
?>

