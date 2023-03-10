<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//  print_r($_SERVER['PATH_INFO']);

$route['default_controller'] = 'shop';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['(\w{2})/(.*)'] = '$2';
$route['(\w{2})'] = $route['default_controller'];
$route['employee-login'] = 'login/login_employee';
$route['employee-forgot'] = 'login/employee_forgot_password';
$route['employee-reset-password'] = 'login/employee_reset_password';
$route['employee-reset-password/(:any)'] = 'login/employee_reset_password/$1';
$route['affiliate-forgot'] = 'login/affiliate_forgot_password';
$route['affiliate-reset-password'] = 'login/affiliate_reset_password';
//For Configuration Controller
$route['admin/custom-field'] = 'admin/configuration/set_register_fields';
$route['admin/custom-field/(:any)/(:num)'] = 'admin/configuration/set_register_fields/$1/$2';
$route['admin/plan-settings'] = 'admin/configuration/plan_settings';
$route['admin/locale-settings'] = 'admin/configuration/multiple_options';
//For Employee
$route['admin/employee-enroll'] = 'admin/employee/employee_register';
$route['admin/employee-permission'] = 'admin/employee/menu_permission';
$route['admin/employee-permission/(:num)'] = 'admin/employee/menu_permission/$1';
$route['admin/employee-update'] = 'admin/employee/edit_form';
$route['admin/employee-update/(:num)'] = 'admin/employee/edit_form/$1';
$route['admin/employee-activate/(:num)'] = 'admin/employee/activate_employee/$1';
$route['admin/employee-inactivate/(:num)'] = 'admin/employee/inactivate_employee/$1';
$route['admin/employee-delete/(:num)'] = 'admin/employee/delete_form/$1';

$route['admin/view-all-employee'] = 'admin/employee/view_all_employee';
$route['admin/view-all-employee/(:num)/(:any)'] = 'admin/employee/view_all_employee/$1/$2';
$route['admin/change-employee-password'] = 'admin/employee/change_employee_password';

