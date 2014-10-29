/* Fonction pour afficher la catégorie de la photo */

$('.rollopaque').on('mouseover', function(event){
    $(this).find('.hide-title').stop().fadeIn('slow');
});

$('.rollopaque').on('mouseout', function(event){
    $(this).find('.hide-title').stop().fadeOut('swing');
});

/* Fonction pour afficher les boutons supprimer et annuler lorsqu'on veut supprimer des photos */

$(document).ready(function(){
    $(".delete-control").click(function(){
        $('.delete-pictures').show('swing');
        $('.confirm-delete-pictures').show('swing');
    });
});
