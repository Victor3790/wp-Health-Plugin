<?php
function pc_enqueue(){

  //Styles
  wp_enqueue_style(
    'pc-bootstrap',
    plugins_url( 'assets/css/bootstrap.css', PC_PLUGIN_URL )
  );

  wp_enqueue_style(
    'pc-customer',
    plugins_url( 'assets/css/customer.css', PC_PLUGIN_URL )
  );

  wp_enqueue_style(
    'pc-userView',
    plugins_url( 'assets/css/userView.css', PC_PLUGIN_URL )
  );

  wp_enqueue_style(
    'tab-theme',
    "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
  );

  //Scripts

  //Accordion
  wp_enqueue_script(
    'pc-accordion',
    plugins_url( 'assets/js/accordion.js', PC_PLUGIN_URL ),
    array('jquery','jquery-ui-accordion'),
    '1.0',
    true
  );

  //Tabs
  wp_enqueue_script(
    'pc-tabs',
    plugins_url( 'assets/js/tabs.js', PC_PLUGIN_URL ),
    array('jquery','jquery-ui-tabs'),
    '1.0',
    true
  );

  //DatePicker
  wp_enqueue_script(
    'pc-date-picker',
    plugins_url( 'assets/js/date-picker.js', PC_PLUGIN_URL ),
    array('jquery','jquery-ui-datepicker'),
    '1.0',
    true
  );
  
  //Form validator (jqueryvalidation)
  wp_enqueue_script(
    'pc-form-validator',
    'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js',
    array('jquery'),
    '1.0',
    true
  );

  //User registration form validator
  wp_enqueue_script(
    'pc-user-registration-form-validator',
    plugins_url( 'assets/js/form-validation.js', PC_PLUGIN_URL ),
    array('jquery', 'pc-form-validator'),
    '1.0',
    true
  );

  //Calory calculator
  wp_enqueue_script(
    'pc-calory-calculator',
    plugins_url( 'assets/js/calory-calculator.js', PC_PLUGIN_URL ),
    array('jquery'),
    '1.0',
    true
  );

  //Google charts
  wp_enqueue_script(
    'pc-google-charts',
    'https://www.gstatic.com/charts/loader.js',
    array(),
    '',
    true
  );

  wp_enqueue_script(
    'pc-custom-charts',
    plugins_url( 'assets/js/custom-charts.js', PC_PLUGIN_URL ),
    array('jquery','pc-google-charts'),
    '1.0',
    true
  );

  //Ajax user registration script
  wp_enqueue_script(
    'pc-user-registration',
    plugins_url( 'assets/js/user_registration.js', PC_PLUGIN_URL ),
    array('jquery'),
    '1.0',
    true
  );

  wp_localize_script(
    'pc-user-registration',
    'ajax_object',
    [
      'ajax_url' => admin_url( 'admin-ajax.php' )
    ]
  );

  //Ajax get user information script
  wp_enqueue_script(
    'pc-admin-view-user-info',
    plugins_url( 'assets/js/admin_view_user_info.js', PC_PLUGIN_URL ),
    array('jquery'),
    '1.0',
    true
  );

  wp_localize_script(
    'pc-admin-view-user-info',
    'ajax_user_object',
    [
      'ajax_url' => admin_url( 'admin-ajax.php' )
    ]
  );

  //Ajax get user follow up script
  wp_enqueue_script(
    'pc-admin-view-user-follow-up',
    plugins_url( 'assets/js/admin_view_user_follow_up.js', PC_PLUGIN_URL ),
    array('jquery'),
    '1.0',
    true
  );

  wp_localize_script(
    'pc-admin-view-user-follow-up',
    'ajax_user_object',
    [
      'ajax_url' => admin_url( 'admin-ajax.php' )
    ]
  );

  //Ajax weekly follow up registration script
  wp_enqueue_script(
    'pc-weekly-follow-up-registration',
    plugins_url( 'assets/js/weekly_follow_up_registration.js', PC_PLUGIN_URL ),
    array('jquery'),
    '1.0',
    true
  );

  wp_localize_script(
    'pc_weekly_follow_up_registration',
    'ajax_user_object',
    [
      'ajax_url' => admin_url( 'admin-ajax.php' )
    ]
  );
}
