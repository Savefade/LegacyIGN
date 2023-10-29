<?php
include "configuration.php";
if($isenabled){
  $getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);
  $AccountID = $_COOKIE["ds_user_id"];
  $getaccountdata = $getdbdata->prepare('SELECT ID, username, sessionid, fullname, isaccountprivate, website, biography, isverified FROM accounts WHERE ID = ?;');
  $getaccountdata->bind_param("s", $AccountID);
  $getaccountdata->execute();
  $getaccountdata = $getaccountdata->get_result();
  $getaccountdata = $getaccountdata->fetch_assoc();
  $sessionid = $getaccountdata['sessionid'];
  $username = $getaccountdata['username'];
  $fullname = $getaccountdata['fullname'];
  $id = $getaccountdata['ID'];
  $isprivate = $getaccountdata['isaccountprivate'];
  $isverified = $getaccountdata['isverified'];
  $website = $getaccountdata['website'];
  $bio = $getaccountdata['biography'];
  $pfpURL = "pfps/" . $username . ".png";
  if(file_exists($pfpURL)){
    $pfpURL = $baseurl . "/pfps/" . $username . ".png";
  }
  else{$pfpURL = $baseurl . "/ign/Icon.png";}
  if($isprivate == 1){
  $isprivate = true;
  }
  else{
    $isprivate = false;
  }
  if($isverified == 1){
    $isverified = true;
    }
    else{
      $isverified = false;
    }
  if($_COOKIE['sessionid'] != $sessionid){
  exit;
  }
    die(json_encode(array (
        'user' => 
        array (
          'biography' => $bio,
          'primary_profile_link_type' => 0, //verified
          'show_fb_link_on_profile' => false,
          'show_fb_page_link_on_profile' => false,
          'can_hide_category' => true,
          'smb_support_partner' => NULL,
          'can_add_fb_group_link_on_profile' => false,
          'is_quiet_mode_enabled' => false,
          'last_seen_timezone' => '',
          'account_category' => '',
          'allowed_commenter_type' => 'any',
          'fbid_v2' => '0',
          'full_name' => $fullname,
          'gender' => 3,
          'is_hide_more_comment_enabled' => false,
          'is_muted_words_custom_enabled' => false,
          'is_muted_words_global_enabled' => false,
          'is_muted_words_spamscam_enabled' => false,
          'is_private' => $isprivate,
          'has_nme_badge' => false,
          'pk' => $id,
          'pk_id' => $id,
          'reel_auto_archive' => 'on',
          'show_ig_app_switcher_badge' => true,
          'strong_id__' => $id,
          'external_url' => $website, //website
          'category' => NULL,
          'is_category_tappable' => false,
          'is_business' => false,
          'professional_conversion_suggested_account_type' => 2,
          'account_type' => 1,
          'displayed_action_button_partner' => NULL,
          'smb_delivery_partner' => NULL,
          'smb_support_delivery_partner' => NULL,
          'displayed_action_button_type' => NULL,
          'is_call_to_action_enabled' => NULL,
          'num_of_admined_pages' => NULL,
          'page_id' => NULL,
          'page_name' => NULL,
          'ads_page_id' => NULL,
          'ads_page_name' => NULL,
          'bio_links' => 
          array (
          ),
          'account_badges' => 
          array (
          ),
          'all_media_count' => 0,
          //'birthday' => '0000-01-01',
          'birthday_today_visibility_for_viewer' => 'NOT_VISIBLE',
          'email' => 'jon@doe.cs',
          'has_anonymous_profile_picture' => false,
          'hd_profile_pic_url_info' => 
          array (
            'url' => '',
            'width' => 1080,
            'height' => 1080,
          ),
          'hd_profile_pic_versions' => 
          array (
            0 => 
            array (
              'width' => 320,
              'height' => 320,
              'url' => $pfpURL,
            ),
            1 => 
            array (
              'width' => 640,
              'height' => 640,
              'url' => $pfpURL,
            ),
          ),
          'interop_messaging_user_fbid' => 17846310074577960,
          'is_mv4b_biz_asset_profile_locked' => false,
          'has_legacy_bb_pending_profile_picture_update' => false,
          'is_showing_birthday_selfie' => false,
          'is_supervision_features_enabled' => false,
          'is_verified' => $isverified, //
          'liked_clips_count' => 0,
          'has_active_mv4b_application' => false,
          'phone_number' => '',
          'profile_pic_id' => '1',
          'profile_pic_url' => $pfpURL,
          'profile_edit_params' => 
          array (
            'username' => 
            array (
              'should_show_confirmation_dialog' => false,
              'is_pending_review' => false,
              'confirmation_dialog_text' => 'Because your account reaches a lot of people, your username change may need to be reviewed. If so, you\'ll be notified when we\'ve reviewed it. If not, your username will change immediately.',
              'disclaimer_text' => '',
            ),
            'full_name' => 
            array (
              'should_show_confirmation_dialog' => false,
              'is_pending_review' => false,
              'confirmation_dialog_text' => 'Because your account is verified, your name change may need to be reviewed. If so, you\'ll be notified when we\'ve reviewed it. If not, your name will change immediately.',
              'disclaimer_text' => '',
            ),
          ),
          'show_conversion_edit_entry' => false,
          'show_together_pog' => false,
          'trusted_username' => $username,
          'trust_days' => 0,
          'username' => $username,
        ),
        'status' => 'ok',
      )));
}