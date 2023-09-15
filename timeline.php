<?php
include "configuration.php";

if ($isenabled) {
    $getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);

    if ($getdbdata->connect_errno) {
        $response = array(
            'message' => 'Connection to the database failed! Reason: ' . $getdbdata->connect_error
        );
    } else {
        $gethighestpostid = mysqli_query($getdbdata, 'SELECT MAX(ID) AS max FROM `posts`;');
        $fetchstuff = mysqli_fetch_array($gethighestpostid);
        $biggestpostidindb = $fetchstuff['max'];
        $fullarray = array();
            $postid = rand(1, $biggestpostidindb);
            $query = $getdbdata->prepare('SELECT ID, username, AccountID, PhotoDIR, Likes, Comments, posttimestamp, description, views, isvideo, isuploadedbyprivateacc FROM posts WHERE ID = ? LIMIT 1');
            $query->bind_param("s", $postid);
            $query->execute();
            $data = $query->get_result();
            $Islocked = 0;
          $random = rand(1,200);
        $row = $data->fetch_assoc();
        $ID = $row['ID'];
        $PhotoDIR = $row['PhotoDIR'];
		$Likes = $row['Likes'];
        $Comments = $row['Comments'];
		$posttimestamp = $row['posttimestamp'];
		$description = $row['description'];
        $username = $row['username'];
        $pk = $row['AccountID'];
		$views = $row['views'];
        $isvideo = $row['isvideo'];
		$isuploadedbyprivateacc = $row['isuploadedbyprivateacc'];
        $itemsarraybro = array(
                'taken_at' => $posttimestamp,
                'pk' => $pk,
                'id' => $ID + $random,
                'device_timestamp' => 1664003125404877,
                'media_type' => 1,
                'code' => 'Ci4WVskjZt9',
                'client_cache_key' => 'MjkzNDE5MzQwNTIyMjAzNDMwMQ==.2',
                'filter_type' => 24,
                'is_unified_video' => false,
                'should_request_ads' => false,
                'original_media_has_visual_reply_media' => false,
                'caption_is_edited' => false,
                'like_and_view_counts_disabled' => false,
                'commerciality_status' => 'not_commercial',
                'is_paid_partnership' => false,
                'is_visual_reply_commenter_notice_enabled' => false,
                'clips_tab_pinned_user_ids' => 
                array (
                ),
                'has_delayed_metadata' => false,
                'comment_likes_enabled' => false,
                'comment_threading_enabled' => false,
                'max_num_visible_preview_comments' => 2,
                'has_more_comments' => false,
                'preview_comments' => 
                array (
                ),
                'comments' => 
                array ( 
                ),
                'comment_count' => 0,
                'photo_of_you' => false,
                'is_organic_product_tagging_eligible' => false,
                'can_see_insights_as_brand' => false,
                'user' => 
                array (
                  'pk' => $pk,
                  'username' => $username,
                  'is_verified' => false,
                  'profile_pic_id' => '2577010241112975910_47422889959',
                  'profile_pic_url' => 'http://192.168.2.202/ign/Icon.png',
                  'pk_id' => $pk,
                  'full_name' => $username,
                  'is_private' => false,
                  'account_badges' => 
                  array (
                  ),
                  'has_anonymous_profile_picture' => false,
                  'fan_club_info' => 
                  array (
                    'fan_club_id' => NULL,
                    'fan_club_name' => NULL,
                    'is_fan_club_referral_eligible' => NULL,
                    'fan_consideration_page_revamp_eligiblity' => NULL,
                    'is_fan_club_gifting_eligible' => NULL,
                  ),
                  'transparency_product_enabled' => false,
                  'is_unpublished' => false,
                ),
                'can_viewer_reshare' => true,
                'like_count' => $Likes,
                'has_liked' => false,
                'top_likers' => 
                array (
                ),
                'facepile_top_likers' => 
                array (
                ),
                'likers' => 
                array (
                ),
                'image_versions' => 
                array (
                  0 => 
                  array (
                    'type' => 7,
                    'width' => 640,
                    'height' => 640,
                    'url' => $baseurl . $PhotoDIR,
                    'scans_profile' => '',
                  ),
                  1 => 
                  array (
                    'type' => 6,
                    'width' => 320,
                    'height' => 320,
                    'url' => $baseurl . $PhotoDIR,
                    'scans_profile' => '',
                  ),
                  2 => 
                  array (
                    'type' => 5,
                    'width' => 150,
                    'height' => 150,
                    'url' => $baseurl . $PhotoDIR,
                    'scans_profile' => '',
                  ),
                ),
                'caption' => 
                array (
                  'pk' => $pk,
                  'user_id' => 47422889959,
                  'text' => $description . " PostID: " . $postid,
                  'type' => 1,
                  'created_at' => 1664003134,
                  'created_at_utc' => 1664003134,
                  'content_type' => 'comment',
                  'status' => 'Active',
                  'bit_flags' => 0,
                  'did_report_as_spam' => false,
                  'share_enabled' => false,
                  'user' => 
                  array (
                    'pk' => $pk,
                    'username' => $username,
                    'is_verified' => false,
                    'profile_pic_id' => '2577010241112975910_47422889959',
                    'profile_pic_url' => 'http://192.168.2.202/ign/Icon.png',
                    'fbid_v2' => '17841447338787861',
                    'pk_id' => '47422889959',
                    'full_name' => $username,
                    'is_private' => false,
                  ),
                  'is_covered' => false,
                  'is_ranked_comment' => false,
                  'media_id' => 2934193405222034301,
                  'private_reply_status' => 0,
                ),
                'comment_inform_treatment' => 
                array (
                  'should_have_inform_treatment' => false,
                  'text' => '',
                  'url' => NULL,
                  'action_type' => NULL,
                ),
                'sharing_friction_info' => 
                array (
                  'should_have_sharing_friction' => false,
                  'bloks_app_url' => NULL,
                  'sharing_friction_payload' => NULL,
                ),
                'is_in_profile_grid' => false,
                'profile_grid_control_enabled' => false,
                'organic_tracking_token' => 'eyJ2ZXJzaW9uIjo1LCJwYXlsb2FkIjp7ImlzX2FuYWx5dGljc190cmFja2VkIjpmYWxzZSwidXVpZCI6ImMzOTQ3ODE5ODljZTRiZTdiZjZmYThmOGQ4YzQ2ZjFiMjkzNDE5MzQwNTIyMjAzNDMwMSJ9LCJzaWduYXR1cmUiOiIifQ==',
                'has_shared_to_fb' => 0,
                'product_type' => 'feed',
                'deleted_reason' => 0,
                'integrity_review_decision' => 'pending',
                'commerce_integrity_review_decision' => NULL,
                'music_metadata' => NULL,
                'is_artist_pick' => false,
                'can_view_more_preview_comments' => false,
                'hide_view_all_comment_entrypoint' => false,
                'inline_composer_display_condition' => 'impression_trigger',
        );

                $fullarray[] = $itemsarraybro;
        }

        $response = array(
            'items' => $fullarray,
            'num_results' => 1,
            'more_available' => true,
            'user' => array(
              'pk' => $ID,
              'username' => $username,
              'is_verified' => false,
              'profile_pic_id' => '2577010241112975910_47422889959',
              'profile_pic_url' => 'http://192.168.2.202/ign/Icon.png',
              'pk_id' => '47422889959',
              'full_name' => $username,
              'is_private' => false,
              'profile_grid_display_type' => 'default',
          ),
            'auto_load_more_enabled' => true,
            'status' => 'ok',
        );

        die(json_encode($response));
    } //speed improvement is required!!!
