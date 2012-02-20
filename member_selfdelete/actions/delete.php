<?php

// make sure we're logged in and tokens validate
action_gatekeeper();

// save to session for sticky form
$_SESSION['selfdelete']['confirmation'] = $confirmation = get_input('confirmation');
$_SESSION['selfdelete']['reason'] = $reason = get_input('reason');

// make sure they entered "DELETE" into the confirmation
if(strtolower($confirmation) != strtolower(elgg_echo('member_selfdelete:DELETE'))){
  // not confirmed
  register_error(sprintf(elgg_echo('member_selfdelete:invalid:confirmation'), elgg_echo('member_selfdelete:DELETE')));
  forward(REFERER);
}


if(!empty($reason)){
  // they gave some feedback - log it
  
  $prefix = "Username: " . get_loggedin_user()->username . "<br> Reason for leaving: <br>";
  // annotate the site, set the owner_guid to -9999 
  create_annotation(get_loggedin_user()->site_guid, 'selfdeletefeedback', $prefix.$reason, 'text', -9999, ACCESS_PRIVATE);

  system_message(elgg_echo('member_selfdelete:feedback:thanks'));
}

unset($_SESSION['selfdelete']);

$user = get_loggedin_user();
$user->delete();
system_message(elgg_echo('member_selfdelete:deleted'));

forward();