//For E-pin
$route['(:any)/e-pin-manage'] = '$1/epin/epin_management';
$route['(:any)/e-pin-manage/(:any)/(:num)'] = '$1/epin/epin_management/$2/$3';
$route['(:any)/e-pin-manage/(:any)/(:num)/(:any)'] = '$1/epin/epin_management/$2/$3/$4';
//For Document
$route['admin/document-upload'] = 'admin/document/upload';
$route['(:any)/document-view'] = '$1/document/view';
$route['(:any)/grid-view'] = '$1/document/grid_view';
$route['(:any)/document-download/(:any)'] = '$1/document/download_file/$2';
//For Donation
$route['(:any)/donation-plan'] = '$1/donation/index';
$route['(:any)/donation-history'] = '$1/donation/history';
$route['(:any/)donation-settings'] = '$1/donation/settings';
//For Gift
$route['(:any)/gift-plan'] = '$1/gift/gift_requests';
$route['admin/gift-settings'] = 'admin/gift/settings';
$route['(:any)/gift-history'] = '$1/gift/history';
//For KYC
$route['(:any)/kyc-submit'] = '$1/kyc/add_kyc_details';
$route['(:any)/kyc-view'] = '$1/kyc/view_all_kyc_details';
//For Mail
$route['(:any)/compose'] = '$1/mail/compose';
$route['(:any)/read'] = '$1/mail/read';
$route['(:any)/read/(:any)'] = '$1/mail/read/$2';
$route['(:any)/sent'] = '$1/mail/sent';
$route['(:any)/draft'] = '$1/mail/draft';
$route['(:any)/stared'] = '$1/mail/stared';
$route['(:any)/spam'] = '$1/mail/spam';
$route['(:any)/trash'] = '$1/mail/trash';
$route['(:any)/inbox'] = '$1/mail/inbox';
//For Member
$route['(:any)/account-settings'] = '$1/member/account_settings';
$route['admin/payment-orders'] = 'admin/member/pending_orders';
$route['admin/payment-enrolls'] = 'admin/member/pending_registrations';
$route['(:any)/withdraw-settings'] = '$1/member/payment_settings';
$route['admin/position-management'] = 'admin/member/position_settings';
//For Menu
$route['admin/menu-manage'] = 'admin/menu/menu_management';
$route['admin/menu-manage/(:any)'] = 'admin/menu/menu_management/$1';
$route['(:any)/help-gift-request'] = '$1/gift/help_requests';
$route['(:any)/help-gift-request/(:any)'] = '$1/gift/help_requests/$2';
//For Migration
$route['admin/migrate-view'] = 'admin/migration/index';
$route['admin/migrate-view/(:any)/(:num)'] = 'admin/migration/index/$1/$2';
$route['admin/migrate-data/(:any)'] = 'admin/migration/view_data/$1';
$route['admin/migrate-confirm/(:any)/(:num)'] = 'admin/migration/migrate/$1/$2';
$route['admin/migrate-sample'] = 'admin/migration/download_sample_file';
//For Terms And Conditon & Privacy Policy 
$route['admin/terms-condition'] = 'admin/configuration/terms_and_condition';
//For Module
$route['admin/module-view'] = 'admin/modules/index';
$route['admin/module-settings(:any)'] = 'admin/modules/settings/$1';
//For News
$route['admin/news-add'] = 'admin/news/add';
$route['admin/news-add/(:any)/(:num)'] = 'admin/news/add/$1/$2';
$route['(:any)/news-view'] = '$1/news/view';
$route['(:any)/news-timeline'] = '$1/news/timeline';
//For Party
$route['(:any)/party-plan'] = '$1/party/create_party';
$route['admin/party-plan/(:any)/(:num)'] = 'admin/party/create_party/$1/$2';
$route['user/party-plan/(:any)/(:num)'] = 'user/party/create_party/$1/$2';
$route['(:any)/party-manage/(:any)/(:any)/(:num)'] = '$1//party/party_management/$2/$3/$4';
$route['(:any)/party-manage'] = '$1//party/party_management';
$route['(:any)/party-invite'] = '$1/party/party_invite';
//For Product
$route['admin/product-manage'] = 'admin/product/product_management';
$route['admin/product-manage/(:any)/(:num)'] = 'admin/product/product_management/$1/$2';
$route['admin/product-manage/(:any)/(:num)'] = 'admin/product/product_management/$1/$2';

$route['admin/cat-manage'] = 'admin/product/category_management';
$route['admin/cat-manage/(:any)/(:num)'] = 'admin/product/category_management/$1/$2';
$route['admin/cat-manage/(:any)/(:num)'] = 'admin/product/category_management/$1/$2';

$route['admin/sub-cat-manage'] = 'admin/product/sub_category_management';
$route['admin/sub-cat-manage/(:any)/(:num)'] = 'admin/product/sub_category_management/$1/$2';
$route['admin/sub-cat-manage/(:any)/(:num)'] = 'admin/product/sub_category_management/$1/$2';

//For Profile
$route['(:any)/profile-view'] = '$1/profile/index';
$route['admin/profile-view/(:any)'] = 'admin/profile/index/$1';
$route['(:any)/profile-show'] = '$1/profile/index';
//For Promotion
$route['(:any)/promotion-view'] = '$1/promotion/index';
//For Rank
$route['admin/title-settings'] = 'admin/rank/rank_setting';
//For Reset
$route['admin/reset-system'] = 'admin/reset/clean';
$route['admin/reset-cache'] = 'admin/reset/wipe';
//For Settings
$route['admin/wallet-manage'] = 'admin/settings/multiple_wallet';
$route['admin/generation-plan'] = 'admin/settings/generation_settings';
$route['admin/investment-plan'] = 'admin/settings/investment_settings';
$route['admin/tax-manage'] = 'admin/settings/tax_and_payment';
$route['admin/stair-step-plan'] = 'admin/settings/stair_step_settings';
//For Site Management
$route['admin/website-manage'] = 'admin/site_management/site_configuration';
$route['admin/mail-template'] = 'admin/site_management/mail_contents';
$route['admin/mail-manage'] = 'admin/site_management/mail_settings';

