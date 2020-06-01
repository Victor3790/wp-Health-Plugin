<?php
//Get the user info for the admin view
  function pc_admin_view_info(){

    $user_id = $_POST['pc_user_id'];

    $output = pc_get_customer_info( $user_id, 1 );

    wp_send_json( $output );

  }

//Get the user weekly follow up for the admin view
  function pc_admin_view_follow_up(){

    $user_id = $_POST['pc_user_id'];

    $output = pc_get_weekly_follow_up( $user_id );

    wp_send_json( $output );

  }

//Inactivate customer
  function pc_inactive_customer(){

    $output = 'success!!!!';

    wp_send_json( $output );

  }
