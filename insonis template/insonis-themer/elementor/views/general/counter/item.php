<?php 
	use Elementor\Icons_Manager;
	$has_icon = !empty($item['selected_icon']['value']);
	$style = $settings['style'];
	$active = $item['active']=='yes' ? ' active' : '';
	$header_tag = !empty($settings['title_size']) ? $settings['title_size'] : 'h2';
   $title_html = $item['title_text'];
?>
<?php if($style == 'style-1'){ ?>
   <div class="milestone-one<?php echo esc_attr($active) ?> elementor-repeater-item-<?php echo $item['_id'] ?>">
      <?php 
         if($has_icon){ 
            echo '<div class="milestone-one__icon">';
               echo '<span class="icon">';
                  Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
               echo '</span>';
            echo '</div>';
         } 
      ?>

      <div class="milestone-one__content">
         <div class="milestone-one__number">
            <?php 
               if($item['text_before']){
                  echo ('<span class="symbol before">' . $item['text_before'] . '</span>');
               }
               echo '<span class="milestone-number">' . esc_attr($item['number']) . '</span>';
               if($item['text_after']){
                  echo ('<span class="symbol after">' . $item['text_after'] . '</span>');
               }  
            ?>
         </div>
         <?php 
            if(!empty($title_html)){ 
               echo '<' . esc_attr($header_tag) .' class="milestone-one__title">';
                  echo $title_html;
               echo '</' . esc_attr($header_tag) . '>';
            } 
         ?>
      </div>
      
      <?php $this->gva_render_link_html('', $item['link'], 'milestone-one__link'); ?>

   </div> 
<?php } ?>

<?php if($style == 'style-2'){ ?>
   <div class="milestone-two<?php echo esc_attr($active) ?>">
   	<div class="milestone-two__wrap">
         <?php 
            if($has_icon){ 
               echo '<div class="milestone-two__icon">';
                  echo '<span class="icon">';
                     Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
                  echo '</span>';
               echo '</div>';
            } 
         ?>
         <div class="milestone-two__content">
            <div class="milestone-two__number">
               <?php 
                  if($item['text_before']){
                     echo ('<span class="symbol before">' . $item['text_before'] . '</span>');
                  }
                  echo '<span class="milestone-number">' . esc_attr($item['number']) . '</span>';
                  if($item['text_after']){
                     echo ('<span class="symbol after">' . $item['text_after'] . '</span>');
                  }  
               ?>
            </div>
            <?php 
               if(!empty($title_html)){ 
                  echo '<' . esc_attr($header_tag) .' class="milestone-two__title">';
                     echo $title_html;
                  echo '</' . esc_attr($header_tag) . '>';
               } 
            ?>
         </div>
      </div>
      <?php $this->gva_render_link_html('', $item['link'], 'milestone-two__link'); ?>
   </div> 
<?php } ?>

<?php if($style == 'style-3'){ ?>
   <div class="milestone-three<?php echo esc_attr($active) ?>">
   	<div class="milestone-three__wrap">
         <?php 
            if($has_icon){ 
               echo '<div class="milestone-three__icon">';
                  echo '<span class="icon">';
                     Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
                  echo '</span>';
               echo '</div>';
            } 
         ?>
         <div class="milestone-three__content">
            <?php 
	               if(!empty($title_html)){ 
	                  echo '<' . esc_attr($header_tag) .' class="milestone-three__title">';
	                     echo $title_html;
	                  echo '</' . esc_attr($header_tag) . '>';
	               } 
	            ?>
            <div class="milestone-three__number">
               <?php 
                  if($item['text_before']){
                     echo ('<span class="symbol before">' . $item['text_before'] . '</span>');
                  }
                  echo '<span class="milestone-number">' . esc_attr($item['number']) . '</span>';
                  if($item['text_after']){
                     echo ('<span class="symbol after">' . $item['text_after'] . '</span>');
                  }  
               ?>
            </div>
         </div>
      </div>
      <?php $this->gva_render_link_html('', $item['link'], 'milestone-three__link'); ?>
   </div> 
<?php } ?>