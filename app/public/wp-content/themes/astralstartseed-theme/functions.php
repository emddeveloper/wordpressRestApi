<?php

add_action('rest_api_init', 'customapi_1');

function customapi_1() {
  register_rest_route('restapi/v1', 'getdata', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'customapi_welcome'
  ));
}

function customapi_welcome() {
  $mypost = new WP_Query(array(
    'post_type' => 'post'
  ));

  $results = array();

  while($mypost->have_posts()) {
    $mypost->the_post();
    array_push($results, array(
        'id'=>get_the_id(),
      'title' => get_the_title(),
      'permalink' => get_the_permalink(),
      'content'=> get_the_content()
    ));
  }

  return $results;

}
