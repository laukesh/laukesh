<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/            
$general_settings = $this->config->item('general_settings');
$routes = $this->config->item('routes');
$route['default_controller'] = 'home_controller';
$route['photo-list'] = 'home_controller/photo_list';
$route['captcha-cron'] = 'home_controller/captcha_cron';
$route['screen-header-access'] = 'home_controller/screen_reader_access';
$route['photo-list-image/(:num)'] = 'home_controller/image/$1';
$route['video-list'] = 'home_controller/video_list';
$route['video-list/(:num)'] = 'home_controller/video_file_download';
$route['latest-sainik-samachar'] = 'home_controller/latest_samachar';
$route['latest-sainik-samachar/(:num)'] = 'home_controller/latest_samachar/$1';
$route['latest-sainik-samachar-pdf/(:num)'] = 'home_controller/pdf/$1';
$route['media-invite-detail/(:num)'] = 'home_controller/media_invite_detail/$1';



$route['photos-list'] = 'home_controller/photos_list_whats_new';
$route['media-invite-list'] = 'home_controller/media_invite_list';
$route['media-invite-archive'] = 'home_controller/media_invite_archive';

$route['circular-list'] = 'home_controller/circular_list';
$route['circular-list/(:num)'] = 'home_controller/circular_pdf/$1';
$route['circular-archive-list'] = 'home_controller/circular_archive_list';

$route['archive-list']     = 'home_controller/archive_list';
$route['whats-new']        = 'home_controller/whats_new';
$route['feedback']         = 'home_controller/feedback';
$route['feedback_post']         = 'home_controller/feedback_post';
//$route['captcha2']         = 'captcha2';


$route['videos-list'] = 'home_controller/videos_list_whats_new';
$route['audio-list'] = 'home_controller/audio_list';
$route['audio-list/(:num)'] = 'home_controller/audio_file_download/$1';
$route['audios-list'] = 'home_controller/audios_list_whats_new';
$route['infographics-list'] = 'home_controller/infographics_list';
$route['infographic-list'] = 'home_controller/infographics_list_whats_new';
$route['infographics-list/(:num)'] = 'home_controller/infographics_details/$1';

$route['infographics-listing/(:num)'] = 'home_controller/infographic_image/$1';

//$route['photo-list/(:num)'] = 'home_controller/photo_list';
$route['press-realease-details/(:num)'] = 'home_controller/press_release_details/$1';
$route['press-realease-list'] = 'home_controller/press_realease_list';
/*$route['press-realease-list/(:num)/(:any)'] = 'home_controller/press_realease_list/$1/$1';*/
$route['press-realease-list/(:num)'] = 'home_controller/press_realease_list/$1';
$route['previous-editions'] = 'home_controller/previous_editions_list';
$route['latest-sainik-samachars/(:num)'] = 'home_controller/last_24_editions_list/$1';

$route['404_override'] = 'home_controller/error_404';
$route['translate_uri_dashes'] = FALSE;
$route['index'] = 'home_controller/index';
$route['error-404'] = 'home_controller/error_404';

$route[$routes->latest_press_release_api]['post'] = 'api_controller';
$route[$routes->latest_press_release_detail_api]['post'] = 'api_controller/latest_press_release_detail';
$route[$routes->latest_pro_categories_api]['post'] = 'api_controller/latest_pro_categories';
$route[$routes->latest_photo_categories_api]['post'] = 'api_controller/latest_photo_galleries';
$route[$routes->gallery_api]['post'] = 'api_controller/gallery';

$route[$routes->latest_video_categories_api]['post'] = 'api_controller/latest_video_galleries';
$route[$routes->video_api]['post'] = 'api_controller/video';

$route[$routes->latest_audio_categories_api]['post'] = 'api_controller/latest_audio_categories';
$route[$routes->audio_api]['post'] = 'api_controller/audio';

$route[$routes->latest_infographics_categories_api]['post'] = 'api_controller/latest_infographics_categories';
$route[$routes->infographics_api]['post'] = 'api_controller/infographics';

$route[$routes->latest_sainik_samachar_api]['post'] = 'api_controller/latest_sainik_samachar_list';

$route[$routes->latest_sainik_samachar_details_api]['post'] = 'api_controller/latest_sainik_samachar_details';

