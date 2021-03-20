var spinner = $('#')
//FUNÇÂO DO FECHA O MENSAGEM DE ERRO
function close_erro() {
  var x = document.getElementById('derro');
  x.style.display = 'none';
}

//FUNÇÔES PARA O MENU MULTINÍVEL
// Prevent closing from click inside dropdown
// jquery ready start
$(document).ready(function() {
	// jQuery code
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
    });

    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
	  	$('.dropdown-menu a').click(function(e){
	  		e.preventDefault();
	        if($(this).next('.submenu').length){
	        	$(this).next('.submenu').toggle();
	        }
	        $('.dropdown').on('hide.bs.dropdown', function () {
			   $(this).find('.submenu').hide();
			})
	  	});
	}
	
}); // jquery end
//FIM DAS FUNÇÔES DO MENU

