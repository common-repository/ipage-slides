var current = new Object();
var initialize_time = '';

var slideCount = new Object();
var status_slides = new Object();
var speed = new Object();
var name='';
(function($) {
    $.page_slide_switch= {
        defaults:{
            content : '',
            container: 'slide_containers',
            path:'',
            containerStyle : 'padding:10px 5%;width: 470px;height: 220px;background-color: #000;color:#fff;font-size:20px;font-weight:bold;',
            startSlide:function(){},
            prevSlide:function(){},
            stopSlide:function(){},
            nextButtonSlide:function(){}
        },
        init:function(optionsd) {
            var options = $.extend($.page_slide_switch.defaults, optionsd);

        

            

            var contain_id = options.container;
            name = options.container;
            current[name] = 0;
            status_slides[name] = 1;
            slideCount[name] = options.content.length - 1;
            speed[name] = options.slideSpeed;
           
            var htm = '';

            for (i=0;i<options.content.length;i++){
                if(i==0){
                    htm += "<div id='sli0"+options.container+"' style='"+options.containerStyle+"'>"+options.content[i]+"</div>";
                }else{
                    htm += "<div id='sli"+i+options.container+"' style='display:none;"+options.containerStyle+"'>"+options.content[i]+"</div>";
                }

            }

            if(options.buttonStatus == 'yes'){
                htm += "<div id='single-page-slider-nav'><center><img id='prev_slide"+options.container+"' name='"+options.container+"' src='"+options.path+"/images/prev.png' />";
                htm += "<img id='start_switch"+options.container+"' name='"+options.container+"' src='"+options.path+"/images/play.png' />";
                htm += "<img id='stop_switch"+options.container+"' name='"+options.container+"' src='"+options.path+"/images/stop.png' />";
                htm += "<img id='next_slide"+options.container+"' name='"+options.container+"' src='"+options.path+"/images/next.png' /></center>";
                htm += "</div>";
            }

            $('#'+options.container).html(htm);
            $.page_slide_switch.startSlide(options.container);

            $('#start_switch'+options.container).click(function() {
                
                status_slides[$(this).attr('name')] = 1;
                $.page_slide_switch.startSlide($(this).attr('name'));
            });

            $('#stop_switch'+options.container).click(function() {

                $.page_slide_switch.stopSlide($(this).attr('name'));
            });

            $('#prev_slide'+options.container).click(function() {
                status_slides[$(this).attr('name')] = 1;
                $.page_slide_switch.prevSlide($(this).attr('name'));
            });

            $('#next_slide'+options.container).click(function() {
           
                $.page_slide_switch.nextSlide($(this).attr('name'));
            });


			
        },
        startSlide:function(name) {

          

            if(status_slides[name]==0){
                return;
            }
            $("#sli"+current[name]+name).css('display','none');
            current[name]++;
            if(current[name]>slideCount[name]){
                current[name] = 0;
            }

            $("#sli"+current[name]+name).css('display','block');



            initialize_time = setTimeout(function() {
                $.page_slide_switch.startSlide(name);
            }, speed[name]);
        },
        nextSlide:function(name) {

            status_slides[name] = 1;
            if(status_slides[name]==0){
                return;
            }

            $("#sli"+current[name]+name).css('display','none');
            current[name]++;
                        
            if(current[name]>slideCount[name]){
                current[name] = 0;
            }

            $("#sli"+current[name]+name).css('display','block');
        },
        stopSlide:function(name) {

            status_slides[name] = 0;

        },
        prevSlide:function(name) {

            status_slides[name] = 1;
            if(status_slides[name]==0){
                return;
            }
			
            $("#sli"+current[name]+name).css('display','none');

            current[name]--;
            if(current[name]<0){
                current[name] = slideCount[name];
            }

            $("#sli"+current[name]+name).css('display','block');
        }
    };
})(jQuery);





