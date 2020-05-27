<?php
function pc_admin_view_shortcode(){

  //Customer info view

  $admin_view_file      = plugin_dir_path( PC_PLUGIN_URL ) . '/views/pc_admin_view.php';
  $admin_view_template  = file_get_contents( $admin_view_file, true );
  $pc_users             = get_pc_users();
  $admin_view_template  = str_replace( 'PC_USERS_INFO',
                                      $pc_users,
                                      $admin_view_template );

  //Customer registration view

  $user_ids_info        = get_user_ids();
  $admin_view_template  = str_replace( 'USER_IDS',
                                      $user_ids_info,
                                      $admin_view_template );
  $countries            = get_countries();
  $admin_view_template  = str_replace( 'COUNTRIES',
                                      $countries,
                                      $admin_view_template );
  $physical_activities  = get_physical_activities();
  $admin_view_template  = str_replace( 'PHYSICAL_ACTIVITIES',
                                      $physical_activities,
                                      $admin_view_template );
  $goals                = get_goals();
  $admin_view_template  = str_replace( 'GOALS',
                                      $goals,
                                      $admin_view_template );
  $trainings            = get_trainings();
  $admin_view_template  = str_replace( 'TRAININGS',
                                      $trainings,
                                      $admin_view_template );
  $training_areas       = get_training_areas();
  $admin_view_template  = str_replace( 'TRAINING_AREAS',
                                      $training_areas,
                                      $admin_view_template );
  $diets                = get_diets();
  $admin_view_template  = str_replace( 'DIETS',
                                      $diets,
                                      $admin_view_template );

  $pc_users_progress    = get_pc_users_progress();
  $admin_view_template  = str_replace( 'PC_USERS_PROGRESS',
                                      $pc_users_progress,
                                      $admin_view_template );


  return $admin_view_template;

}

//Get pc users from data base
function get_pc_users(){

  global $wpdb;

  ob_start();
  $pc_users = $wpdb->get_results(
    'SELECT pc_customer_id, name FROM ' . $wpdb->prefix . 'pc_customers_tbl'
  );
  ?>
  <label for="pc_user_info">Selecciona un cliente</label>
  <select id="pc_user_info" name="pc_user_info" form="pc_user_select" required>
    <option value="">Selecciona</option>
    <?php foreach( $pc_users as $pc_user ): ?>
      <option value="<?php echo $pc_user->pc_customer_id; ?>">
        <?php echo $pc_user->name; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br>
  <?php

  return ob_get_clean();
}

//Get pc users from data base
function get_pc_users_progress(){

  global $wpdb;

  ob_start();
  $pc_users = $wpdb->get_results(
    'SELECT pc_customer_id, name FROM ' . $wpdb->prefix . 'pc_customers_tbl'
  );
  ?>
  <label for="pc_user_follow_up">Selecciona un cliente</label>
  <select id="pc_user_follow_up" name="pc_user_follow_up">
    <option value="">Selecciona</option>
    <?php foreach( $pc_users as $pc_user ): ?>
      <option value="<?php echo $pc_user->pc_customer_id; ?>">
        <?php echo $pc_user->name; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br>
  <?php

  return ob_get_clean();
}

//Get user ids from data base
function get_user_ids(){

  ob_start();
  $user_ids = get_users( array( 'role'=>'subscriber', 'fields'=>array( 'ID','user_email' ) ) );
  ?>
  <label for="user">Usuario</label>
  <select id="pc_user_id_reg" name="user" form="user_registration_form" required>
    <option value="">Selecciona</option>
    <?php foreach( $user_ids as $user ): ?>
      <option value="<?php echo $user->ID; ?>">
        <?php echo $user->user_email; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br>
  <?php

  return ob_get_clean();
}

