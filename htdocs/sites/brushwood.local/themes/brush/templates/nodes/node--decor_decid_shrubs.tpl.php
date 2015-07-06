<?php
//dsm($content);
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>>
        <a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="posted">
      <?php if ($user_picture): ?>
        <?php print $user_picture; ?>
      <?php endif; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <?php
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);
  hide($content['field_tags']);
  ?>
<div class="row node-shrub-product">

<div class="large-12 columns text-center">
  <?php print render($content['field_catalog']); ?>
</div>


<div class="row">

<div class="large-5 columns shrub-img">
<?php print render($content['product:field_img_list']); ?>

<div class="title-and-price">
<div class="large-6 columns shrub-title"><?php print render($content['product:title']); ?></div>
<div class="large-6 columns shrub-price"><?php print render($content['product:commerce_price']); ?></div>
</div>

</div>

<div class="large-7 columns shrub-variants">
  <?php print render($content['product:sku']); ?>
  <?php print render($content['product:commerce_stock']); ?>
  <?php print render($content['product:field_height']); ?>
  <?php print render($content['product:field_width']); ?>
  <?php print render($content['product:field_root_system']); ?>
  <?php print render($content['field_variants']); ?>
</div>

</div>

<div class="row shrub-body">
  <div class="large-12 columns node-body text-justify"><?php print render($content['body']); ?></div>
</div>

</div>
  
  
  
  
  

  <?php if (!empty($content['field_tags']) && !$is_front): ?>
    <?php print render($content['field_tags']) ?>
  <?php endif; ?>

  <?php print render($content['links']); ?>
  <?php print render($content['comments']); ?>

</article>