<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $insonis_post;
   if (!$insonis_post){
      return;
   }
   ?>
   
   <div class="post-date">
         <?php 
            if($settings['show_icon']){ 
               echo '<i class="far fa-calendar"></i>';
            }
            echo get_the_date( get_option('date_format'), $insonis_post->ID);
         ?>
   </div>      

