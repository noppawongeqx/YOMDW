
    var doClick = false;
// function slideSwitch() {
//     if(doClick){
//            clearInterval(refreshIntervalId);
//             setTimeout( function(){doSwitch();doClick=false;refreshIntervalId = setInterval( "slideSwitch()", 5000 );} , 5000 );
//     }else{
//         doSwitch();
//     }
 
    
// }
// function doSwitch()
// {
//    var $active = $('div#hilight-tab-content .tab-pane.active');
//             var $textactive = $('.nav-tab.text-active');

//             var $last = $('div#hilight-tab-content .tab-pane').last();
//             var $next = $active.next();    
//             var $nexttext = $textactive.next();
//             if($active.hasClass('last')){
//                 $next = $('div#hilight-tab-content .tab-pane').first();
//             }
//             if($textactive.hasClass('last')){
//                 $nexttext = $('.nav-tab').first();
//             }


//             $active.fadeOut('slow',function(){
//                 $(this).removeClass('active');
//                 //$textactive.removeClass('text-active');
//                 $('.nav-tab').removeClass('text-active');
//                 $next.fadeIn('slow',function (){
//                      $(this).addClass('active');
//                      $nexttext.addClass('text-active');
//                 });
//             });  
// }
 var refreshIntervalId ;
$(function() {
   //var refreshIntervalId = setInterval( "slideSwitch()", 5000 );
    // jQuery('.nav-tab').click(function(evt){
    //     console.log('click');
    //     doClick = true;
    //     evt.preventDefault();
    //     evt.stopPropagation();
    //     var $active = $('div#hilight-tab-content .tab-pane.active');
    //     var $textactive = $('.nav-tab.text-active');
    //     var $next = $('#img-'+$(this).find('a').data('id'));
    //     var $nexttext  = $('.nav-tab.link-'+$(this).find('a').data('id'));

    //     $textactive.removeClass('text-active');
    //      $nexttext.addClass('text-active');
    //      $active.fadeOut('slow',function(){
    //         $(this).removeClass('active');
    //         $next.fadeIn('slow',function (){
    //              $(this).addClass('active');
    //         });
    //     });
     
    // });
    // jQuery('.match-height').on('mouseover',function(evt){
    //     evt.stopPropagation();
    //     clearInterval(refreshIntervalId);

    // });
    // jQuery('.match-height').on('mouseout',function(evt){
    //     evt.stopPropagation();
    //     clearInterval(refreshIntervalId);
    //     refreshIntervalId = setInterval( "slideSwitch()", 5000 );
    // });
     //this is the useful function to scroll a text inside an element...

    function startScrolling(scroller_obj, velocity, start_from) {
        //bind animation  inside the scroller element
        scroller_obj.bind('marquee', function (event, c) {
            //text to scroll
            var ob = $(this);
            //scroller width
            var sw = parseInt(ob.parent().width());
            //text width
            var tw = parseInt(ob.width());
            //text left position relative to the offset parent
            var tl = parseInt(ob.position().left);
            //velocity converted to calculate duration
            var v = velocity > 0 && velocity < 100 ? (100 - velocity) * 1000 : 5000;
            //same velocity for different text's length in relation with duration
            var dr = (v * tw / sw) + v;
            //is it scrolling from right or left?
            switch (start_from) {
                case 'right':
                    //is it the first time?
                    if (typeof c == 'undefined') {
                        //if yes, start from the absolute right
                        ob.css({
                            left: sw
                        });
                        sw = -tw;
                    } else {
                        //else calculate destination position
                        sw = tl - (tw + sw);
                    };
                    break;
                default:
                    if (typeof c == 'undefined') {
                        //start from the absolute left
                        ob.css({
                            left: -tw
                        });
                    } else {
                        //else calculate destination position
                        sw += tl + tw;
                    };
            }
            //attach animation to scroller element and start it by a trigger
            ob.animate({
                left: sw
            }, {
                duration: dr,
                easing: 'linear',
                complete: function () {
                    ob.trigger('marquee');
                },
                step: function () {
                    //check if scroller limits are reached
                    if (start_from == 'right') {
                        if (parseInt(ob.position().left) < -parseInt(ob.width())) {
                            //we need to stop and restart animation
                            ob.stop();
                            ob.trigger('marquee');
                        };
                    } else {
                        if (parseInt(ob.position().left) > parseInt(ob.parent().width())) {
                            ob.stop();
                            ob.trigger('marquee');
                        };
                    };
                }
            });
        }).trigger('marquee');
        //pause scrolling animation on mouse over
        scroller_obj.mouseover(function () {
            $(this).stop();
        });
        //resume scrolling animation on mouse out
        scroller_obj.mouseout(function () {
            $(this).trigger('marquee', ['resume']);
        });
    };

    //the main app starts here...

    //change the cursor type for each scroller
    $('.scroller').css("cursor", "pointer");

    //settings to pass to function
    var scroller = $('.scrollingtext'); // element(s) to scroll
    var scrolling_velocity = 80; // 1-99
    var scrolling_from = 'right'; // 'right' or 'left'

    //call the function and start to scroll..
    startScrolling(scroller, scrolling_velocity, scrolling_from);



});




   
    //-->
