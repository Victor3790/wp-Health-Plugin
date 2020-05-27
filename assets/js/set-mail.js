(function($){
  $(document).ready(function(){
    $('#pc_user_id').change(function(){
      let mail = $.trim($('#pc_user_id option:selected').html());
      $('#mail').val( mail );
    });
  });
})(jQuery);