// For Brand Settings
$route['admin/brand-settings'] = 'admin/site_management/brand_settings';
$route['admin/brand-settings/(:any)/(:num)'] = 'admin/site_management/brand_settings/$1/$2';
$route['admin/whatsapp-notification'] = 'admin/site_management/whatsapp_notification';



//For Testimonials
$route['admin/testimonial-view'] = 'admin/testimonial/view_testimonial';
$route['user/testimonial-add'] = 'user/testimonial/create_testimonial';

//For Tree
$route['(:any)/genealogy-view'] = '$1/tree/genealogy';
$route['(:any)/sponsor-view'] = '$1/tree/sponsor';
$route['(:any)/tabular-view'] = '$1/tree/tabular_tree';
$route['(:any)/root-view'] = '$1/tree/root';
//For wallet
$route['(:any)/transfer-funds'] = '$1/wallet/fund_transfer';
$route['(:any)/wallet-one'] = '$1/wallet/user_wallet_one';
$route['(:any)/wallet-two'] = '$1/wallet/user_wallet_two';
$route['admin/withdarw-confirm/(:any)/(:num)'] = 'admin/wallet/payout_release/$2/$3';
$route['admin/withdarw-confirm'] = 'admin/wallet/payout_release';
$route['(:any)/investment-view'] = '$1/wallet/investment_history';
$route['(:any)/release-investment'] = '$1/wallet/release_investment_amount';
$route['user/withdraw-request'] = 'user/wallet/payout';
//For Cart
$route['shopping-cart'] = 'cart/index';
$route['shopping-cart/(:any)'] = 'cart/index/$1';
$route['shopping-view'] = 'cart/view';
$route['shopping-checkout'] = 'cart/checkout';
//For LCP
$route['capture-page'] = 'lcp/index';
//For login
$route['login-site'] = 'login/index';
$route['site'] = 'login/index';
$route['verify-path'] = 'verify/index';
$route['login-forgot'] = 'login/forgot_password';
$route['login-reset'] = 'login/reset_password';
$route['email-verify'] = 'login/verification';
$route['login-lock'] = 'login/lock_screen';
$route['login-lock/(:any)'] = 'login/lock_screen/$1';
$route['logout-site'] = 'login/logout';
$route['login-override'] = 'login/admin_over_ride';
$route['reset-password'] = 'login/reset_password';
$route['reset-password/(:any)'] = 'login/reset_password/$1';
//For Register
$route['packages'] = 'register/packages';
$route['packages/(:any)'] = 'register/packages/$1';
$route['packages/(:any)/(:any)'] = 'register/packages/$1/$2';
$route['packages/(:any)/(:any)/(:any)'] = 'register/packages/$1/$2/$3';
$route['enroll-multi/(:any)/(:any)/(:any)'] = 'register/multiple_step/$1/$2/$3';
$route['enroll-multi/(:any)/(:any)'] = 'register/multiple_step/$1/$2';
$route['enroll-multi/(:any)'] = 'register/multiple_step/$1';
$route['enroll-multi'] = 'register/multiple_step';
$route['enroll/(:any)/(:any)/(:any)'] = 'register/single_step/$1/$2/$3';
$route['enroll/(:any)/(:any)'] = 'register/single_step/$1/$2';
$route['enroll/(:any)'] = 'register/single_step/$1';
$route['enroll'] = 'register/single_step';


$route['enroll1'] = 'register/register';


