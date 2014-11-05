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

/*
$(document).ready(function(){
    $(".complete-profil-button").mouseover(function(){
        $(".img-complete-profil").stop().animate({left:'30px'}).show('slow');
        $(".link-complete-profil").stop().hide("fast");
    });
    $(".complete-profil-button").mouseout(function(){
        $(".img-complete-profil").stop().hide("fast");
        $(".link-complete-profil").stop().animate({left:'30px'}).show('fast');
    });
});
*/
/*
$(document).ready(function(){
    var is_connected = $(".know-status");

    if (is_connected.length){
        $('.connect-status').show('slow');
        $('.connect-button').hide('fast');
    }
});
*/