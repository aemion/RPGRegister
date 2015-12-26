// JS functions (for AJAX) for EmionRegisterBundle
$('.add-reference').on('click', function() {
  $('#test').load(Routing.generate('emion_register_ajax_add_ref_npc')); 
});

$('.del-reference').on('click', function() {
  //alert("test");
  var idPost = $(this).attr('id').substring(4);
  $.get(Routing.generate('emion_register_ajax_del_ref_npc', {id: idPost}), function(data, status, xhr) {
    if(status != "error") {
      $('#'+data).remove();
    }
  });
})