$route['enroll-advanced'] = 'register/advanced';
$route['enroll-advanced/(:any)'] = 'register/advanced/$1';
$route['enroll-advanced/(:any)/(:any)'] = 'register/advanced/$1/$2';
$route['enroll-advanced/(:any)/(:any)/(:any)'] = 'register/advanced/$1/$2/$3';
//For Message
$route['(:any)/chat-box'] = '$1/message/index';
//For Event
$route['admin/event-manage'] = 'admin/events/event_management';
$route['admin/event-manage/(:any)/(:num)'] = 'admin/events/event_management/$1/$2';
$route['(:any)/event-calendar'] = '$1/events/calendar';
$route['(:any)/event-view'] = '$1/events/view_event';
//For Replication
$route['replicate-site/(:any)'] = 'replication/index/$1';
//For LCP
$route['user-lead/(:any)'] = 'lcp/index/$1';
//For Reports


$route['(:any)/commission-report'] = '$1/report/user_commission';
$route['(:any)/sales-report'] = '$1/report/user_orders';
$route['(:any)/activity-report'] = '$1/report/history_report';
$route['(:any)/balance-report'] = '$1/report/user_balance';
$route['(:any)/employee-report'] = '$1/report/employee_list';
$route['(:any)/cron-report'] = '$1/report/cron_report';
$route['(:any)/affiliates-activity-report'] = '$1/report/history_report_affiliates';
$route['(:any)/employee-activity-report'] = '$1/report/employee_histroy';
$route['(:any)/affiliates-report'] = '$1/report/affiliates_list';
$route['(:any)/binary-history-report'] = '$1/report/binary_history_report';

//For Home
$route['(:any)/dashboard'] = '$1/home/index';
$route['admin/totalorder'] = 'admin/home/totalorder';
$route['admin/totalsales'] = 'admin/home/totalsales';
$route['admin/total-users'] = 'admin/home/total_users';
$route['admin/total-mapdata'] = 'admin/home/mapdatafun';

$route['(:any)/used-devices'] = '$1/member/recently_used_devices';
$route['(:any)/rank-history'] = '$1/report/rank_history_report';
$route['affiliate-login'] = 'login/login_affiliate';
$route['(:any)/affiliate-view'] = '$1/tree/affiliate';
$route['enroll-affiliates'] = 'client/enroll_affiliates';
$route['(:any)/affiliate-details'] = '$1/affiliates/affiliates_users';
$route['(:any)/affiliate-details/(:any)/(:num)'] = '$1/affiliates/affiliates_users/$2/$3';
$route['(:any)/create-testimonial'] = '$1/testimonial/create_testimonial';
$route['affiliate/enquiry-form'] = 'affiliate/enquiry/enquiry_form';
$route['affiliate/view-affiliate-enquiry'] = 'affiliate/enquiry/view_affiliate_enquiry';
$route['(:any)/affiliate-enquiry'] = '$1/affiliates/affiliates_enquiry';
$route['(:any)/affiliate-shedules'] = '$1/affiliates/affiliates_shedules';

$route['admin/manage-courses'] = 'admin/affiliates/course_management';
$route['admin/manage-sub-courses'] = 'admin/affiliates/sub_course_management';
$route['admin/manage-courses/(:any)/(:num)'] = 'admin/affiliates/course_management/$1/$2';
$route['admin/manage-sub-courses/(:any)/(:num)'] = 'admin/affiliates/sub_course_management/$1/$2';
$route['(:any)/manage-coupons'] = '$1/affiliates/coupon_management';

$route['admin/affiliate-enquiry/(:any)/(:num)/(:any)'] = 'admin/affiliates/affiliates_enquiry/$1/$2/$3';
$route['admin/affiliate-enquiry/(:any)/(:num)'] = 'admin/affiliates/affiliates_enquiry/$1/$2';
$route['user/affiliate-enquiry/(:any)/(:num)/(:any)'] = 'user/affiliates/affiliates_enquiry/$1/$2/$3';
$route['user/affiliate-enquiry/(:any)/(:num)'] = 'user/affiliates/affiliates_enquiry/$1/$2';

$route['shedule-time'] = 'client/time_shedule';
$route['shedule-time/(:any)'] = 'client/time_shedule/$1';

