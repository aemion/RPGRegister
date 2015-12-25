// JS functions (for AJAX) for EmionRegisterBundle
$('.add-reference').on('click', function() {
  $('#test').load(Routing.generate('emion_register_add_ref_npc', true)); 
});
