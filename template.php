<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
**/

function letzoutsource_preprocess_page(&$vars, $hook) {
  global $user;
  global $base_url;

  $vars['front_page'] = $base_url;
  $theme_path = drupal_get_path('theme', 'letzoutsource');

	// jQuery 2.2.3
	drupal_add_js($theme_path . '/js/jquery-1.10.2.min.js', array('type' => 'file', 'scope' => 'footer'));
	// bootstrap 3.3.5
	drupal_add_js($theme_path . '/js/bootstrap.min.js', array('type' => 'file', 'scope' => 'footer'));
	// Bootstrap 3.3.5
	drupal_add_js($theme_path . '/js/jquery.nicescroll.min.js', array('type' => 'file', 'scope' => 'footer'));
	// imagesloaded
	drupal_add_js($theme_path . '/js/imagesloaded.js', array('type' => 'file', 'scope' => 'footer'));
	// wow js
	drupal_add_js($theme_path . '/js/wow.min.js', array('type' => 'file', 'scope' => 'footer'));
	// custom js
	drupal_add_js($theme_path . '/js/main.js', array('type' => 'file', 'scope' => 'footer'));
}

function letzoutsource_menu_tree($variables) {
	return '<ul class="nav navbar-nav navbar-right">' . $variables['tree'] . '</ul>';
}

function letzoutsource_menu_link(array $variables) {
	$element = $variables['element'];
	$sub_menu = '';

	if ($element['#below']) {
		// Prevent dropdown functions from being added to management menu as to not affect navbar module.
		if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
			$sub_menu = drupal_render($element['#below']);
		}
		else {
			// Add our own wrapper
			unset($element['#below']['#theme_wrappers']);
			$sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
			$element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
			$element['#localized_options']['attributes']['data-toggle'] = 'dropdown';

			// Check if this element is nested within another
			if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) {
			// Generate as dropdown submenu
			$element['#attributes']['class'][] = 'dropdown-submenu';
			}
			else {
			// Generate as standard dropdown
			$element['#attributes']['class'][] = 'dropdown';
			$element['#localized_options']['html'] = TRUE;
			$element['#title'] .= ' <i class="fa fa-angle-down"></i>';
			}

			// Set dropdown trigger element to # to prevent inadvertant page loading with submenu click
			$element['#localized_options']['attributes']['data-target'] = '#';
		}
	}
	// Issue #1896674 - On primary navigation menu, class 'active' is not set on active menu item.
	// @see http://drupal.org/node/1896674
	if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']) || $element['#localized_options']['language']->language == $language_url->language)) {
		$element['#attributes']['class'][] = 'active';
	}
	$output = l($element['#title'], $element['#href'], $element['#localized_options']);
	return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/*---------------------------------------------------------------------------------------
                    Breadcrumb
-----------------------------------------------------------------------------------------*/

function letzoutsource_breadcrumb($variables) {
	if (count($variables['breadcrumb']) > 0) { 
		$title = drupal_get_title();
		return '<ol class="breadcrumb"><li>' . implode('</li><li>', $variables['breadcrumb']) . '</li><li>'.$title.'</li></ol>';
	}
}

/*---------------------------------------------------------------------------------------
                    Implement theme button
-----------------------------------------------------------------------------------------*/
 
