<?php 
	use Elementor\Icons_Manager;
	$has_icon = !empty($item['selected_icon']['value']);
	$style = $settings['style'];
	$active = $item['active']=='yes' ? ' active' : '';
?>

<div class="icon-box-item elementor-repeater-item-<?php echo $item['_id'] ?>">
	<?php 
		if( $style == 'style-1' ){
			echo '<div class="iconbox-one__single' . $active . '">';
				if($item['title']){ 
					echo '<h3 class="iconbox-one__title el-title">' . $item['title'] . '</h3>';
				}
				if($has_icon){ 
					echo '<div class="iconbox-one__icon el-icon">';
						Icons_Manager::render_icon($item['selected_icon'], [ 'aria-hidden' => 'true' ]); 
					echo '</div>';
				}
				if($item['desc']){ 
					echo '<div class="iconbox-one__desc el-desc">' .$item['desc'] . '</div>';
				}
		 		$this->gva_render_link_html('', $item['link'], 'iconbox-one__link-overlay');
			echo '</div>';	
		}
	?>

	<?php 
		if( $style == 'style-2' ){
			echo '<div class="iconbox-two__single' . $active . '">';
				echo '<div class="iconbox-two__content">';
					if($has_icon){ 
						echo '<div class="iconbox-two__icon el-icon">';
							Icons_Manager::render_icon($item['selected_icon'], [ 'aria-hidden' => 'true' ]); 
						echo '</div>';
					}
					echo '<div class="iconbox-two__content-inner">';
						if($item['title']){ 
							echo '<h3 class="iconbox-two__title el-title">' . $item['title'] . '</h3>';
						}
						if($item['desc']){ 
							echo '<div class="iconbox-two__desc el-desc">' .$item['desc'] . '</div>';
						}
					echo '</div>';	
				echo '</div>';	
			 	$this->gva_render_link_html('', $item['link'], 'iconbox-two__link-overlay');
			echo '</div>';	
		}
	?>

	<?php 
		if( $style == 'style-3' ){
			echo '<div class="iconbox-three' . $active . '">';
				if($item['number']){
					echo '<span class="iconbox-three__number">' . esc_html($item['number']) . '</span>';	
				}
				if($has_icon){ 
					echo '<div class="iconbox-three__icon el-icon">';
						Icons_Manager::render_icon($item['selected_icon'], [ 'aria-hidden' => 'true' ]); 
					echo '</div>';
				}
				if($item['title']){ 
					echo '<h3 class="iconbox-three__title el-title">' . trim($item['title']) . '</h3>';
				}
				if($item['desc']){ 
					echo '<div class="iconbox-three__desc el-desc">' . wp_kses($item['desc'], true) . '</div>';
				}
		 		$this->gva_render_link_html('', $item['link'], 'iconbox-three__link-overlay');
			echo '</div>';	
		}
	?>

	<?php 
		if( $style == 'style-4' ){
			echo '<div class="iconbox-four' . $active . '">';
				if($has_icon){ 
					echo '<div class="iconbox-four__icon el-icon">';
						Icons_Manager::render_icon($item['selected_icon'], [ 'aria-hidden' => 'true' ]); 
					echo '</div>';
				}
				if($item['title']){ 
					echo '<h3 class="iconbox-four__title el-title">' . trim($item['title']) . '</h3>';
				}
				if($item['desc']){ 
					echo '<div class="iconbox-four__desc el-desc">' . wp_kses($item['desc'], true) . '</div>';
				}
		 		$this->gva_render_link_html('', $item['link'], 'iconbox-four__link-overlay');
			echo '</div>';	
		}
	?>

	<?php 
		if( $style == 'style-5' ){
			echo '<div class="iconbox-five' . $active . '">';
				echo '<div class="iconbox-five__wrap">';
					if($has_icon){ 
						echo '<div class="iconbox-five__icon el-icon">';
							Icons_Manager::render_icon($item['selected_icon'], [ 'aria-hidden' => 'true' ]); 
						echo '</div>';
					}
					echo '<div class="iconbox-five__content">';
						if($item['title']){ 
							echo '<h3 class="iconbox-five__title el-title">' . $item['title'] . '</h3>';
						}
						if($item['desc']){ 
							echo '<div class="iconbox-five__desc el-desc">' .$item['desc'] . '</div>';
						}
						if(isset($item['link']['url']) && $item['link']['url']){
				         echo '<div class="iconbox-five__button">';
				            $this->gva_render_link_html_2(esc_html__('Read More', 'insonis-themer'), $item['link'], 'btn-inline'); 
				         echo '</div>';
				      }
					echo '</div>';	
				echo '</div>';	
			 	$this->gva_render_link_html('', $item['link'], 'iconbox-five__link-overlay');
			echo '</div>';	
		}
	?>
</div>