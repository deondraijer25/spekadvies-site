<?php
	if (!defined('ABSPATH')) {
		exit; 
	}
	global $insonis_post;
	if (!$insonis_post){
		return;
	}
	?>
	
	<div class="post-category">
		<?php 
			if($settings['show_icon']){ 
				echo '<i class="fas fa-folder-open"></i>';
			}
			echo '<span>' . get_the_category_list( ", ", '', $insonis_post->ID ) . '</span>';
		?>
	</div>      

