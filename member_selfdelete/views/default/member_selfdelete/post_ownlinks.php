<?php

	/**
	 * Elgg profile icon hover over: actions
	 * 
	 * @package ElggProfile
	 * 
	 * @uses $vars['entity'] The user entity. If none specified, the current user is assumed.
	 * 
	 *  editted for extendafriend
	 *  uses the guid of each user to generate unique ids for the form popup
	 */

	if (isloggedin() && strpos($_SERVER['REQUEST_URI'], "pg/profile/")) {
		if ($_SESSION['user']->getGUID() == $vars['entity']->getGUID()) {
		  global $CONFIG;

			echo "<p class=\"user_menu_selfdelete\"><a href=\"{$CONFIG->url}pg/selfdelete\">" . elgg_echo('member_selfdelete:account:delete') . "</a></p>";
		
		}
	}
?>