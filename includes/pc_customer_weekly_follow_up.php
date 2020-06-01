<?php
function pc_weekly_follow_up_registration(){

  require_once( ABSPATH . 'wp-admin/includes/image.php' );
  require_once( ABSPATH . 'wp-admin/includes/file.php' );
  require_once( ABSPATH . 'wp-admin/includes/media.php' );

  $photo_id = media_handle_upload( 'photo', 0 );

  if( is_wp_error( $photo_id ) ) {
    $result = $photo_id->get_error_message();
    wp_send_json( $result );
  }

  global $wpdb;

  $user_id            = $_POST['customer_id'];
  $weight             = $_POST['weight'];
  $answer_1           = $_POST['answer_1'];
  $answer_2           = $_POST['answer_2'];
  $answer_3           = $_POST['answer_3'];
  $answer_4           = $_POST['answer_4'];
  $photo              = $photo_id;

  $week = pc_get_current_follow_up_week( $user_id );

  $output = $wpdb->insert(
    $wpdb->prefix . 'pc_follow_up_tbl',
    [
      'user_id'   => $user_id,
      'week'      => $week,
      'weight'    => $weight,
      'answer_1'  => $answer_1,
      'answer_2'  => $answer_2,
      'answer_3'  => $answer_3,
      'answer_4'  => $answer_4,
      'photo_id'  => $photo,
    ],
    [
      '%d','%d','%f','%s','%s','%s','%s','%d'
    ]
  );

  if($output == false){
    $json_output = 'Error, intentelo más tarde';
  }else{
    $json_output = 'Usuario registrado';
  }

  wp_send_json( $json_output );

}

function pc_get_weekly_follow_up( $id ){
  global $wpdb;

  $query = 'SELECT
              f.week,
              f.weight,
              f.answer_1,
              f.answer_2,
              f.answer_3,
              f.answer_4,
              f.photo_id
              FROM `' . $wpdb->prefix . 'pc_follow_up_tbl` f
              WHERE f.user_id = %d';

  $output = $wpdb->get_results(
              $wpdb->prepare($query, [$id]),
              'ARRAY_A'
            );

  $user_photo = pc_get_user_image( $output[0]['photo_id'] );

  $output[0]['user_photo'] = $user_photo;

  return $output;
}

function pc_get_current_follow_up_week( $customer_id ){
  global $wpdb;

  $query = 'SELECT
              c.start_date
              FROM `' . $wpdb->prefix . 'pc_customers_tbl` c
              WHERE c.pc_customer_id = ' . $customer_id;

  $output = $wpdb->get_results( $query, 'ARRAY_A' );

  $start_date = $output[0]['start_date'];

  $current_customer_week = pc_get_current_week( $start_date );

  return $current_customer_week;
}

function pc_get_max_follow_up_week( $customer_id ){
  global $wpdb;

  $query = 'SELECT
              MAX(`week`) AS most_recent
              FROM `' . $wpdb->prefix . 'pc_follow_up_tbl`
              WHERE `user_id` = ' . $customer_id;

  $output = $wpdb->get_results( $query, 'ARRAY_A' );

  $max_follow_up_week = $output[0]['most_recent'];

  return $max_follow_up_week;
}