$route['paypal-register'] = 'register/paypal_registration';
$route['paypal-register/(:any)'] = 'register/paypal_registration/$1';

$route['paypal-checkout'] = 'cart/paypal_checkout';
$route['paypal-checkout/(:any)'] = 'cart/paypal_checkout/$1';

$route['blocktrail-register'] = 'register/blocktrail_registration';
$route['blocktrail-register/(:any)'] = 'register/blocktrail_registration/$1';

$route['blocktrail-checkout'] = 'cart/blocktrail_checkout';
$route['blocktrail-checkout/(:any)'] = 'cart/blocktrail_checkout/$1';

$route['admin/change-affiliate-password'] = 'admin/affiliates/change_affiliate_password';

$route['register-preview'] = 'register/register_preview';
$route['register-preview/(:any)'] = 'register/register_preview/$1';

$route['pending-preview'] = 'register/pending_preview';
$route['pending-preview/(:any)'] = 'register/pending_preview/$1';


$route['(:any)/dashboard2'] = '$1/home/index2';
$route['(:any)/dashboard3'] = '$1/home/index3';

$route['admin/ip-whitelisting'] = 'admin/settings/ip_whitelist';

$route['admin/ip-whitelisting/(:any)/(:num)'] = 'admin/settings/ip_whitelist/$1/$2';
$route['admin/sms-settings'] = 'admin/settings/sms_settings';
$route['lang-translator'] = 'translator/translate';
$route['admin/schedule/(:any)'] = 'admin/cron_job/$1';
$route['admin/schedule/db_backup/(:any)'] = 'admin/cron_job/db_backup/$1';
//for ticket system
$route['user/create-ticket'] = 'user/ticket_system/create_ticket';
$route['user/view-ticket'] = 'user/ticket_system/view_my_tickets';
$route['user/view-ticket/(:num)'] = 'user/ticket_system/view_created_users_tickets/$1';
$route['user/support-faq'] = 'user/ticket_system/view_faq';
$route['user/view-ticket-details/(:num)'] = 'user/ticket_system/view_created_users_tickets/$1';
$route['admin/support-center'] = 'admin/ticket_system/index';
$route['admin/support-settings'] = 'admin/ticket_system/index';
$route['admin/tickets'] = 'admin/ticket_system/ticket_management';
$route['admin/tickets/(:any)/(:num)'] = 'admin/ticket_system/ticket_management/$1/$2';
$route['admin/support-manage-type'] = 'admin/ticket_system/ticket_type_configuration';
$route['admin/support-manage-type/(:any)/(:num)'] = 'admin/ticket_system/ticket_type_configuration/$1/$2';
$route['admin/support-manage-department'] = 'admin/ticket_system/ticket_department_configuration';
$route['admin/support-manage-department/(:any)/(:num)'] = 'admin/ticket_system/ticket_department_configuration/$1/$2';
$route['admin/support-manage-priority'] = 'admin/ticket_system/ticket_priority_configuration';
$route['admin/support-manage-priority/(:any)/(:num)'] = 'admin/ticket_system/ticket_priority_configuration/$1/$2';
$route['admin/support-faq'] = 'admin/ticket_system/faq';
$route['admin/support-faq/(:any)/(:num)'] = 'admin/ticket_system/faq/$1/$2';
$route['admin/manage-ticket/(:any)'] = 'admin/ticket_system/view_all_details/$1';
$route['remove-ip'] = 'auto_register/reset_blacklist_ip';
$route['admin/ip-blacklist'] = 'admin/settings/ip_blacklist'; 
$route['admin/ip-blacklist/(:any)/(:num)'] = 'admin/settings/ip_blacklist/$1/$2'; 
$route['(:any)/order-history'] = '$1/member/order_history';


$route['auto-register/(:any)/(:any)/(:any)'] = 'auto_register/register/$1/$2/$3';
$route['auto-register/(:any)/(:any)'] = 'auto_register/register/$1/$2';
$route['auto-register/(:any)'] = 'auto_register/register/$1';
$route['auto-register'] = 'auto_register/register';
$route['admin-login'] = 'auto_register/login/1';
$route['user-login'] = 'auto_register/login';
$route['set-reg-mode'] = 'auto_register/set_register_model';
$route['set-reg-mode/(:num)'] = 'auto_register/set_register_model/$1';

