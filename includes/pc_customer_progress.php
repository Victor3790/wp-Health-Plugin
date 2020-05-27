<?php
/*
** This function will get the customer progress for both the admin view and the user view
** The $id argument is the customer id,
** The $request argument will be 1 if the request comes from the admin view or
**  2 if the request comes from the user view
*/
  function pc_get_customer_progress( $id ){

    global $wpdb;

    $query = 'SELECT
               week,
               weight
               FROM `' . $wpdb->prefix . 'pc_follow_up_tbl`
               WHERE `user_id` = ' . $id;

    $output = $wpdb->get_results( $query, 'ARRAY_A' );

    return $output;

}
