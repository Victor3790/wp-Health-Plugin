(function($){
  $(document).ready(function(){
    $( '#pc_user_follow_up' ).change( function() {

      var pc_user_follow_up = {
        action:     'pc_admin_view_follow_up',
        pc_user_id: $( '#pc_user_follow_up' ).val()
      }

      $.ajax({
        url: ajax_user_object.ajax_url,
        data: pc_user_follow_up,
        method: 'POST',
        success: on_success_user_follow_up,
        error: on_error_user_follow_up
      });

    } );

    function on_success_user_follow_up(user_data){
      console.log(user_data);
      //$('#pc_user_name').text( user_data[0].name );
    }


    function on_error_user_follow_up(){
      console.log('Could not get the user weekly follow up');
    }

  } );
})(jQuery);
