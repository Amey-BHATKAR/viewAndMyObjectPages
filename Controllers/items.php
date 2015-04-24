<?php


$NB_ART_PAGE = 5 ;

$p = @$_GET['p'];

if($p>=1) {
	$p--;
}
$offset = $p*$NB_ART_PAGE;
//var_dump($offset); die;
$p++;
$location_coords = Site::GetCoords($s_a_loc);
$cat = category_article::returnCategoryForSearch($s_a_cat);
$name = category_article::returnNameForSearch($s_a_name);
$url_address = urlencode($s_a_loc) ;



$me = Session::Me();

$number_art_search = article::GetUsersArticleResults($cat,$name,$location_coords,'','',$me->getAttr('id'), 0,true);
	
$max_page = ceil($number_art_search / $NB_ART_PAGE);
$tab_art_search = article::GetUsersArticleResults($cat,$name,$location_coords,$offset,$NB_ART_PAGE,$me->getAttr('id'), 0);
//echo "<pre>"; var_dump($location_coords); die;
include(Site::include_view('items'));



?>