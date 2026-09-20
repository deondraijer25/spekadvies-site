<?php
   if (!defined('ABSPATH')){ exit; }

   global $insonis_post, $post;

   if(!$insonis_post){ return; }
   $post = $insonis_post;
?>
   
<div class="post-comment">
   <?php
      if(comments_open($insonis_post->ID)){
         comments_template();
      }else{
         if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
            echo '<div class="alert alert-info">' . esc_html__('This Post Disabled Comment', 'insonis-themer') . '</div>';
         }
      }
   ?>
</div>      

