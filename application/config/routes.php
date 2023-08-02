<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'News';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/************** Start Category Routing *************/
$route['sylhet']                    = 'News/category/sylhet';
$route['national']                  = 'News/category/national';
$route['international']             = 'News/category/international';
$route['politics']                  = 'News/category/politics';
$route['sports']                    = 'News/category/sports';
$route['rupali-kotha']              = 'News/category/rupali-kotha';
$route['aboard']                    = 'News/category/aboard';
$route['economy']                   = 'News/category/economy';
$route['press-box']                 = 'News/category/press-box';
$route['info-tech']                 = 'News/category/info-tech';
$route['around-news']               = 'News/category/around-news';
$route['all-around-news']           = 'News/category/all-around-news';
/************** Start Category Routing *************/

/***********Start  Sub Category Routing********** */
$route['sylhet/sylhet-district']    = 'News/SubCategory/sylhet/sylhet-district';
$route['sylhet/sunamganj']          = 'News/SubCategory/sylhet/sunamganj';
$route['sylhet/maulvibazar']        = 'News/SubCategory/sylhet/maulvibazar';
$route['sylhet/habiganj']           = 'News/SubCategory/sylhet/habiganj';

$route['sports/cricket']            = 'News/SubCategory/sports/cricket';
$route['sports/football']           = 'News/SubCategory/sports/football';
/***********End  Sub Category Routing********** */


/***********Start  Single news Routing********* */
$route['details/(:num)/(.+)'] = 'News/details/$1/$2';
/************End  Single news Routing********** */


/************Author news Routing********** */
$route['author/(.+)/(.+)'] = 'News/author/$1/$2';
$route['writer/(.+)'] = 'News/author/$1';
/************Author news Routing********** */


/************Newspaper Routing********** */
$route['news-paper/(.+)/(.+)/(.+)'] = 'News/newspaper/$1/$2/$3';
/************Newspaper Routing********** */


// about
$route['about']='News/about';

/*****News Archive ****/
$route['archive'] = 'News/archive';
$route['news-search'] = 'News/news_filter';
/*****News Archive ****/


/*****News Tagwise ****/
$route['topic'] = 'News/topic';
/*****News Tagwise ****/





/*************** Admin ****************/
$route['login']                     = 'Auth/login';
$route['panel']                     = 'Admin/log_in';


// Category 

$route['create-category']               = 'Admin/NewsCategoryInsert';
$route['category-list']                 = 'Admin/CategoryList';
$route['edit-category/(.+)']            = 'Admin/EditCategory/$1';

$route['create-sub-category']           = 'Admin/SubCategoryEntry';
$route['store-sub-category']            = 'Admin/SubcatInsert';
$route['sub-category-list']             = 'Admin/SubCategoryList';
$route['edit-sub-category/(.+)']        = 'Admin/UpdateSubCategory/$1';
$route['edit-sub-category-store/(.+)']  = 'Admin/SubCategoryUpdateEntry/$1';


// Category 

$route['news-upload']               = 'Admin/NewsEntry';
$route['schedule-news']             = 'Admin/schedule_news';
$route['schedule-news-upload']      = 'Admin/schedule_news_entry';
$route['edit-schedule-news/(.+)']   = 'Admin/schedule_news_edit/$1';
$route['sch-news-edit-entry/(.+)']  = 'Admin/schedule_news_edit_entry/$1';
$route['quick-upload']              = 'Admin/QuickEntry';
$route['opinion-upload']            = 'Admin/OpinionEntry';
$route['share-footer-image']        = 'admin/ShareImage';
$route['news-filter']               = 'Admin/NewsSearch';
$route['news-page']                 = 'Admin/page';
$route['news-type']                 = 'Admin/news_type';
$route['news-config']               = 'Admin/news_config';
$route['news-type-update/(.+)']     = 'Admin/news_type_update/$1';


$route['create-user']               = 'auth/register';
$route['user-list']                 = 'Admin/UsersList';
$route['edit-user/(.+)']            = 'auth/change_user_data/$1';
$route['update-user/(.+)']          = 'auth/edit_user_data/$1';




$route['daily-visitors-list']       = 'Admin/daily_visitors_list';
$route['daily-visitors-list/(.+)']  = 'Admin/daily_visitors_list/$1';

$route['daily-report']       = 'Admin/daily_report';
$route['daily-report/(.+)']  = 'Admin/daily_report/$1';

$route['daily-category-report']       = 'Admin/daily_category_report';
$route['daily-category-report/(.+)']  = 'Admin/daily_category_report/$1';




/*************** Admin ****************/



/*************** News/subscribe ****************/
$route['subscribe']         = 'News/subscribe';
$route['verification']      = 'News/verify_email';
/*************** News/subscribe ****************/


/*************** News Letter ****************/
$route['newsletter']      = 'News/newsletter';
/*************** News Letter ****************/


/*************** News/subscribe ****************/
$route['contact'] = 'News/contact';
$route['prayer'] = 'News/PrayerTimeSingleDay';
$route['prayerTime'] = 'News/prayerTime';
/*************** News/subscribe ****************/
