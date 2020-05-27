<?php
  function pc_user_registration(){

    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    if( $_FILES['photo'] == 0 ){
      $json_output = 'Por favor selecciona una foto';
      wp_send_json( $json_output );
    }

    $file_type = wp_check_filetype( $_FILES['photo']['name'] );
    $MIME_type = $file_type['type'];

    if( $MIME_type != 'image/jpeg' && $MIME_type != 'image/png' ){
      $json_output = 'Hay un error con la imagen';
      wp_send_json( $json_output );
    }

    $photo_id = media_handle_upload( 'photo', 0 );

    if( is_wp_error( $photo_id ) ) {
      $result = $photo_id->get_error_message();
      wp_send_json( $result );
    }

    global $wpdb;

    $user_id            = $_POST['pc_user_id'];
    $name               = $_POST['name'];
    $mail               = $_POST['mail'];
    $phone              = $_POST['phone'];
    $country            = $_POST['country'];
    $city               = $_POST['city'];
    $start_date         = $_POST['start_date'];
    $age                = $_POST['age'];
    $sex                = $_POST['sex'];
    $weight             = $_POST['weight'];
    $height             = $_POST['height'];
    $physical_activity  = $_POST['physical_activity'];
    $goal               = $_POST['goal'];
    $percent            = $_POST['percent'];
    $training           = $_POST['training'];
    $days_week          = $_POST['days_week'];
    $training_area      = $_POST['training_area'];
    $sports             = $_POST['sports'];
    $diet               = $_POST['diet'];
    $calories           = $_POST['calories'];
    $meals              = $_POST['meals'];
    $intolerances       = $_POST['intolerances'];
    $supplementation    = $_POST['supplementation'];
    $user_photo_id      = $photo_id;
    $notes              = $_POST['notes'];


    $output = $wpdb->insert(
      $wpdb->prefix . 'pc_customers_tbl',
      [
        'pc_user_id'        => $user_id,
        'name'              => $name,
        'mail'              => $mail,
        'phone'             => $phone,
        'country'           => $country,
        'city'              => $city,
        'age'               => $age,
        'sex'               => $sex,
        'weight'            => $weight,
        'height'            => $height,
        'physical_activity' => $physical_activity,
        'goal'              => $goal,
        'percent'           => $percent,
        'training'          => $training,
        'days_week'         => $days_week,
        'training_area'     => $training_area,
        'sports'            => $sports,
        'diet'              => $diet,
        'calories'          => $calories,
        'meals'             => $meals,
        'intolerances'      => $intolerances,
        'supplementation'   => $supplementation,
        'user_photo_id'     => $user_photo_id,
        'start_date'        => $start_date,
        'notes'             => $notes
      ],
      [
        '%d',
        '%s', '%s', '%s', '%d', '%s' ,
        '%d', '%s', '%f', '%f', '%d', '%d' ,
        '%d', '%d', '%d', '%d', '%s' ,
        '%d', '%d', '%d', '%s', '%s' ,
        '%d', '%s', '%s'
      ]
    );

    if($output == false){
      $json_output = 'Error, intentelo más tarde';
    }else{
      $json_output = 'Usuario registrado';
    }

    wp_send_json( $json_output );

  }
