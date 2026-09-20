<?php 
add_editor_style( array( 'style.css', get_template_directory(), 'style.css' ) );

// Set default width content*
if ( ! isset( $content_width ) ) $content_width = 900;

// Add support in theme
add_theme_support( 'post-thumbnails' ); 
set_post_thumbnail_size( 500, 400, true );
add_theme_support( 'automatic-feed-links' );
add_image_size('insonis_medium', 550, 632, true );
remove_image_size('1536x1536');
remove_image_size('2048x2048');

// Set Global Theme Options
if(!function_exists('insonis_theme_option')){
	function insonis_theme_option(){
		global $insonis_theme_options;
		$insonis_theme_options = get_option( 'insonis_theme_options' );
	}
}    
add_action('wp_head', 'insonis_theme_option', 99);

function insonis_admin_scripts() {
	wp_enqueue_style('insonis-be-style', INSONIS_THEME_URL . '/includes/assets/css/admin.css');
	wp_enqueue_script('insonis-be-script', INSONIS_THEME_URL . '/includes/assets/js/admin.js', 'jquery', '1.0', TRUE);
}
add_action('admin_enqueue_scripts', 'insonis_admin_scripts');

//  Customize header
function insonis_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'insonis_custom_header_args', array(
	  'default-text-color'     => 'fff',
	  'width'                  => 1260,
	  'height'                 => 240,
	  'flex-height'            => true,
	  'wp-head-callback'       => 'insonis_header_style',
	  'admin-head-callback'    => 'insonis_admin_header_style',
	  'admin-preview-callback' => 'insonis_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'insonis_custom_header_setup' );

function insonis_header_style(){
	$text_color = get_header_textcolor();
	$image = get_header_image();
	if($image){
	?>
		<style>header{ background: url('<?php echo esc_url($image) ?>')!important; }</style>
	<?php
	}
}

add_theme_support( 'custom-background', apply_filters( 'insonis_custom_background_args', array(
	 'default-color' => 'f5f5f5',
) ) );
add_theme_support( 'title-tag' );


function insonis_posted_on($show_cat = false) {
	global $post;
	$author_name = get_the_author_meta( 'display_name', $post->post_author );
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post hidden">' . esc_html__( 'Sticky', 'insonis' ) . '</span>';
	}
	echo '<div class="clearfix meta-inline post-meta-1">';
		echo( '<span class="author vcard"><i class="fas fa-user-circle"></i>' . $author_name . '</span>');
		if(comments_open()){
			echo '<span class="post-comment"><i class="fas fa-comments"></i>';
				echo comments_number( esc_html__('0 Comments', 'insonis'), esc_html__('1 Comment', 'insonis'), esc_html__('% Comments', 'insonis') );
			echo '</span>';
		}
		if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && is_single() && $show_cat ){
			echo '<span class="cat-links"><i class="fas fa-tags"></i>' . get_the_category_list( _x( ", ", "Used between list items, there is a space after the comma.", "insonis" ) ) . '</span>';
		}
	echo '</div>';  
}

function insonis_posted_on_two($show_cat = false) {
	global $post;
	$author_name = get_the_author_meta( 'display_name', $post->post_author );
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post hidden">' . esc_html__( 'Sticky', 'insonis' ) . '</span>';
	}
	echo '<div class="clearfix meta-inline post-meta-two">';
		if( get_the_date() ){
         echo '<div class="entry-date">';
            echo '<span class="date">' . esc_html( get_the_date('d')) . '</span>';
            echo '<span class="month">' . esc_html( get_the_date('M')) . '</span>';
         echo '</div>';
      } 
		if(comments_open()){
			echo '<div class="post-comment"><i class="iicon-bubble-chat"></i>';
				echo comments_number( esc_html__('0 Comments', 'insonis'), esc_html__('1 Comment', 'insonis'), esc_html__('% Comments', 'insonis') );
			echo '</div>';
		}
	echo '</div>';  
}

function insonis_posted_on_width_avata() {
	echo '<div class="left">';
		echo get_avatar( get_the_author_meta( 'ID' ), 160 ); 
	echo '</div>';
	echo '<div class="right">';    
		echo( '<span class="author vcard"><i class="fas fa-user-circle"></i>' . esc_html__('by', 'insonis') . '&nbsp;' . get_the_author() . '</span>');
		  if(comments_open()){
				echo '<span class="post-comment"><i class="fas fa-comments"></i>';
					echo comments_number( esc_html__('0 comments', 'insonis'), esc_html__('1 comment', 'insonis'), esc_html__('% comments', 'insonis') );
				echo '</span>';
		  	}
	echo '</div>';    
}

function insonis_pagination( $query = false ){
	global $wp_query;   
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
	if( ! $query ) $query = $wp_query;
	$translate['prev'] =  esc_html__('Prev page', 'insonis');
	$translate['next'] =  esc_html__('Next page', 'insonis');
	$translate['load-more'] = esc_html__('Load more', 'insonis');
	$query->query_vars['paged'] > 1 ? $current = $query->query_vars['paged'] : $current = 1;  
	if( empty( $paged ) ) $paged = 1;
	$prev = $paged - 1;                         
	$next = $paged + 1;
	$end_size = 1;
	$mid_size = 2;
	$show_all = false;
	$dots = false;
	if( ! $total = $query->max_num_pages ) $total = 1;
	  
	$output = '';
	if( $total > 1 ){   
		$output .= '<div class="column one pager_wrapper">';
			$output .= '<div class="pager">';
				$output .= '<div class="paginations">';
					if($paged >1 && !is_home()){
						$output .= '<a class="prev_page" href="'. previous_posts(false) .'"><i class="fas fa-arrow-left"></i></a>';
					}
					for($i=1; $i <= $total; $i++){
						if ($i == $current){
							$output .= '<a href="'. get_pagenum_link($i) .'" class="page-item active">'. $i .'</a>';
							$dots = true;
						} else {
							if ($show_all || ( $i <= $end_size || ( $current && $i >= $current - $mid_size && $i <= $current + $mid_size ) || $i > $total - $end_size )){
								$output .= '<a href="'. get_pagenum_link($i) .'" class="page-item">'. $i .'</a>';
								$dots = true;
							} elseif ( $dots && ! $show_all ) {
								$output .= '<span class="page-item">... </span>';
								$dots = false;
							}
						}
					}
					if($paged < $total && !is_home()){
						$output .= '<a class="next_page" href="'. next_posts(0,false) .'"><i class="fas fa-arrow-right"></i></a>';
					}
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>'."\n";    
	}
	return $output;
}

function insonis_post_nav() {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous ) { return; }
	?>
	<nav class="navigation hidden post-navigation" role="navigation">
	  	<div class="nav-links">
			<?php
			 	if ( is_attachment() ) :
					previous_post_link( '%link', '<span class="meta-nav">'. esc_html__('Published In', 'insonis') .'</span><span class="title"></span>' );
			 	else :
					previous_post_link( '%link', '<span class="meta-nav prev"><i class="fas fa-chevron-left"></i>'.esc_html__('Previous Post', 'insonis') .'</span><span class="title prev"></span>' );
					next_post_link( '%link', '<span class="meta-nav next">'.esc_html__('Next Post', 'insonis') .'<i class="fas fa-chevron-right"></i></span><span class="title next"></span>' );
			 	endif;
			?>
	  	</div>
	</nav>
	<?php
}