$route[$routes->latest_media_invites_api]['post'] = 'api_controller/latest_media_invites_list';

$route[$routes->latest_media_invite_details_api]['post'] = 'api_controller/latest_media_invites_details';

$route[$routes->language_master_api]['post'] = 'api_controller/language_master';
$route[$routes->app_user_details_api]['post'] = 'api_controller/app_user_details';
$route[$routes->update_app_user_details_api]['post'] = 'api_controller/update_app_user_details';
$route[$routes->get_content_page_list_api]['post'] = 'api_controller/get_content_page_list';

$route[$routes->get_circular_notifications_list_api]['post'] = 'api_controller/latest_circular_notifications_list';
$route[$routes->app_login_by_email_api]['post'] = 'api_controller/app_login_by_email';

$route[$routes->dashboard_first_api]['post'] = 'api_controller/dashboard_first';

$route[$routes->reset_password_api]['post'] = 'api_controller/reset_password_by_email';

$route[$routes->change_password_api]['post'] = 'api_controller/change_password_by_email';

$route[$routes->update_profile_api]['post'] = 'api_controller/edit_profile_by_email';
$route[$routes->get_app_version_api]['get'] = 'api_controller/get_app_version';

//$route[$routes->latest_sainik_samachar_details_api]['post'] = 'api_controller/latest_sainik_samachar_details';

 $route[$routes->submit_feedback_api]['post'] = 'api_controller/submit_feedback_api';


$route[$routes->logo_gallery_api]['GET'] = 'api_controller/logo_gallery';



$route[$routes->posts]['GET'] = 'home_controller/posts';
$route[$routes->gallery_album . '/(:num)']['GET'] = 'home_controller/gallery_album/$1';
$route[$routes->tag . '/(:any)']['GET'] = 'home_controller/tag/$1';
$route[$routes->reading_list]['GET'] = 'home_controller/reading_list';
$route[$routes->search]['GET'] = 'home_controller/search';


//rss routes
$route[$routes->rss_feeds]['GET'] = 'home_controller/rss_feeds';
$route['rss/latest-posts']['GET'] = 'home_controller/rss_latest_posts';
$route['rss/category/(:any)']['GET'] = 'home_controller/rss_by_category/$1';
$route['rss/author/(:any)']['GET'] = 'home_controller/rss_by_user/$1';

//auth routes
$route[$routes->register]['GET'] = 'auth_controller/register';

$route[$routes->change_password]['GET'] = 'auth_controller/change_password';
$route[$routes->forgot_password]['GET'] = 'auth_controller/forgot_password';
$route[$routes->reset_password]['GET'] = 'auth_controller/reset_password';
$route['connect-with-facebook'] = 'auth_controller/connect_with_facebook';
$route['facebook-callback'] = 'auth_controller/facebook_callback';
$route['connect-with-google'] = 'auth_controller/connect_with_google';
$route['connect-with-vk'] = 'auth_controller/connect_with_vk';

//profile routes
$route[$routes->profile . '/(:any)']['GET'] = 'profile_controller/profile/$1';
$route[$routes->settings]['GET'] = 'profile_controller/update_profile';
$route[$routes->settings . '/' . $routes->social_accounts]['GET'] = 'profile_controller/social_accounts';
$route[$routes->settings . '/' . $routes->preferences]['GET'] = 'profile_controller/preferences';
$route[$routes->settings . '/' . $routes->visual_settings]['GET'] = 'profile_controller/visual_settings';
$route[$routes->settings . '/' . $routes->change_password]['GET'] = 'profile_controller/change_password';
$route[$routes->settings . '/' . $routes->delete_account]['GET'] = 'profile_controller/delete_account';
$route[$routes->earnings]['GET'] = 'earnings_controller/earnings';
$route[$routes->payouts]['GET'] = 'earnings_controller/payouts';
$route[$routes->set_payout_account]['GET'] = 'earnings_controller/set_payout_account';

$route[$routes->logout]['GET'] = 'common_controller/logout';
$route['confirm']['GET'] = 'auth_controller/confirm_email';
$route["unsubscribe"]['GET'] = 'auth_controller/unsubscribe';
$route["cron/update-feeds"]['GET'] = 'cron_controller/check_feed_posts';
$route["cron/update-sitemap"]['GET'] = 'cron_controller/update_sitemap';
$route["cron/check-scheduled-posts"]['GET'] = 'cron_controller/check_scheduled_posts';

