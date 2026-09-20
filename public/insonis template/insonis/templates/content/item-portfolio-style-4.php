<?php 
   $post_id = get_the_ID();
   $item_classes = 'all ';
   $post_category = ''; $separator = ', '; $output = '';
   $item_cats = get_the_terms( get_the_ID(), 'category_portfolio' );

   if(!empty($item_cats) && !is_wp_error($item_cats)){
      foreach((array)$item_cats as $item_cat){
         $item_classes .= $item_cat->slug . ' ';
         $output .= '<a href="'.get_category_link( $item_cat->term_id ).'" title="' . esc_attr( sprintf( esc_attr__( "View all posts in %s", 'insonis' ), $item_cat->name ) ) . '">'.$item_cat->name.'</a>'.$separator;
      }
      $post_category = trim($output, $separator);
   }
   $thumbnail = 'post-thumbnail';
   if(isset($thumbnail_size) && $thumbnail_size){
      $thumbnail = $thumbnail_size;
   }
   if(isset($layout) && $layout && $layout == 'grid'){
      $item_classes .= ' item-columns isotope-item';
   }
?>
<div class="<?php echo esc_attr($item_classes) ?>">
   <div class="portfolio-four">      
      <div class="portfolio-four__image">
         <a class="portfolio-four__link-image" href="<?php the_permalink(); ?>">
            <?php 
               if(has_post_thumbnail()){
                  the_post_thumbnail($thumbnail);
               }
            ?>
         </a> 
      </div>
      <div class="portfolio-four__content">
      	<div class="portfolio-four__category"><?php echo wp_kses($post_category, true) ?></div>
         <h3 class="portfolio-four__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
         </h3>
         <a class="portfolio-four__arrow" href="<?php the_permalink(); ?>"><i class="iicon-arrow-right"></i></a>
      </div>  
   </div>
</div>
