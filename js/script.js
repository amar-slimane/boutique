$(function(){
    $('.button_user').click(function () {
        $('.tableau_user').toggleClass('hidden, shown');
    });
    $('.itembutton').click(function () {
        $('.tableau_articles').toggleClass('hidden, shown');
    });
});
// jQuery.ajax({
//     url: '../classes/class_affichage.php',
//     type: "GET",

// });