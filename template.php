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
	// Bootstrap 3.3.5
	drupal_add_js($theme_path . '/js/bootstrap.min.js', array('type' => 'file', 'scope' => 'footer'));
	// Bootstrap 3.3.5
	drupal_add_js($theme_path . '/js/imagesloaded.js', array('type' => 'file', 'scope' => 'footer'));
	// Bootstrap 3.3.5
	drupal_add_js($theme_path . '/js/wow.min.js', array('type' => 'file', 'scope' => 'footer'));
	// Bootstrap 3.3.5
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
		return '<ul class="breadcrumb"><li>' . implode('</li><li>', $variables['breadcrumb']) . '</li></ul>';
	}
}