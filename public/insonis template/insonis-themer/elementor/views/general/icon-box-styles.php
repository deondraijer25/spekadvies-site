<?php
use Elementor\Icons_Manager;

$style = $settings['style'];
$description_text = $settings['description_text'];
$header_tag = 'h2';
if(!empty($settings['header_tag'])) $header_tag = $settings['header_tag'];

$has_icon = (!empty( $settings['selected_icon']['value'])) ? true : false;
$title_html = $settings['title_text'];

$this->add_render_attribute( 'block', 'class', [ 'widget iconbox-style', $settings['style'], $settings['active'] == 'yes' ? 'active' : '' ] );
$this->add_render_attribute( 'description_text', 'class', 'iconbox-desc' );
$this->add_render_attribute( 'title_text', 'class', 'title' );

$this->add_inline_editing_attributes( 'title_text', 'none' );
$this->add_inline_editing_attributes( 'description_text' );

?>

<?php if($style == 'style-1'){ ?>
   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      <div class="icon-box-content">
        
         <?php if ( $has_icon ){ ?>
            <div class="icon-inner">
               <span>
                  <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
               </span>
            </div>
         <?php } ?>

         <div class="box-content">
            <?php if(!empty($settings['title_text'])){ ?>
               <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                  <?php echo $title_html; ?>
               </<?php echo esc_attr($header_tag) ?>>
            <?php } ?>
            <?php if(!empty($settings['description_text'])){ ?>
               <div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo wp_kses($description_text, true); ?></div>
            <?php } ?>
         </div>
      </div> 
      <?php $this->gva_render_link_html('', $settings['button_url'], 'link-overlay'); ?>
   </div>   
<?php } ?>

<?php if($style == 'style-2'){ ?>
   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      <div class="iconbox-wrap">
         <?php 
         	if($has_icon){ 
               echo '<span class="iconbox-icon">';
                  if($has_icon){ 
                     Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                  }  
               echo '</span>';
         	} 
         	?>
         <div class="iconbox-content">
         	<?php 
            	if(!empty($settings['title_text'])){
	               echo '<' . esc_attr($header_tag) .' '. $this->get_render_attribute_string( 'title_text' ) . '>';
	                 	echo trim($title_html); 
	               echo '</' . esc_attr($header_tag) . '>';
            	} 
            ?>
	         <?php 
	         	if(!empty($settings['description_text'])){ 
	            	echo '<div ' . $this->get_render_attribute_string( 'description_text' ). '>';
	            		echo wp_kses($description_text, true);
	            	echo '</div>';
	         	} 
	         ?>
      	</div>
         <?php $this->gva_render_link_html('', $settings['button_url'], 'link-overlay'); ?>
      </div>
   </div>   
<?php } ?>

<?php 
	if( $style == 'style-3' ){
		echo '<div ' . $this->get_render_attribute_string( 'block' ) . '>';
			echo '<div class="iconbox-wrap">';
				if($has_icon){ 
					echo '<div class="iconbox-icon">';
						Icons_Manager::render_icon($settings['selected_icon'], [ 'aria-hidden' => 'true' ]); 
					echo '</div>';
				}
				echo '<div class="iconbox-content">';
					if($settings['title_text']){ 
						echo '<h3 class="iconbox-title">' . $settings['title_text'] . '</h3>';
					}
					if($settings['description_text']){ 
						echo '<div class="iconbox-desc">' .$settings['description_text'] . '</div>';
					}
				echo '</div>';	
			echo '</div>';	
		 	$this->gva_render_link_html('', $settings['button_url'], 'iconbox-link-overlay');
		echo '</div>';	
	}
?>