<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $insonis_post;
   if (!$insonis_post){
      return;
   }
   ?>
   
   <div class="post-content">
         <?php 
            echo $insonis_post->post_content;
         ?>
   </div>      

