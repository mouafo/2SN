function receiveMsg() {
    $(".receive-msg").animate({opacity:0.5},1000).animate({opacity:1}, 1000).css({"background-color": "#72b0b3", "color": "white"});
    setTimeout("receiveMsg()",1000);
}

$(document).ready(function(){
   receiveMsg();
});

$('.selectpicker').selectpicker();