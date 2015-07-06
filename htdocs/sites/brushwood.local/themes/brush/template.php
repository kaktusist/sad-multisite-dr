<?php

/**
 * Implements template_preprocess_html().
 */
function brush_preprocess_html(&$variables) {
}

/**
 * Implements template_preprocess_page.
 */
function brush_preprocess_page(&$variables) {
	if (drupal_is_front_page()) {
    unset($variables['page']['content']['system_main']['default_message']); //will remove message "no front page content is created"
    drupal_set_title(''); //removes welcome message (page title)
  }
}

/**
 * Implements template_preprocess_node.
 */
function brush_preprocess_node(&$variables) {
}

/**
 * Implements template_form_alter.
 */
function brush_form_alter(&$form, &$form_state, $form_id) {
  if (strstr($form_id, 'commerce_cart_add_to_cart_form') || ($form_id == 'views_form_commerce_cart_form_default')) {
    drupal_add_library('system', 'ui.spinner');
    $form['#attached']['js'] = array(
      drupal_get_path('theme', 'brush') . '/js/commerce_spinner.js',
    );
  }
}

/**
 * Implements hook_preprocess_button().
 */
function brush_preprocess_button(&$variables) {
  $variables['element']['#attributes']['class'][] = 'button';
  if (isset($variables['element']['#parents'][0]) && $variables['element']['#parents'][0] == 'submit') {
    $variables['element']['#attributes']['class'][] = 'success radius button-add-cart';
  }
}

//function brush_form_commerce_cart_add_to_cart_form_alter(&$form, &$form_state) {
    //$form['#attributes']['id'] []=  'myid';
   // $form['#attributes']['data-reveal'] = NULL;
   // $form['actions']['submit']['#attributes']['class'] []= 'success';
  //  $form['actions']['submit']['#attributes']['class'] []=  'button';
  //  $form['actions']['submit']['#attributes']['class'] []=  'radius';
   // $form['actions']['submit']['#attributes']['class'] []=  'expand';
//}