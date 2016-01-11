var t;
var start = $('#myCarousel').find('div.carousel-inner').find('div.item.active').attr('data-interval');
t = setTimeout(function (){$('#myCarousel').carousel('next');}, start);
$('#myCarousel').on('slid.bs.carousel', function () {   
    clearTimeout(t);  
    var duration = $('#myCarousel').find('div.carousel-inner').find('div.item.active').attr('data-interval');
    t = setTimeout(function(){$('#myCarousel').carousel('next');}, duration);
});