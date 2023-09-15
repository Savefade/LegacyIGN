<?php
include "configuration.php";
if($isenabled){
$id = $_GET['id'];
$getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);
$query = $getdbdata->prepare('SELECT ID, username, uniquetoken, device_id, isaccountprivate, isverified, followercount, followingcount, photocount, pfpURL, fullname FROM accounts WHERE ID = ? LIMIT 1');
$query->bind_param('s', $id);
$query->execute();
if($getdbdata->connect_errno){

}else{
$data = $query->get_result();
$query->close();
if($data->num_rows === 1){
    $fetchstuff = $data->fetch_assoc();
    $ID = $fetchstuff["ID"];
    $username = $fetchstuff["username"];
    $uniquetoken = $fetchstuff["uniquetoken"];
    $device_id = $fetchstuff["device_id"];
    $isverified = $fetchstuff["isverified"];
    $isaccountprivate = $fetchstuff["isaccountprivate"];
    $followers = $fetchstuff["followercount"];
    $following = $fetchstuff["followingcount"];
    $photocount = $fetchstuff["photocount"];
    $pfpURL = $fetchstuff["pfpURL"];
    $isprivate = false;
    $verified = true;
    if($pfpURL == null){
        $pfpURL = "/ign/icon.png";
    }
    if($isverified == 1){
        $verified = true;
    }
    if($isaccountprivate == 1){
        $isprivate = true;
    }
    $response = array (
        'user' => 
        array (
          'pk' => $ID,
          'username' => $username,
          'follow_friction_type' => 0,
          'is_verified' => $verified ,
          'profile_pic_id' => '2577010241112975910_47422889959',
          'profile_pic_url' => $baseurl . $pfpURL,
          'full_name' => $username,
          'pk_id' => $ID,
          'is_private' => $isprivate,
          'account_badges' => 
          array (
          ),
          'has_anonymous_profile_picture' => false,
          'is_supervision_features_enabled' => false,
          'follower_count' => $followers,
          'media_count' => $photocount,
          'following_count' => $following,
          'following_tag_count' => 0,
          'geo_media_count' => 0,
          'can_use_affiliate_partnership_messaging_as_creator' => false,
          'can_use_affiliate_partnership_messaging_as_brand' => false,
          'has_private_collections' => false,
          'all_media_count' => 10,
          'has_music_on_profile' => false,
          'is_direct_roll_call_enabled' => false,
          'liked_clips_count' => 0,
          'is_potential_business' => false,
          'fan_club_info' => 
          array (
            'fan_club_id' => NULL,
            'fan_club_name' => NULL,
            'is_fan_club_referral_eligible' => NULL,
            'fan_consideration_page_revamp_eligiblity' => NULL,
            'is_fan_club_gifting_eligible' => NULL,
          ),
          'is_muted_words_global_enabled' => false,
          'is_muted_words_custom_enabled' => false,
          'is_muted_words_spamscam_enabled' => false,
          'fbid_v2' => '17841447338787861',
          'whatsapp_number' => '',
          'is_whatsapp_linked' => false,
          'transparency_product_enabled' => false,
          'is_hide_more_comment_enabled' => false,
          'is_quiet_mode_enabled' => false,
          'last_seen_timezone' => '',
          'allow_tag_setting' => 'everyone',
          'allow_mention_setting' => 'everyone',
          'interop_messaging_user_fbid' => 17846310074577960,
          'bio_links' => 
          array (
          ),
          'can_add_fb_group_link_on_profile' => false,
          'can_follow_hashtag' => false,
          'show_insights_terms' => false,
          'external_url' => '',
          'can_tag_products_from_merchants' => false,
          'eligible_shopping_signup_entrypoints' => 
          array (
          ),
          'is_igd_product_picker_enabled' => false,
          'is_eligible_for_affiliate_shop_onboarding' => false,
          'eligible_shopping_formats' => 
          array (
          ),
          'needs_to_accept_shopping_seller_onboarding_terms' => false,
          'is_shopping_settings_enabled' => false,
          'is_shopping_community_content_enabled' => false,
          'is_shopping_auto_highlight_eligible' => false,
          'is_shopping_catalog_source_selection_enabled' => false,
          'is_eligible_to_show_fb_cross_sharing_nux' => true,
          'has_guides' => false,
          'has_highlight_reels' => false,
          'allowed_commenter_type' => 'any',
          'aggregate_promote_engagement' => true,
          'show_conversion_edit_entry' => false,
          'fbpay_experience_enabled' => false,
          'has_placed_orders' => false,
          'hd_profile_pic_url_info' => 
          array (
            'url' => $baseurl . $pfpURL,
            'width' => 1080,
            'height' => 1080,
          ),
          'hd_profile_pic_versions' => 
          array (
            0 => 
            array (
              'width' => 320,
              'height' => 320,
              'url' => $baseurl . $pfpURL,
            ),
            1 => 
            array (
              'width' => 640,
              'height' => 640,
              'url' => $baseurl . $pfpURL,
            ),
          ),
          'is_interest_account' => false,
          'is_needy' => true,
          'usertags_count' => 0,
          'usertag_review_enabled' => false,
          'is_profile_action_needed' => false,
          'reel_auto_archive' => 'on',
          'total_ar_effects' => 0,
          'has_saved_items' => false,
          'total_clips_count' => 0,
          'has_videos' => false,
          'total_igtv_videos' => 0,
          'can_see_support_inbox_v1' => true,
          'can_boost_post' => false,
          'can_see_support_inbox' => false,
          'can_be_tagged_as_sponsor' => false,
          'is_allowed_to_create_standalone_nonprofit_fundraisers' => true,
          'is_allowed_to_create_standalone_personal_fundraisers' => false,
          'can_create_new_standalone_fundraiser' => true,
          'can_create_new_standalone_personal_fundraiser' => true,
          'biography' => 'Bios are not currently supported!',
          'include_direct_blacklist_status' => true,
          'show_fb_link_on_profile' => false,
          'primary_profile_link_type' => 0,
          'can_create_sponsor_tags' => false,
          'can_convert_to_business' => false,
          'can_see_organic_insights' => false,
          'is_business' => false,
          'professional_conversion_suggested_account_type' => 2,
          'account_type' => 1,
          'is_category_tappable' => false,
          'current_catalog_id' => NULL,
          'mini_shop_seller_onboarding_status' => NULL,
          'shopping_post_onboard_nux_type' => NULL,
          'ads_incentive_expiration_date' => NULL,
          'page_id_for_new_suma_biz_account' => NULL,
          'displayed_action_button_partner' => NULL,
          'smb_delivery_partner' => NULL,
          'smb_support_delivery_partner' => NULL,
          'displayed_action_button_type' => NULL,
          'smb_support_partner' => NULL,
          'is_call_to_action_enabled' => NULL,
          'num_of_admined_pages' => NULL,
          'request_contact_enabled' => false,
          'robi_feedback_source' => NULL,
          'is_memorialized' => false,
          'open_external_url_with_in_app_browser' => true,
          'has_exclusive_feed_content' => false,
          'has_fan_club_subscriptions' => false,
          'pinned_channels_info' => 
          array (
            'pinned_channels_list' => 
            array (
            ),
            'has_public_channels' => false,
          ),
          'besties_count' => 0,
          'show_besties_badge' => true,
          'recently_bestied_by_count' => 0,
          'nametag' => NULL,
          'about_your_account_bloks_entrypoint_enabled' => false,
          'auto_expanding_chaining' => false,
          'existing_user_age_collection_enabled' => true,
          'show_post_insights_entry_point' => true,
          'has_public_tab_threads' => true,
          'feed_post_reshare_disabled' => false,
          'auto_expand_chaining' => false,
          'is_new_to_instagram' => false,
          'highlight_reshare_disabled' => false,
        ),
        'status' => 'ok',
    );
    echo(json_encode($response));
}
else{
    die(json_encode(array(
        'message' => "User not found!",
        'status' => "fail",
        'error_type' => "error"
    )));
}
}
}