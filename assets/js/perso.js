/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    // on masque la zone
    $("#Creerunmatch").hide();
    // on ajoute le texte cliquable et on y met un attribut pour savoir si on est masqué ou affiché
    $("#ZoneDeCliq").html("<p>Clique ici pour ajouter un match</p>")
    .attr("statut","1")
    .click(function(){
        $("#Creerunmatch").slideToggle("slow");
        // selon le statut on renomme le texte
        if ($("#ZoneDeCliq").attr("statut")=="1"){
            $("#ZoneDeCliq").html("<p>Crée un match!</p>").attr("statut","0");
        }
        else{
            $("#ZoneDeCliq").html("<p>Clique ici pour ajouter un match</p>").attr("statut","1");
        };
    });
});

$(document).ready(function(){
    // on masque la zone
    $("#TexteAAfficher").hide();
    // on ajoute le texte cliquable et on y met un attribut pour savoir si on est masqué ou affiché
    $("#ZoneDeClic").html("<p>Clique ici pour changer ton mot de passe</p>")
    .attr("statut","1")
    .click(function(){
        $("#TexteAAfficher").slideToggle("slow");
        // selon le statut on renomme le texte
        if ($("#ZoneDeClic").attr("statut")=="1"){
            $("#ZoneDeClic").html("<p>Change ton mot de passe</p>").attr("statut","0");
        }
        else{
            $("#ZoneDeClic").html("<p>Clique ici pour changer ton mot de passe</p>").attr("statut","1");
        };
    });
});


$(document).ready(function(){
    // on masque la zone
    $("#ajouteressai").hide();
    // on ajoute le texte cliquable et on y met un attribut pour savoir si on est masqué ou affiché
    $("#ZoneDeClique").html("<p>Clique ici pour ajouter des essais</p>")
    .attr("statut","1")
    .click(function(){
        $("#ajouteressai").slideToggle("slow");
        // selon le statut on renomme le texte
        if ($("#ZoneDeClique").attr("statut")=="1"){
            $("#ZoneDeClique").html("<p>Remplis les champs</p>").attr("statut","0");
        }
        else{
            $("#ZoneDeClique").html("<p>Clique ici pour ajouter des essais</p>").attr("statut","1");
        };
    });
});








$('.single-slider').jRange({
    from: 1,
    to: 15,
    step: 1,
    scale: [1,8,15],
    format: '%s',
    width: 300,
    showLabels: true,
    snap: true
});

$(function() {
	$('a[data-confirm]').click(function(ev) {
		var href = $(this).attr('href');
		
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Non</button><a class="btn btn-danger" id="dataConfirmOK">Oui</a></div></div></div></div>');
		}
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmOK').attr('href', href);
		$('#dataConfirmModal').modal({show:true});
		
		return false;
	});
});




//RANGE
$(function() {
	$('.range').next().text('--'); // Valeur par défaut
	$('.range').on('input', function() {
		var $set = $(this).val();
		$(this).next().text($set);
	});
});




