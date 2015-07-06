<?php if (!empty($slideshow)): ?>
  <div class="skin-brushwood">

    <?php print $slideshow; ?>

    <?php if (!empty($bottom_widget_rendered)): ?>
      <div class="views-slideshow-controls-bottom clearfix show-for-medium-up">
        <?php print $bottom_widget_rendered; ?>
      </div>
    <?php endif; ?>
    <div class="clearfix"></div>
  </div>
<?php endif; ?>