$(document).ready(function() {  

	var l_eln;
	var token = $('input[name="_token"]').val();

	$.post('/listaELN',{_token:token}, function(data) {	  	

		l_eln = jQuery.parseJSON(data);	

		if ($('#input_catalogo_autocomplete').length == 1) {
			$('#input_catalogo_autocomplete').devbridgeAutocomplete({
				lookup: l_eln,
				minChars: 2,
			});
	  	}

		if ($('#input_autocomplete_busca_exame').length == 1) {
			$('#input_autocomplete_busca_exame').devbridgeAutocomplete({
				lookup: l_eln,
				minChars: 2,
				onSelect: function (suggestion) {
					$('#input_autocomplete_busca_exame').val(suggestion.value);			       	
				}
			});
		}

		if ($('#input_autocomplete_add_exame').length == 1) {
			$('#input_autocomplete_add_exame').devbridgeAutocomplete({
				lookup: l_eln,
				minChars: 2,
				onSelect: function (suggestion) {
					$('#input_autocomplete_add_exame').val('');
					if ($('[data-modal_add_exame='+suggestion.data+']').length == 0) {	
						var nova = $('.linha_exame_escolhido').clone().first();
						nova.find('span').text(suggestion.value);
						nova.addClass('linha_exame_modalAddExames');
						nova.find('input').val(suggestion.data);
						nova.attr('data-modal_add_exame', suggestion.data);
						nova.css('display', 'block');
						nova.appendTo('.env_exame_escolhidos_adicaoExame');
						$('.remove_modal_incluir_exame').bind('click', function(event) {
							$(this).parent().remove();
						});
					}
				}
				
			});
		}
    });   
});	

	

	 

	