function letzoutsource_button($variables) {
	$element = $variables['element'];
	$element['#attributes']['type'] = 'submit';
	element_set_attributes($element, array('id', 'name', 'value'));

	$element['#attributes']['class'][] = 'form-' . $element['#button_type'];
	$element['#attributes']['class'][] = 'btn btn-primary';

	if (!empty($element['#attributes']['disabled'])) {
		$element['#attributes']['class'][] = 'form-button-disabled';
	}

	return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/*---------------------------------------------------------------------------------------
                    Implement theme_textfield()
-----------------------------------------------------------------------------------------*/ 

function letzoutsource_textfield($variables) {
	$element = $variables['element'];
	$element['#attributes']['type'] = 'text';
	element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
	_form_set_class($element, array('form-text', 'form-control'));

	$extra = '';
	if ($element['#autocomplete_path'] && !empty($element['#autocomplete_input'])) {
		drupal_add_library('system', 'drupal.autocomplete');
		$element['#attributes']['class'][] = 'form-autocomplete';

		$attributes = array();
		$attributes['type'] = 'hidden';
		$attributes['id'] = $element['#autocomplete_input']['#id'];
		$attributes['value'] = $element['#autocomplete_input']['#url_value'];
		$attributes['disabled'] = 'disabled';
		$attributes['class'][] = 'autocomplete';
		$extra = '<input' . drupal_attributes($attributes) . ' />';
	}

	$output = '<input' . drupal_attributes($element['#attributes']) . ' />';

	return $output . $extra;
}

/*---------------------------------------------------------------------------------------
                    Implement theme_password()
-----------------------------------------------------------------------------------------*/ 

function letzoutsource_password($variables) {
	$element = $variables['element'];
	$element['#attributes']['type'] = 'password';
	element_set_attributes($element, array('id', 'name', 'size', 'maxlength'));
	_form_set_class($element, array('form-text', 'form-control'));

	return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/*---------------------------------------------------------------------------------------
                    Custom User Login
-----------------------------------------------------------------------------------------*/ 

function letzoutsource_theme() {
	$items = array();

	$items['user_login'] = array(
		'render element' => 'form',
		'path' => drupal_get_path('theme', 'letzoutsource') . '/templates',
		'template' => 'user-login',
		'attribute' => 'button',
		'preprocess functions' => array(
			'ddcenter_preprocess_user_login'
		),
	);
	$items['user_register_form'] = array(
		'render element' => 'form',
		'path' => drupal_get_path('theme', 'letzoutsource') . '/templates',
		'template' => 'user-register-form',
		'preprocess functions' => array(
			'ddcenter_preprocess_user_register_form'
		),
	);
	$items['user_pass'] = array(
		'render element' => 'form',
		'path' => drupal_get_path('theme', 'letzoutsource') . '/templates',
		'template' => 'user-pass',
		'preprocess functions' => array(
			'ddcenter_preprocess_user_pass'
		),
	);
	return $items;
}

/*---------------------------------------------------------------------------------------
                    Implement theme_status_messages()
-----------------------------------------------------------------------------------------*/ 

function letzoutsource_status_messages($variables) {
	$display = $variables['display'];
	$output = '';

	$status_heading = array(
		'status' => t('Status message'),
		'error' => t('Error message'),
		'warning' => t('Warning message'),
	);

	foreach (drupal_get_messages($display) as $type => $messages) {
		switch ($type) {
			case 'error':
				$class = 'alert alert-danger alert-dismissible';
				$icon = '<i class="icon fa fa-ban"></i>';
			break;
			case 'status':
				$class = 'alert alert-success alert-dismissible';
				$icon = '<i class="icon fa fa-check"></i>';
			break;
			case 'warning':
				$class = 'alert alert-warning alert-dismissible';
				$icon = '<i class="icon fa fa-warning"></i>';
			break;
			default:
			break;
		}

		$output .= "<div class='box-body'>";
		$output .= "<div class=\"$class\">\n";
		if (!empty($status_heading[$type])) {
			$output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
			$output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
			//$output .= '<h4>' . $icon . ' ' . $status . '</h4>';
		}
		if (count($messages) > 1) {
			$output .= " <div>\n";
			foreach ($messages as $message) {
				$output .= '  <span>' . $icon . ' ' . $message . "</span>\n";
			}
			$output .= " </div>\n";
		}
		else {
			$output .= $icon;
			$output .= reset($messages);
		}
		$output .= "</div>";
		$output .= "</div>\n";
	}
	return $output;
}

/*---------------------------------------------------------------------------------------
                    Removes the ugly .panels-separator
-----------------------------------------------------------------------------------------*/ 

function letzoutsource_panels_default_style_render_region($variables) {
	$output = '';
	$output .= implode('', $variables['panes']);
	return $output;
}