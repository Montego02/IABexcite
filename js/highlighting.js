








///////////////////////////////////////////////////////////////////////////////
// active highlighting
var url = window.location.href;
var arrUrl = url.split("/");

var last = arrUrl[arrUrl.length - 1];

var arrLast = last.split("-");
var articleId = arrLast[0];
console.log(articleId);

if (articleId) {

    $('nav a').each(function (i) {
        if ($(this).attr('href').indexOf(articleId) >= 0) {
            $(this).addClass('active');
        }

    });
} else {
    // if no ID we are home
    $('nav li:first-child a').addClass('active');
}



///////////////////////////////////////////////////////////////////////////////
// language highlighting 
// PHP



///////////////////////////////////////////////////////////////////////////////
// scroll effects: 
$(window).scroll(function(){
    //console.log($(window).scrollTop());
   if ($(window).scrollTop() > 20) {
       $('#header').css('top', '0');
   } else {
       $('#header').css('top', '20px');
   }
    
});











///////////////////////////////////////////////////////////////////////////////
// frontpage animations
// MOVED TO CSS
$('xxx.boxHighlights div').hover(
        function () {
            // mouseenter
            $(this).animate({
                zoom: 1.1,
                margin: 0
            }, 200);
//            
//            $(this).find("h2").animate({
//                backgroundColor: '#ed2509'
//            }, 200);



        }, function () {
    // mouseleave
    $(this).animate({
        zoom: 1,
        margin: 15

    }, 200);
});