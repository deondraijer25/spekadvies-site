<?php 
	use Elementor\Icons_Manager;
   use Elementor\Group_Control_Image_Size;
	$has_icon = !empty($item['selected_icon']['value']);
   $active = $item['active'] == 'yes' ? ' active' : '';
?>

<?php 
if($settings['style'] == 'style-1'){ 

	$image_id = $item['image']['id']; 
   $image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
   if($image_id){
      $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
      if($attach_url){
         $image_url = $attach_url;
      }
   }

   echo '<div class="service-one' . esc_attr($active) . esc_attr($last_style) . '">';
      echo '<div class="service-one__content">';

   		if($image_url){ 
				echo '<div class="service-one__image">';
					echo '<img src="' . esc_url($image_url) . '" alt="' . esc_html($item['title']) . '"/>';
					if($has_icon){
						echo '<span class="service-one__icon">';
							Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
						echo '</span>';
				 	} 
				echo '</div>';
			}

			echo '<div class="service-one__content-inner">';
				
				if($item['title']){
					echo '<h4 class="service-one__title"><span>' . esc_html($item['title']) . '</span></h4>';
				}
				if($item['desc']){
					echo '<div class="service-one__desc">' . $item['desc']  . '</div>';
				}
				if( $last_style && isset($item['link']['url']) && $item['link']['url'] ){
               $this->gva_render_link_html($settings['btn_label'], $item['link'], 'btn-theme service-one__link'); 
				}
			echo '</div>';

			echo $this->gva_render_link_overlay($item['link'], 'service-one__link-overlay');
			
		echo '</div>';
	echo '</div>';
} 

?>	

<?php
if($settings['style'] == 'style-2'){ 

	$image_id = $item['image']['id']; 
   $image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
   if($image_id){
      $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
      if($attach_url){
         $image_url = $attach_url;
      }
   }

   echo '<div class="service-two' . esc_attr($active) . '">';
		echo '<div class="service-two__content">';
			if($item['title']){
				echo '<h3 class="service-two__title"><span>' . trim($item['title']) . '</span></h3>';
			}
			if($item['desc']){
				echo '<div class="service-two__desc">' . $item['desc']  . '</div>';
			}
			if(isset($item['link']['url']) && $item['link']['url']){
	         echo '<div class="service-two__button">';
	            $this->gva_render_link_html_2(esc_html__('Read More', 'insonis-themer'), $item['link'], 'btn-inline'); 
	         echo '</div>';
	      }
		echo '</div>';
		if($image_url){ 
         echo '<div class="service-two__image">';
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_html($item['title']) . '"/>';
         echo '</div>';
      }
		if($has_icon){
         echo '<span class="service-two__icon">';
            Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
         echo '</span>';
      } 
      
		echo $this->gva_render_link_overlay($item['link'], 'service-two__link-overlay');
	echo '</div>';
} 	
?>

<?php
if($settings['style'] == 'style-3'){ 

   $image_id = $item['image']['id']; 
   $image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
   if($image_id){
      $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
      if($attach_url){
         $image_url = $attach_url;
      }
   }

   echo '<div class="service-three' . esc_attr($active) . '">';
      echo '<div class="service-three__wrap">';
         if($has_icon){
            echo '<span class="service-three__icon">';
               echo '<span class="service-three__icon-inner">';
                  Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
               echo '</span>';
            echo '</span>';
         } 
         echo '<div class="service-three__content">';
            if($item['title']){
               echo '<h4 class="service-three__title"><span>' . esc_html($item['title']) . '</span></h4>';
            }
            if($item['desc']){
               echo '<div class="service-three__desc">' . $item['desc']  . '</div>';
            }
            if(isset($item['link']['url']) && $item['link']['url']){
               echo '<div class="service-three__button">';
                  $this->gva_render_link_html_2(esc_html__('Read more', 'insonis-themer'), $item['link'], 'btn-theme btn-medium'); 
               echo '</div>';
            }
         echo '</div>';
         if($image_url){ 
            echo '<div class="service-three__image">';
               echo '<img src="' . esc_url($image_url) . '" alt="' . esc_html($item['title']) . '"/>';
            echo '</div>';
         }
         echo $this->gva_render_link_overlay($item['link'], 'service-three__link-overlay');
      echo '</div>';
   echo '</div>';
}  
?>
