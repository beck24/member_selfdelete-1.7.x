<?php

function member_selfdelete_init() {
	global $CONFIG;
	
	// Load the language file
	register_translations($CONFIG->pluginspath . "member_selfdelete/languages/");
	
	elgg_extend_view("profile/menu/linksownpage", "member_selfdelete/post_ownlinks", 1000);
	
	register_page_handler('selfdelete','member_selfdelete_page_handler');
	
	register_action("selfdelete", false, $CONFIG->pluginspath . "member_selfdelete/actions/delete.php", false);
	
	register_elgg_event_handler('pagesetup','system','member_selfdelete_pagesetup');
}


function member_selfdelete_page_handler($page){
  global $CONFIG;

  switch ($page[0]) {
    case "reasons":
      if(!include($CONFIG->pluginspath . "member_selfdelete/pages/reasons.php")){
        return FALSE;
      }
    break;
    
    default:
      if(!include($CONFIG->pluginspath . "member_selfdelete/pages/form.php")){
        return FALSE;
      }  
    break;
  }
  
  return TRUE;
}

function member_selfdelete_pagesetup() {

	if (get_context() == 'admin' && isadminloggedin()) {
		global $CONFIG;
		add_submenu_item(elgg_echo('member_selfdelete:reasons:list'), $CONFIG->wwwroot . 'pg/selfdelete/reasons');
	}
}

register_elgg_event_handler('init','system','member_selfdelete_init');
?>