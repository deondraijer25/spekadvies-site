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
   $thumbnail = 'insonis_medium';
   if(isset($thumbnail_size) && $thumbnail_size){
      $thumbnail = $thumbnail_size;
   }
   if(isset($layout) && $layout && $layout == 'grid'){
      $item_classes .= ' item-columns isotope-item';
   }
  
   $desc = '';
   $excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : 30;
   if(has_excerpt()){
      $desc = insonis_limit_words($excerpt_words, get_the_excerpt(), '');
   }

?>
<div class="<?php echo esc_attr($item_classes) ?>">
   <div class="portfolio-three">      
      <div class="portfolio-three__image">
         <a class="portfolio-three__link" href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail()) {
               the_post_thumbnail($thumbnail);
            }?>
         </a>
      </div>
      <div class="portfolio-three__content">
         <div class="portfolio-three__category"><?php echo wp_kses($post_category, true) ?></div>
         <h3 class="portfolio-three__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
      			<span class="portfolio-three__arrow"><i class="iicon-arrow-right"></i></span>
            </a>
         </h3>
      </div> 
   </div>
</div>
