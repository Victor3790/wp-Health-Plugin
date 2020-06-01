<?php
/*
** This function will get the user info for both the admin view and the user view
** The $id argument is either the user id or the customer id, this will depend on
**  whether the function is called from the admin view or the user view
** The $request argument will be 1 if the request comes from the admin view or
**  2 if the request comes from the user view
*/
  function pc_get_customer_info( $id, $request ){
    global $wpdb;

    $query = 'SELECT
                c.pc_customer_id,
                c.name,
                c.mail,
                c.phone,
                p.country,
                c.city,
                c.age,
                c.weight,
                c.height,
                a.activity,
                g.goal,
                c.percent,
                e.training,
                c.days_week,
                t.area,
                c.sports,
                d.diet,
                c.calories,
                c.meals,
                c.intolerances,
                c.supplementation,
                c.user_photo_id,
                c.start_date,
                c.notes
               FROM `' . $wpdb->prefix . 'pc_customers_tbl` c
               JOIN `' . $wpdb->prefix . 'pc_countries_tbl` p
               ON p.id = c.country
               JOIN `' . $wpdb->prefix . 'pc_physical_activities_tbl` a
               ON a.id = c.physical_activity
               JOIN `' . $wpdb->prefix . 'pc_goals_tbl` g
               ON g.id = c.goal
               JOIN `' . $wpdb->prefix . 'pc_trainings_tbl` e
               ON e.id = c.training
               JOIN `' . $wpdb->prefix . 'pc_training_areas_tbl` t
               ON t.id = c.training_area
               JOIN `' . $wpdb->prefix . 'pc_diets_tbl` d
               ON d.id = c.diet ';


    if( $request == 1 ){

      $where_query = 'WHERE c.pc_customer_id = %d';

      $query = $query . $where_query;

      $output = $wpdb->get_results(
        $wpdb->prepare($query, [$id]),
        'ARRAY_A'
      );

      $user_photo = pc_get_user_image( $output[0]['user_photo_id'] );

      $output[0]['user_photo'] = $user_photo;

      $formatted_date = pc_format_date( $output[0]['start_date'] );

      $output[0]['start_date_formatted'] = $formatted_date;

      $current_week = pc_get_current_week( $output[0]['start_date'] );

      $output[0]['current_week'] = $current_week;

      return $output;

    }elseif ( $request == 2 ) {

      $where_query = 'WHERE c.pc_user_id = ' . $id;

      $query = $query . $where_query;

      $output = $wpdb->get_results( $query, 'ARRAY_A' );

      $user_photo = pc_get_user_image( $output[0]['user_photo_id'] );

      $output[0]['user_photo'] = $user_photo;

      $formatted_date = pc_format_date( $output[0]['start_date'] );

      $output[0]['start_date_formatted'] = $formatted_date;

      $current_week = pc_get_current_week( $output[0]['start_date'] );

      $output[0]['current_week'] = $current_week;

      return $output;
    }

  }

  function pc_get_user_image( $user_photo_id ){

    $user_photo = wp_get_attachment_image(
                      $user_photo_id,
                      array ( '400', '400' ),
                      "",
                      array ( 'class'=>'personal__photo' )
                  );

    return $user_photo;

  }

  function pc_format_date( $date ){

    $unix_time = strtotime( $date );

    $formatted_date = strftime( '%e/%m/%Y', $unix_time );

    return $formatted_date;

  }

  function pc_get_current_week( $start_date ){

    $unix_time = strtotime( $start_date );

    $start_week = date( 'W', $unix_time );

    $current_year_week = date( 'W' );

    if( $start_week >= $current_year_week ){
      $current_customer_week = 1;
    }else{
      $current_customer_week = ( $current_year_week - $start_week ) + 1;
    }

    return $current_customer_week;

  }

  
