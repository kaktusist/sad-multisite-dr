<?php
/**
 * @file
 * Fields formatter for the Slick and Field collection integration.
 */

/**
 * Formats Field collection data.
 */
function _slick_fields_format_field_collection(&$settings, $config, $thumb_nav = FALSE) {
  $view_mode   = $settings['view_mode'] ? $settings['view_mode'] : 'full';
  $slick_id    = $settings['attributes']['id'];
  $nested_name = empty($settings['nested_optionset']) ? 'default' : $settings['nested_optionset'];
  $nested_set  = empty($settings['nested_slick']) ? NULL : slick_optionset_load($nested_name);

  $build = $css = $media = array();
  foreach ($config['items'] as $key => $item) {
    $slide = array(
      'item'    => $item,
      'caption' => array(),
      'slide'   => array(),
      'settings' => array(
        'count'        => $settings['count'],
        'image_style'  => $settings['image_style'],
        'has_pattern'  => $settings['has_pattern'],
        'layout'       => $settings['slide_layout'],
        'media_switch' => $settings['media_switch'],
      ),
    );

    // Prepares variables.
    $fc      = field_collection_field_get_entity($item);
    $wrapper = entity_metadata_wrapper('field_collection_item', $fc);
    $view    = $fc->view($view_mode);
    $id      = array_keys($view['field_collection_item']);
    $id      = reset($id);
    $fields  = $view['field_collection_item'][$id];

    // Main background image can be core Image, or File entity, multi or single.
    if (!empty($settings['slide_image']) && $slide_bg = $wrapper->$settings['slide_image']->value()) {
      $file = isset($slide_bg['fid']) ? $slide_bg : (isset($slide_bg[0]) ? $slide_bg[0] : NULL);
      $slide['settings']['type'] = isset($file['type']) ? $file['type'] : '';
      $media = array(
        'scheme' => file_uri_scheme($file['uri']),
        'media_uri' => $file['uri'],
      );

      // It is un-reasonable to make large image as colorbox, so disable it.
      $settings['lightbox_ready'] = FALSE;
      $settings['picture_ready'] = TRUE;
      slick_extract_image_data($media, $file);

      // Thumbnail usages: asNavFor pagers, dot, arrows, photobox thumbnails.
      $thumb = empty($settings['thumbnail_style']) ? array() : slick_get_thumbnail($settings['thumbnail_style'], $media);
      if (!$thumb_nav) {
        // Image with picture, lazyLoad, and lightbox supports.
        $slide['slide'] = array(
          '#theme'    => 'slick_media',
          '#item'     => slick_get_image($settings, $media, $key),
          '#settings' => $slide['settings'],
        );
      }
      else {
        $slide['slide'] = $thumb;
        if (!empty($settings['thumbnail_caption']) && $caption = $wrapper->$settings['thumbnail_caption']->value()) {
          $slide['caption']['data']['#markup'] = isset($caption['safe_value']) ? $caption['safe_value'] : filter_xss($caption['value']);
        }
      }

      // Fullscreen skin needs inline CSS if so configured.
      if ($config['inline_css']) {
        $css = slick_get_inline_css($settings, $slide, $key, $media['uri']);
      }
    }

    // Main slide overlays.
    if (!$thumb_nav) {
      // Nested slicks, or image/video/audio overlays applies to main display.
      // EMW fails to check empty for disabled fields, so use the fields.
      if (!empty($settings['slide_overlay']) && isset($fields[$settings['slide_overlay']])) {
        $slides = $wrapper->$settings['slide_overlay']->value();
        $renderables = $fields[$settings['slide_overlay']];
        $options = array(
          'id'          => $id,
          'key'         => $key,
          'nested_name' => $nested_name,
          'nested_set'  => $nested_set,
          'view_mode'   => $view_mode,
          'fields'      => $fields,
          'langcode'    => $config['langcode'],
          'config'      => $config,
        );

        // Just display un-managed overlays with unknown formatters.
        if (!in_array($renderables['#formatter'], array('image', 'file_rendered')) && !isset($slides[0]->sid)) {
          $elements = $renderables;
        }
        // Otherwise do the hard work.
        else {
          $elements = _slick_fields_fc_build_overlay($settings, $wrapper, $options);
        }
        $slide['caption']['overlay'] = $elements;
      }

      // Title, if so configured, can be plain text, or link field.
      if (!empty($settings['slide_title']) && $slide_title = $wrapper->$settings['slide_title']->value()) {
        $title = '';
        if (isset($slide_title['safe_value'])) {
          $title = $slide_title['safe_value'];
        }
        elseif (isset($slide_title['url'])) {
          $title = $slide_title['title'];
          if ($url = $slide_title['url']) {
            $attributes = $slide_title['attributes'] ? array('attributes' => $slide_title['attributes']) : array();
            $title = l($title, $url, $attributes);
          }
        }
        if ($title) {
          $slide['caption']['title']['#markup'] = $title;
        }
      }

      // Other caption fields, if so configured.
      if (!empty($settings['slide_caption'])) {
        $caption_items = array();
        foreach ($settings['slide_caption'] as $i => $caption_field) {
          if (isset($fields[$caption_field])) {
            $caption_items[$i] = $fields[$caption_field];
          }
        }

        if ($caption_items) {
          $slide['caption']['data'] = $caption_items;
        }
      }

      // Link field if so configured, it is a renderable array.
      if (!empty($settings['slide_link']) && isset($fields[$settings['slide_link']])) {
        $slide['caption']['link'] = $fields[$settings['slide_link']];
      }

      // Layout field as opposed from the builtin layout options.
      if (!empty($settings['slide_layout']) && strpos($settings['slide_layout'], 'field_') !== FALSE) {
        if ($layout = $wrapper->$settings['slide_layout']->value()) {
          $slide['settings']['layout'] = check_plain($layout);
        }
      }

      // Color can be plain text, or color_field.module.
      if (!empty($settings['color_field']) && $colors = $wrapper->$settings['color_field']->value()) {
        $color = is_string($colors) ? $colors : (!empty($colors['rgb']) ? $colors['rgb'] : '');
        if (!empty($color)) {
          // @see http://tympanus.net/Development/CreativeLinkEffects/
          $light = slick_color_brightness($color, 42);
          $hover = slick_color_brightness($color, 62);

          $css[] = "#{$slick_id} .slide--{$key} {color: {$color}}";
          $css[] = "#{$slick_id} .slide--{$key} .slide__title {color: {$color}}";
          $css[] = "#{$slick_id} .slide--{$key} .slide__link a::before, #{$slick_id} .slide--{$key} .slide__link a::after {background-color: {$color}}";

          if ($color != '#fff' || $color != '#ffffff') {
            $css[] = "#{$slick_id} .slide--{$key} .slide__link a {color: {$color}}";
            $css[] = "#{$slick_id} .slide--{$key} .slide__link a:hover {color: {$hover}}";
            $css[] = "#{$slick_id} .slide--{$key} .slide__caption {color: {$light}}";
          }
        }
      }
    }
    $build[$key] = $slide;
  }

  if ($css) {
    $settings['inline_css'] = $css;
  }
  return $build;
}