//POST routes
$route['forgot-password-post']['POST'] = 'auth_controller/forgot_password_post';
$route['register-post']['POST'] = 'auth_controller/register_post';
$route['reset-password-post']['POST'] = 'auth_controller/reset_password_post';
$route['change-password-post']['POST'] = 'profile_controller/change_password_post';
$route['delete-account-post']['POST'] = 'profile_controller/delete_account_post';
$route['preferences-post']['POST'] = 'profile_controller/preferences_post';
$route['visual-settings-post']['POST'] = 'profile_controller/visual_settings_post';
$route['social-accounts-post']['POST'] = 'profile_controller/social_accounts_post';
$route['update-profile-post']['POST'] = 'profile_controller/update_profile_post';
$route['add-to-newsletter']['POST'] = 'home_controller/add_to_newsletter';
$route['follow-unfollow-user']['POST'] = 'profile_controller/follow_unfollow_user';
$route['contact-post']['POST'] = 'home_controller/contact_post';
$route['download-file']['POST'] = 'home_controller/download_post_file';
$route['download-audio']['POST'] = 'home_controller/download_audio';
$route["run-internal-cron"]['POST']  = "ajax_controller/run_internal_cron";
$route['preview/(:any)']['GET'] = 'home_controller/preview/$1';

$route['set-paypal-payout-account-post']['POST'] = 'earnings_controller/set_paypal_payout_account_post';
$route['set-iban-payout-account-post']['POST'] = 'earnings_controller/set_iban_payout_account_post';
$route['set-swift-payout-account-post']['POST'] = 'earnings_controller/set_swift_payout_account_post';

$route['(:any)/(:num)']['GET'] = 'home_controller/gallery_post/$1/$2';
/*
*-------------------------------------------------------------------------------------------------
* ADMIN ROUTES
*-------------------------------------------------------------------------------------------------
*/
$route[$routes->admin] = 'admin_controller/index';
$route[$routes->admin . "/login"] = 'common_controller/admin_login';
$route[$routes->admin . "/login/captcha"] = 'common_controller/captcha';
$route[$routes->admin . "/forgot-password"] = 'common_controller/forgot_password';
$route[$routes->admin . "/navigation"] = 'admin_controller/navigation';
$route[$routes->admin . "/update-menu-link/(:num)"] = 'admin_controller/update_menu_link/$1';
$route[$routes->admin . "/preferences"] = 'admin_controller/preferences';
$route[$routes->admin . "/themes"] = 'admin_controller/themes';
//page
$route[$routes->admin . "/add-page"] = 'page_controller/add_page';
$route[$routes->admin . "/update-page/(:num)"] = 'page_controller/update_page/$1';
$route[$routes->admin . "/pages"] = 'page_controller/pages';
$route[$routes->admin . "/feedback-list"] = 'page_controller/feedback_list';
//post
$route[$routes->admin . "/post-format"] = 'post_controller/post_format';
$route[$routes->admin . "/add-post"] = 'post_controller/add_post';
$route[$routes->admin . "/posts"] = 'post_controller/posts';
$route[$routes->admin . "/slider-posts"] = 'post_controller/slider_posts';
$route[$routes->admin . "/featured-posts"] = 'post_controller/featured_posts';
$route[$routes->admin . "/breaking-news"] = 'post_controller/breaking_news';
$route[$routes->admin . "/recommended-posts"] = 'post_controller/recommended_posts';
$route[$routes->admin . "/pending-posts"] = 'post_controller/pending_posts';
$route[$routes->admin . "/scheduled-posts"] = 'post_controller/scheduled_posts';
$route[$routes->admin . "/drafts"] = 'post_controller/drafts';
$route[$routes->admin . "/update-post/(:num)"] = 'post_controller/update_post/$1';
$route[$routes->admin . "/bulk-post-upload"] = 'post_controller/bulk_post_upload';

