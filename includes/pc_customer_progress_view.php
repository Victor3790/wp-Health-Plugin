<?php
  function pc_customer_progress_view(){

    $user_id = $_POST['pc_user_id'];

    $output = pc_get_customer_progress( $user_id );

    wp_send_json( $output );

  }
