<div>
<?php if(isset($fields['field_link']) && !empty($fields['field_link']->content)): ?>
	<div class="slider-link-title show-for-medium-up wow rubberBand" data-wow-delay="0.3s">
	<?php print $fields['field_link']->content ?></div><?php endif; ?>
<?php if(isset($fields['field_description']) && !empty($fields['field_description']->content)): ?>
	<div class="slider-description show-for-medium-up"><?php print $fields['field_description']->content ?></div><?php endif; ?>
<?php print $fields['field_img_slider_rotator']->content ?>
</div>