//rss
$route[$routes->admin . "/import-feed"] = 'rss_controller/import_feed';
$route[$routes->admin . "/feeds"] = 'rss_controller/feeds';
$route[$routes->admin . "/update-feed/(:num)"] = 'rss_controller/update_feed/$1';

//press realease category
$route[$routes->admin . "/add-press-release"]      = 'press_realease_controller/press_realease';
$route[$routes->admin . "/add-press-release-translation/(:num)"]      = 'press_realease_controller/press_realease_translation/$1';
$route[$routes->admin . "/view-press-release-list"]      = 'press_realease_controller/view_press_release_list';
$route[$routes->admin . "/view-press-release-list-translate/(:num)"]      = 'press_realease_controller/view_press_release_list_translate/$1';

$route[$routes->admin . "/view-schedule-publish-list"]  = 'press_realease_controller/view_schedule_publish_list';
// $route[$routes->admin . "/view-schedule-publish-list/(:num)"]      = 'press_realease_controller/view_schedule_publish_listing/$1';

$route[$routes->admin . "/view-press-realease-withdraw-request"]  = 'press_realease_controller/view_press_realease_withdraw_request';
$route[$routes->admin . "/view-press-realease-withdraw-request/(:num)"]  = 'press_realease_controller/update_press_realease_withdraw_request/$1';

$route[$routes->admin . "/view_update_request_press_release"]  = 'press_realease_controller/view_press_realease_update_request';
$route[$routes->admin . "/view_update_request_press_release/(:num)"]  = 'press_realease_controller/update_press_release_request/$1';

// rejected press release navbar route

$route[$routes->admin . "/view-rejected-publish-list"]  = 'press_realease_controller/view_rejected_publish_list';

//end route
$route[$routes->admin . "/view-press-release-update-request-display/(:num)"]  = 'press_realease_controller/update_press_release_request_display/$1';

$route[$routes->admin . "/view-press-release-status"]      = 'press_realease_controller/view_press_release_status';
$route[$routes->admin . "/view-press-release/(:num)"]      = 'press_realease_controller/view_press_release/$1';
$route[$routes->admin . "/view_press_release_withdraw_request_display/(:num)"]      = 'press_realease_controller/view_press_release_withdraw_request_display/$1';
$route[$routes->admin . "/update-press-release/(:num)"]      = 'press_realease_controller/update_press_release/$1';
$route[$routes->admin . "/press-release-type"]     = 'press_realease_controller/press_realease_type';
$route[$routes->admin . "/pro-category"]           = 'press_realease_controller/pro_categories';
$route[$routes->admin . "/notification"]           = 'notification';
$route[$routes->admin . "/view-notification"]      = 'notification/view_notification';
$route[$routes->admin . "/update-press-release-category/(:num)"] = 'press_realease_controller/update_category/$1';
$route[$routes->admin . "/update-press-release-type/(:num)"] = 'press_realease_controller/update_press_release_type/$1';
//category
$route[$routes->admin . "/categories"] = 'category_controller/categories';
$route[$routes->admin . "/categories"] = 'category_controller/categories';
$route[$routes->admin . "/subcategories"] = 'category_controller/subcategories';
$route[$routes->admin . "/update-category/(:num)"] = 'category_controller/update_category/$1';
$route[$routes->admin . "/update-subcategory/(:num)"] = 'category_controller/update_subcategory/$1';
//widget
$route[$routes->admin . "/add-widget"] = 'widget_controller/add_widget';
$route[$routes->admin . "/widgets"] = 'widget_controller/widgets';
$route[$routes->admin . "/update-widget/(:num)"] = 'widget_controller/update_widget/$1';
//poll
$route[$routes->admin . "/add-poll"] = 'poll_controller/add_poll';
$route[$routes->admin . "/polls"] = 'poll_controller/polls';
$route[$routes->admin . "/update-poll/(:num)"] = 'poll_controller/update_poll/$1';
//gallery
$route[$routes->admin . "/gallery-categories"] = 'category_controller/gallery_categories';
$route[$routes->admin . "/gallery-albums"] = 'gallery_controller/gallery_albums';
$route[$routes->admin . "/update-gallery-category/(:num)"] = 'category_controller/update_gallery_category/$1';
$route[$routes->admin . "/update-gallery-album/(:num)"] = 'gallery_controller/update_gallery_album/$1';
$route[$routes->admin . "/gallery-images"] = 'gallery_controller/gallery_images';

