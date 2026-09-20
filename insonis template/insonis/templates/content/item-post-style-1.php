<?php 
   global $post;

   $thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'post-thumbnail';
   $excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : '0';

   $desc = insonis_limit_words($excerpt_words, get_the_excerpt(), '');

   $meta_classes = 'post-one__meta';
   if(empty(get_the_date())){
      $meta_classes = 'post-one__meta schedule-date';
   }
   $content_classes = 'post-one__content';
   $thumbnail_check = has_post_thumbnail() ? ' has-thumbnail' : ' has-no-thumbnail';
   $content_classes .= $thumbnail_check;
?>

   <article <?php post_class('post post-one'); ?>>
   	<div class="post-one__thumbnail">
      	<?php 
	         if(has_post_thumbnail()){
               echo '<a href="' . esc_url( get_permalink() ) . '">';
                  the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) );
               echo '</a>';
	         }
	      ?>
      </div>
      <div class="<?php echo esc_attr($content_classes) ?>">
         <div class="<?php echo esc_attr($meta_classes) ?>">
            <?php insonis_posted_on_two(); ?>
         </div> 
         <h3 class="post-one__title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></h3>
         <?php 
            if($desc){ 
               echo '<div class="post-one__desc">';
                  echo esc_html($desc);
               echo '</div>';   
            } 
         ?>
         <div class="post-one__bottom">
            <a class="post-one__read-more" href="<?php echo esc_url( get_permalink() ) ?>">
              <?php echo esc_html__('Read More', 'insonis'); ?>
            </a>
            <a class="post-one__arrow" href="<?php echo esc_url( get_permalink() ) ?>">
              	<svg width="64pt" height="50pt" viewBox="0 0 64 50" version="1.1" xmlns="http://www.w3.org/2000/svg">
						<g><path fill="" opacity="1.00" d=" M 38.91 0.00 L 38.99 0.00 C 47.30 8.34 55.64 16.66 64.00 24.96 L 64.00 25.01 C 55.64 33.33 47.29 41.66 38.96 50.00 L 38.94 50.00 C 37.23 48.34 35.58 46.62 33.88 44.94 C 39.38 39.48 44.84 33.97 50.37 28.54 C 33.58 28.54 16.79 28.58 0.00 28.55 L 0.00 21.42 C 16.79 21.40 33.58 21.43 50.37 21.41 C 44.82 15.99 39.38 10.48 33.88 5.01 C 35.57 3.36 37.21 1.65 38.91 0.00 Z" /></g>
					</svg>
            </a>
         </div>
      </div>
   </article>   

  