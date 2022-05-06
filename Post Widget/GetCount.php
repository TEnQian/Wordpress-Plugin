<?php
function getCount($args){
    global $wp_query;
    $wp_query = new WP_Query();
	$wp_query->query($args);
	$count = $wp_query->found_posts;
	return $count;
}