$route[$routes->admin . "/circular-category"] = 'circular_controller/circular_category';
$route[$routes->admin . "/update-circular-category/(:num)"] = 'circular_controller/update_circular_category/$1';
$route[$routes->admin . "/circular-manage"] = 'circular_controller/circular_manage';
$route[$routes->admin . "/view-circular"] = 'circular_controller/view_circular';

$route[$routes->admin . "/update-circular-manage/(:num)"] = 'circular_controller/update_circular_manage/$1';


$route[$routes->admin . "/document-category"] = 'document_controller/document_category';
$route[$routes->admin . "/update-document-category/(:num)"] = 'document_controller/update_document_category/$1';
$route[$routes->admin . "/add-document"] = 'document_controller/add_document';
$route[$routes->admin . "/view-document"] = 'document_controller/view_document';
$route[$routes->admin . "/update-document-manage/(:num)"] = 'document_controller/update_document_manage/$1';


$route[$routes->admin . "/download-category"] = 'download_controller/download_category';
$route[$routes->admin . "/update-download-category/(:num)"] = 'download_controller/update_download_category/$1';
$route[$routes->admin . "/add-download"] = 'download_controller/add_download';
$route[$routes->admin . "/view-download"] = 'download_controller/view_download';
$route[$routes->admin . "/update-download-manage/(:num)"] = 'download_controller/update_download_manage/$1';

/*audio*/ 
$route[$routes->admin . "/audio-sub-categories"] = 'category_controller/audio_categories';
$route[$routes->admin . "/audio-audio"] = 'audio_controller/audio_views';
$route[$routes->admin . "/audio"] = 'audio_controller/audio';
$route[$routes->admin . "/add-audio"] = 'audio_controller/add_audio';
$route[$routes->admin . "/audio-categories"] = 'audio_controller/audio_albums';
$route[$routes->admin . "/update-audio-album/(:num)"] = 'audio_controller/update_audio_album/$1';
$route[$routes->admin . "/update-audio-category/(:num)"] = 'category_controller/update_audio_category/$1';
$route[$routes->admin . "/update-audio-img/(:num)"] = 'audio_controller/update_audio_img/$1';
/*naseer khan */ 

/*media invite */ 
$route[$routes->admin . "/media-invite"] = 'media_controller/media';
$route[$routes->admin . "/add-media-invite"] = 'media_controller/add_media_invite';
$route[$routes->admin . "/update-media/(:num)"] = 'media_controller/update_media/$1';

/*naseer khan */ 
//image gallery
$route[$routes->admin . "/logo"] = 'logo_controller/logo';
$route[$routes->admin . "/add-logo"] = 'logo_controller/add_logo';
$route[$routes->admin . "/update-logo/(:num)"] = 'logo_controller/update_logo_gallery/$1';

//event
$route[$routes->admin . "/event"] = 'event_controller/event';
$route[$routes->admin . "/add-event"] = 'event_controller/add_event';
$route[$routes->admin . "/update-event/(:num)"] = 'event_controller/update_event/$1';
/*infographic */ 
$route[$routes->admin . "/infographic"] = 'infographic_controller/infographic';
$route[$routes->admin . "/add-infographic"] = 'infographic_controller/add_infographic';
$route[$routes->admin . "/update-media/(:num)"] = 'media_controller/update_media/$1';
$route[$routes->admin . "/infographic-category"] = 'infographic_controller/infographic_category';
$route[$routes->admin . "/update-infographic-category/(:num)"] = 'infographic_controller/update_infographic_category/$1';
$route[$routes->admin . "/update-infographic/(:num)"] = 'infographic_controller/update_infographic/$1';

$route[$routes->admin . "/reset_password"] = 'common_controller/reset_password';

/*naseer khan */

/*video */ 
$route[$routes->admin . "/video-categories"] = 'category_controller/video_categories';
$route[$routes->admin . "/audio-audio"] = 'audio_controller/audio_views';
$route[$routes->admin . "/video"] = 'video_controller/video';
$route[$routes->admin . "/add-video"] = 'video_controller/add_video';
$route[$routes->admin . "/video-category"] = 'video_controller/video_albums';
$route[$routes->admin . "/update-video-album/(:num)"] = 'video_controller/update_video_album/$1';
$route[$routes->admin . "/update-video-category/(:num)"] = 'category_controller/update_video_category/$1';
$route[$routes->admin . "/update-video/(:num)"] = 'video_controller/update_video/$1';