$route['change-plan/(:any)/(:any)/(:any)'] = 'auto_register/change_plan/$1/$2/$3';
$route['change-plan/(:any)/(:any)'] = 'auto_register/change_plan/$1/$2';
$route['change-plan/(:any)'] = 'auto_register/change_plan/$1';
$route['change-plan'] = 'auto_register/change_plan';

$route['update-mail-content'] = 'auto_register/update_mail_content';
$route['set-file-permission'] = 'auto_register/change_permission';
$route['set-system-path'] = 'auto_register/change_system_path';
$route['set-system-path/(:num)'] = 'auto_register/change_system_path/$1';
$route['optimize-english-folder'] = 'translator/optimize_english_folder';
$route['language-translation'] = 'translator/translate_all_language_files';

$route['user/product-return/(:num)'] = 'user/member/product_return/$1';
$route['(:any)/product-return'] = '$1/member/product_return';
$route['(:any)/order-invoice/(:num)'] = '$1/member/invoice/$2';

$route['change-captcha-key'] = 'auto_register/change_captcha_key';
$route['change-captcha-key/(:any)'] = 'auto_register/change_captcha_key/$1';

$route['remove-menu'] = 'auto_register/remove_menu';
$route['change-ip'] = 'auto_register/change_ip_address';
$route['change-collation'] = 'auto_register/change_collation';
$route['set-basic-system'] = 'auto_register/set_basic_system';
$route['set-basic-system/(:num)'] = 'auto_register/set_basic_system/$1';

$route['(:any)/user-kyc'] = '$1/kyc/add';
$route['admin/user-kyc/(:any)'] = 'admin/kyc/add/$1';
$route['admin/user-kyc/(:any)/(:num)'] = 'admin/kyc/add/$1/$2';

$route['(:any)/transfer-wallet'] = '$1/wallet/transfer_points';
$route['admin/payment-details'] = 'admin/member/payment_details';
$route['admin/payment-details/(:any)'] = 'admin/member/payment_details/$1';

$route['(:any)/default-images'] = '$1/member/default_images';


$route['set-payout-method'] = 'auto_register/set_payout_method';
$route['set-payout-method/(:any)'] = 'auto_register/set_payout_method/$1';

$route['admin/user-login'] = 'admin/member/user_login';


$route['(:any)/new-theme'] = '$1/home/theme';

// Shop

$route['index'] = 'shop/index';
$route['login-register'] = 'shop/login_register';
$route['shop'] = 'shop/shop';
$route['shop/(:any)'] = 'shop/shop/$1';
$route['cart'] = 'shop/cart';
$route['about-us'] = 'shop/about_us';
$route['contact'] = 'shop/contact';
$route['app'] = 'shop/app';
$route['shop-details'] = 'shop/shop_details';
$route['shop-details/(:any)'] = 'shop/shop_details/$1';
$route['checkout'] = 'shop/checkout';
$route['update-notify'] = 'shop/update_notify';

$route['account/(:any)'] = 'shop/account/$1';
// $route['tab_actives"'] = 'shop/tab_actives';
$route['(:any)/join-report'] = '$1/report/user_join';
$route['(:any)/join-report/(:num)'] = '$1/report/user_join/$2';

$route['admin/categories'] = 'admin/product/categories';
$route['admin/categories/(:any)/(:num)'] = 'admin/product/categories/$1/$2';
$route['image_upload'] = 'admin/product/image_upload';
$route['admin/website-image-upload'] = 'admin/site_management/website_image_upload';
$route['admin/slider_settings'] = 'admin/site_management/slider_settings';
$route['admin/slider_settings/(:any)/(:num)'] = 'admin/site_management/slider_settings/$1/$2';