/**
 * Build the managed overlays: image, video, audio or nested slicks.
 */
function _slick_fields_fc_build_overlay(&$settings, $wrapper, $options = array()) {
  $elements     = array();
  $key          = $options['key'];
  $items        = $wrapper->$settings['slide_overlay']->value();
  $renderables  = $options['fields'][$settings['slide_overlay']];
  $entity_id    = $settings['entity_id'];
  $entity_type  = $renderables['#entity_type'];
  $bundle       = $renderables['#bundle'];
  $field_name   = $renderables['#field_name'];
  $nested_style = !empty($settings['nested_style']) ? $settings['nested_style'] : $settings['image_style'];
  $is_ratio     = !empty($settings['media_switch']) && !empty($settings['aspect_ratio']);
  $slick_id     = &drupal_static('slick_id', 0);
  $css_id       = drupal_clean_css_identifier("slick-{$entity_type}-{$entity_id}-{$bundle}-{$field_name}-" . ++$slick_id);

  $settings['is_media'] = $settings['picture_ready'] = FALSE;

  $overlays = $media = array();
  $overset = array(
    'colorbox_style'  => $settings['colorbox_style'],
    'current_display' => 'overlay',
    'has_pattern'     => $settings['has_pattern'],
    'image_style'     => $nested_style,
    'media_switch'    => $settings['media_switch'],
    'ratio'           => $is_ratio ? $settings['aspect_ratio'] : FALSE,
    'view_mode'       => $options['view_mode'],
  );
  switch ($renderables['#field_type']) {
    case 'image':
    case 'file':
      foreach ($items as $i => $item) {
        slick_extract_image_data($media, $item);

        if ($renderables['#field_type'] == 'file') {
          $file = (object) $item;
          $media['scheme'] = file_uri_scheme($file->uri);
          $media['media_uri'] = $file->uri;
          $media['url'] = slick_get_media_url($overset, $media, $file);

          // Get audio/video thumbnail uri.
          $media_image_uri = slick_get_media_thumbnail($overset, $media);
          if ($media_image_uri) {
            $media['uri'] = $media_image_uri;
          }
        }
        $overlays[$i] = $media + $overset;
      }
      break;

    case 'atom_reference':
      foreach ($items as $i => $item) {
        $sid             = $item->sid;
        $atom            = scald_atom_load($sid);
        $base_id         = $atom->base_id;
        $langcode        = isset($atom->language) ? $atom->language : $options['langcode'];
        $media['scheme'] = $atom->provider;

        $providers = array(
          'scald_youtube',
          'scald_vimeo',
          'scald_dailymotion',
          'video',
        );
        if (in_array($atom->provider, $providers)) {
          // We do have iframe, set it to TRUE.
          $overset['is_media'] = TRUE;
          $overset['media_id'] = $base_id;
          if (strpos($atom->provider, 'scald_') !== FALSE) {
            $media['scheme'] = substr($atom->provider, -6);
          }
        }

        $media['url'] = '';
        switch ($atom->provider) {
          case 'scald_youtube':
            $media['url'] = '//www.youtube.com/embed/' . $base_id;
            break;

          case 'scald_vimeo':
            $media['url'] = '//player.vimeo.com/video/' . $base_id;
            break;

          case 'scald_dailymotion':
            $media['url'] = '//www.dailymotion.com/embed/video/' . $base_id;
            break;

          case 'video':
            $media['url'] = $atom->file_source;
            break;

          default:
            break;
        }

        // Only care for the first item now.
        $properties = array('fid', 'height', 'width', 'alt', 'title', 'type');
        foreach ($properties as $data) {
          $media[$data] = isset($atom->scald_thumbnail[$langcode][0][$data]) ? $atom->scald_thumbnail[$langcode][0][$data] : NULL;
        }

        $media['uri']   = $atom->file_source;
        $media['type']  = $atom->type == 'slick' ? 'image' : $atom->type;
        $media['title'] = $atom->title;
        $overset['sid'] = $sid;

        $overlays[$i] = $media + $overset;
      }
      break;

    default:
      break;
  }

  $slides = $overlays;

  // Build the overlays: single static image/audio/video, or nested slicks.
  // Managed overlays with known formatters are nested slicks, or static.
  if ($slides) {
    $main_settings = $overset + array(
      'count'           => count($slides),
      'lazy'            => $settings['lazy'],
      'lightbox_id'     => $css_id,
      'lightbox_ready'  => $settings['media_switch'] == 'colorbox-switch',
      'optionset'       => $options['nested_name'],
      'picture'         => FALSE,
      'picture_ready'   => FALSE,
      'attributes' => array(
        'id'    => $css_id,
        'class' => array('slick--nested'),
      ),
    );

    // Process individual slick overlay.
    $element = array();
    foreach ($slides as $idx => $media) {
      $main_settings = array_merge($main_settings, $media);
      if (empty($settings['nested_slick'])) {
        $idx = 0;
      }

      // Image with picture, lazyLoad, and lightbox supports.
      $overlay_item[$idx] = slick_get_image($main_settings, $media, $idx);
      $element[$idx]['slide'] = array(
        '#theme'    => 'slick_media',
        '#item'     => $overlay_item[$idx],
        '#settings' => $media,
      );
    }

    // Build the nested slicks.
    if (!empty($settings['nested_slick'])) {
      $attach['attach_media'] = $settings['media_switch'] == 'iframe-switch';
      $elements = slick_build($element, array(), $main_settings, $attach, NULL, $options['nested_set']);
    }
    else {
      // Otherwise cares for a single overlay item to not break small layout.
      $elements = $element[0];
    }
  }
  return $elements;
}