$route[$routes->admin . "/add-press"] = 'press_controller/add_press';
//sainik pratika

$route[$routes->admin . "/add-sainik-samachar"] = 'SainikPratika_controller/SainikPratika_add_page';
$route[$routes->admin . "/view-sainik-samachar"] = 'SainikPratika_controller/SainikPratika_pages';
$route[$routes->admin . "/add-sainik-samachar-category"] = 'SainikPratika_controller/SainikPratika_category';
$route[$routes->admin . "/update-sainik-samachar/(:num)"] = 'SainikPratika_controller/SainikPratika_update_page/$1';
$route[$routes->admin . "/view-sainik-samachar/(:num)"] = 'SainikPratika_controller/SainikPratika_view_page/$1';
$route[$routes->admin . "/update-sainik-samachar-category/(:num)"] = 'SainikPratika_controller/update_category/$1';
//gallery 
$route[$routes->admin . "/gallery-add-image"] = 'gallery_controller/add_image';
$route[$routes->admin . "/update-gallery-image/(:num)"] = 'gallery_controller/update_gallery_image/$1';
//contact
$route[$routes->admin . "/contact-messages"] = 'admin_controller/contact_messages';
//newsletter
$route[$routes->admin . "/send-email-subscribers"] = 'admin_controller/send_email_subscribers';
$route[$routes->admin . "/send-email-subscriber/(:num)"] = 'admin_controller/send_email_subscriber/$1';
$route[$routes->admin . "/subscribers"] = 'admin_controller/subscribers';
//comments
$route[$routes->admin . "/comments"] = 'admin_controller/comments';
$route[$routes->admin . "/pending-comments"] = 'admin_controller/pending_comments';
//ad_spaces
$route[$routes->admin . "/ad-spaces"] = 'admin_controller/ad_spaces';
$route[$routes->admin . "/seo-tools"] = 'admin_controller/seo_tools';
$route[$routes->admin . "/social-login-configuration"] = 'admin_controller/social_login_configuration';
$route[$routes->admin . "/cache-system"] = 'admin_controller/cache_system';
$route[$routes->admin . "/preferences"] = 'admin_controller/preferences';
//font
$route[$routes->admin . "/font-settings"] = 'admin_controller/font_settings';
$route[$routes->admin . "/update-font/(:num)"] = 'admin_controller/update_font/$1';
//language
$route[$routes->admin . "/language-settings"] = 'language_controller/languages';
$route[$routes->admin . "/edit-language/(:num)"] = 'language_controller/edit_language/$1';
$route[$routes->admin . "/translations/(:num)"] = 'language_controller/translations/$1';
$route[$routes->admin . "/search-phrases"] = 'language_controller/search_phrases';
//settings
$route[$routes->admin . "/visual-settings"] = 'admin_controller/visual_settings';
$route[$routes->admin . "/email-settings"] = 'admin_controller/email_settings';
$route[$routes->admin . "/settings"] = 'admin_controller/settings';


// $route[$routes->admin . "/facebook-settings"] = 'admin_controller/facebook_settings_post';

$route[$routes->admin . "/social-media-setting"] = 'admin_controller/social_media_setting';

$route[$routes->admin . "/route-settings"] = 'admin_controller/route_settings';
//users
$route[$routes->admin . "/users"] = 'admin_controller/users';
$route[$routes->admin . "/user-logs"] = 'admin_controller/user_logs';
$route[$routes->admin . '/administrators'] = 'admin_controller/administrators';
$route[$routes->admin . '/add-user'] = 'admin_controller/add_user';
$route[$routes->admin . '/edit-user/(:num)'] = 'admin_controller/edit_user/$1';
$route[$routes->admin . '/edit-new-password/(:num)'] = 'admin_controller/change_password/$1';
$route[$routes->admin . '/roles-permissions'] = 'admin_controller/roles_permissions';
$route[$routes->admin . '/edit-role/(:num)'] = 'admin_controller/edit_role/$1';
$route[$routes->admin . "/email-preview"] = 'admin_controller/email_preview';