//Get countries from data base
function get_countries(){

  global $wpdb;

  ob_start();
  $countries = $wpdb->get_results(
    'SELECT * FROM ' . $wpdb->prefix . 'pc_countries_tbl');
  ?>

  <label for="countries" class="follow-up__label">País</label>
  <select id="country" name="country" form="user_registration_form" required>
  <option value="">Selecciona</option>
  <?php foreach( $countries as $country ): ?>
    <option value="<?php echo $country->id; ?>">
      <?php echo $country->country; ?>
    </option>
  <?php endforeach; ?>
</select>
<br>
  <?php

  return ob_get_clean();
}

//Get physical activities from data base
function get_physical_activities(){

  global $wpdb;

  ob_start();
  $physical_activities = $wpdb->get_results(
    'SELECT * FROM ' . $wpdb->prefix . 'pc_physical_activities_tbl');
  ?>

  <label for="physical_activities" class="follow-up__label">Actividad física</label>
  <select id="physical_activity" name="physical_activity" form="user_registration_form" required>
  <option value="">Selecciona</option>
  <?php foreach( $physical_activities as $physical_activity ): ?>
    <option value="<?php echo $physical_activity->id; ?>">
      <?php echo $physical_activity->activity; ?>
    </option>
  <?php endforeach; ?>
</select>
<br>
  <?php

  return ob_get_clean();
}


//Get goals from data base
function get_goals(){

  global $wpdb;

  ob_start();
  $goals = $wpdb->get_results(
    'SELECT * FROM ' . $wpdb->prefix . 'pc_goals_tbl');
  ?>

  <label for="goals" class="follow-up__label">Objetivo</label>
  <select id="goal" name="goal" form="user_registration_form" required>
  <option value="">Selecciona</option>
  <?php foreach( $goals as $goal ): ?>
    <option value="<?php echo $goal->id; ?>">
      <?php echo $goal->goal; ?>
    </option>
  <?php endforeach; ?>
</select>
<br>
  <?php

  return ob_get_clean();
}

//Get trainings from data base
function get_trainings(){

  global $wpdb;

  ob_start();
  $trainings = $wpdb->get_results(
    'SELECT * FROM ' . $wpdb->prefix . 'pc_trainings_tbl');
  ?>

  <label for="trainings" class="follow-up__label">Tipo de entrenamiento</label>
  <select id="training" name="training" form="user_registration_form" required>
  <option value="">Selecciona</option>
  <?php foreach( $trainings as $training ): ?>
    <option value="<?php echo $training->id; ?>">
      <?php echo $training->training; ?>
    </option>
  <?php endforeach; ?>
</select>
<br>
  <?php

  return ob_get_clean();
}

//Get training areas from data base
function get_training_areas(){

  global $wpdb;

  ob_start();
  $training_areas = $wpdb->get_results(
    'SELECT * FROM ' . $wpdb->prefix . 'pc_training_areas_tbl');
  ?>

  <label for="training_area" class="follow-up__label">Lugar de entrenamieto</label>
  <select id="training_area" name="training_area" form="user_registration_form" required>
  <option value="">Selecciona</option>
  <?php foreach( $training_areas as $training_area ): ?>
    <option value="<?php echo $training_area->id; ?>">
      <?php echo $training_area->area; ?>
    </option>
  <?php endforeach; ?>
</select>
<br>
  <?php

  return ob_get_clean();
}

//Get diets from data base
function get_diets(){

  global $wpdb;

  ob_start();
  $diets = $wpdb->get_results(
    'SELECT * FROM ' . $wpdb->prefix . 'pc_diets_tbl');
  ?>

  <label for="diet" class="follow-up__label">Tipo de dieta</label>
  <select id="diet" name="diet" form="user_registration_form" required>
  <option value="">Selecciona</option>
  <?php foreach( $diets as $diet ): ?>
    <option value="<?php echo $diet->id; ?>">
      <?php echo $diet->diet; ?>
    </option>
  <?php endforeach; ?>
</select>
<br>
  <?php

  return ob_get_clean();
}