//reward system
$route[$routes->admin . "/reward-system"] = 'reward_controller/reward_system';
$route[$routes->admin . "/reward-system/earnings"] = 'reward_controller/earnings';
$route[$routes->admin . "/reward-system/payouts"] = 'reward_controller/payouts';
$route[$routes->admin . "/reward-system/add-payout"] = 'reward_controller/add_payout';
$route[$routes->admin . "/reward-system/pageviews"] = 'reward_controller/pageviews';


/*
*-------------------------------------------------------------------------------------------------
* DYNAMIC ROUTES
*-------------------------------------------------------------------------------------------------
*/
$languages = $this->config->item('languages');
foreach ($languages as $language) {
    if ($language->status == 1 && $general_settings->site_lang != $language->id) {
        $key = $language->short_form;
        $route[$key] = "home_controller/index";
        $route[$key . '/' . $routes->posts]['GET'] = 'home_controller/posts';
        $route[$key . '/' . $routes->gallery_album . '/(:num)']['GET'] = 'home_controller/gallery_album/$1';
        $route[$key . '/' . $routes->tag . '/(:any)']['GET'] = 'home_controller/tag/$1';
        $route[$key . '/' . $routes->reading_list]['GET'] = 'home_controller/reading_list';
        $route[$key . '/' . $routes->search]['GET'] = 'home_controller/search';

        $route[$key . '/' . $routes->rss_feeds]['GET'] = 'home_controller/rss_feeds';
        $route[$key . '/rss/latest-posts']['GET'] = 'home_controller/rss_latest_posts';
        $route[$key . '/rss/category/(:any)']['GET'] = 'home_controller/rss_by_category/$1';
        $route[$key . '/rss/author/(:any)']['GET'] = 'home_controller/rss_by_user/$1';

        $route[$key . '/' . $routes->register]['GET'] = 'auth_controller/register';
        $route[$key . '/' . $routes->change_password]['GET'] = 'auth_controller/change_password';
        $route[$key . '/' . $routes->forgot_password]['GET'] = 'auth_controller/forgot_password';
        $route[$key . '/' . $routes->reset_password]['GET'] = 'auth_controller/reset_password';

        $route[$key . '/' . $routes->profile . '/(:any)']['GET'] = 'profile_controller/profile/$1';
        $route[$key . '/' . $routes->settings]['GET'] = 'profile_controller/update_profile';
        $route[$key . '/' . $routes->settings . '/' . $routes->social_accounts]['GET'] = 'profile_controller/social_accounts';
        $route[$key . '/' . $routes->settings . '/' . $routes->preferences]['GET'] = 'profile_controller/preferences';
        $route[$key . '/' . $routes->settings . '/' . $routes->visual_settings]['GET'] = 'profile_controller/visual_settings';
        $route[$key . '/' . $routes->settings . '/' . $routes->change_password]['GET'] = 'profile_controller/change_password';
        $route[$key . '/' . $routes->settings . '/' . $routes->delete_account]['GET'] = 'profile_controller/delete_account';

        $route[$key . '/' . $routes->earnings]['GET'] = 'earnings_controller/earnings';
        $route[$key . '/' . $routes->payouts]['GET'] = 'earnings_controller/payouts';
        $route[$key . '/' . $routes->set_payout_account]['GET'] = 'earnings_controller/set_payout_account';

        $route[$key . '/' . $routes->logout]['GET'] = 'common_controller/logout';
        $route[$key . '/confirm']['GET'] = 'auth_controller/confirm_email';
        $route[$key . "/unsubscribe"]['GET'] = 'auth_controller/unsubscribe';

        $route[$key . '/(:any)/(:num)'] = 'home_controller/gallery_post/$1/$2';
        $route[$key . '/(:any)/(:any)']['GET'] = 'home_controller/subcategory/$1/$2';
        $route[$key . '/(:any)'] = 'home_controller/any/$1';
    }
}

$route['(:any)/(:any)']['GET'] = 'home_controller/subcategory/$1/$2';
$route['(:any)']['GET'] = 'home_controller/any/$1';

$route['404_override'] = 'my404';

