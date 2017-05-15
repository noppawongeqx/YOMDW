
var current_sessionid = '';
var currentuser=$('#user_id_hidden').html();
var url = "";

var human_scroll = false;

function updateScroll(){
        console.log('update scroll');
   $('#dialog').scrollTop($('#dialog')[0].scrollHeight);
    
}
var chat_item=['<div class="direct-chat-msg  ">',
                        '<div class="chat-scope  #side  ">',
                      '<div class="direct-chat-info clearfix">',
                        '<span class="direct-chat-name pull-left">#name</span>',
                        '<span class="direct-chat-timestamp pull-right">#time</span>',
                      '</div>',
                      '<img class="direct-chat-img" src="#image" alt="message user image"><!-- /.direct-chat-img -->',
                      '<div class="direct-chat-text #color ">',
                        "#message",
                      '</div>',
                      '</div>',
                    '</div>'];
 function urlify(text) {
    var urlRegex = /(https?:\/\/[^\s]+)/g;
    return text.replace(urlRegex, function(url) {
        return '<a href="' + url + '">' + url + '</a>';
    })
    // or alternatively
    // return text.replace(urlRegex, '<a href="$1">$1</a>')
}
function sendViaEmoji(data,e,websocket,currentuser){ 
       var code = e.which; // recommended to use e.which, it's normalized across browsers
        console.log(code);
        if(code==13){
            console.log('enter key');
           var message = $('#chatmessage').val()||$('#chatmessage').data("emojioneArea").getText();
               if(message){
                console.log('emojione to short');
                console.log(emojione.toShort(message));
            message = urlify(message);
                var msg = {
                    from:$('#user_id_hidden').html(),
                    message:emojione.toShort(message),
                    type:"usermsg",
                };
                //convert and send data to server
                websocket.send(JSON.stringify(msg));
                 $('#chatmessage').val('');
             $('.emojionearea-editor').empty();
            }
        } // missing closing if brace
    }
$(document).ready(function(){
    //create a new WebSocket object.
    $('#livechat-full').hide();
    $('#livechat-compact-container').click(function(){
        $('#livechat-full').slideToggle();
        $(this).slideToggle();
    });
    $('#minimize').click(function(e){
            e.preventDefault();
          $('#livechat-full').slideToggle();
          $('#livechat-compact-container').slideToggle();
    });

    var wsUri = "ws://172.16.24.235:9000/daemon.php";   
    var websocket = new WebSocket(wsUri); 
    if(!currentuser){
           url = $('#chat_url').html();
        $.get(url,
         function( data ) {
                $('#dialog').empty();
            for(var i =0; i < data.length ;i++)
            {

                var imgmessage =emojione.toImage(data[i].message);
                template = chat_item;
                template = chat_item.join('\n');
                template = template.replace(/#name/g,data[i].username);
                template = template.replace(/#time/g,data[i].date_formatted);
                template = template.replace(/#message/g,imgmessage);
             
                 if(data[i].username =='administrator'){
                    template = template.replace(/#image/g,'/dw24/assets/images/admin.png');
                }else{
                    template = template.replace(/#image/g,'/dw24/assets/images/users.png');
                }
                var $template = '';
                if(data[i].username==$('#user_id').html()){
                    template = template.replace(/#side/g,'right');
                    template = template.replace(/#offset/g,'col-md-offset-5');
                    template = template.replace(/#color/g,'self-color');
                    $template  = $(template)
                    $template.find('img.direct-chat-img').remove();
                    $template.find('.direct-chat-name').remove();
                }else{

                    template = template.replace(/#side/g,'');
                    template = template.replace(/#offset/g,'');
                    template = template.replace(/#color/g,'');
                    $template  = $(template);
                }

                $('#dialog').append($template);
            }
             $('#chatmessage').emojioneArea({
              
                events: {
                      keyup: function (editor, event) {
                         sendViaEmoji(this.getText(),event,websocket,currentuser);
                      }
                  }

            });

             $('#chatmessage').prop('disabled', false);  
            updateScroll();
        });
    }
    $('#dialog').scroll(function(e) {
        if ($(this).is(':animated')) {
            console.log('scroll happen by animate');
        } else if (e.originalEvent) {
            // scroll happen manual scroll
            human_scroll=true;
             if ($(this).scrollTop()+ $(this).innerHeight() < $(this)[0].scrollHeight) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
             $.doTimeout( 'scroll', 1000, function(){
                human_scroll=false;
             });
        } else {
            // scroll happen by call
            console.log('scroll happen by call');
        }
    });
          
    websocket.onopen = function(ev) { // connection is open 
      
    
        $('#dialog').append('<div class="system_msg">Connected!</div>'); //notify user
         url = $('#chat_url').html();
        $.get(url,
         function( data ) {
                $('#dialog').empty();
            for(var i =0; i < data.length ;i++)
            {

                var imgmessage =emojione.toImage(data[i].message);
                template = chat_item;
                template = chat_item.join('\n');
                template = template.replace(/#name/g,data[i].username);
                template = template.replace(/#time/g,data[i].date_formatted);
                template = template.replace(/#message/g,imgmessage);
             
                 if(data[i].username =='administrator'){
                    template = template.replace(/#image/g,'/dw24/assets/images/admin.png');
                }else{
                    template = template.replace(/#image/g,'/dw24/assets/images/users.png');
                }
                var $template = '';
                if(data[i].username==$('#user_id').html()){
                    template = template.replace(/#side/g,'right');
                    template = template.replace(/#offset/g,'col-md-offset-5');
                    template = template.replace(/#color/g,'self-color');
                    $template  = $(template)
                    $template.find('img.direct-chat-img').remove();
                    $template.find('.direct-chat-name').remove();
                }else{

                    template = template.replace(/#side/g,'');
                    template = template.replace(/#offset/g,'');
                    template = template.replace(/#color/g,'');
                    $template  = $(template);
                }

                $('#dialog').append($template);
            }
             $('#chatmessage').emojioneArea({
              
                events: {
                      keyup: function (editor, event) {
                         sendViaEmoji(this.getText(),event,websocket,currentuser);
                      }
                  }

            });

             $('#chatmessage').prop('disabled', false);  
            updateScroll();
        });
      // var initMSG = {
        //     type:'system',
        //     method:'init_session',
        //     key:currentuser,
        // }
        // websocket.send(JSON.stringify(initMSG));
       
    }

    $('#btn-chat').click(function(){ //use clicks message send button     
        //prepare json data
       var message = $('#chatmessage').val()||$('#chatmessage').data("emojioneArea").getText();

       console.log('message '+message);
        //prepare json data
        if(message){
            console.log('message2'+message);
            message = urlify(message);
            var msg = {
                from:$('#user_id_hidden').html(),
                message:emojione.toShort(message),
                type:"usermsg",
            };

            console.log('msg');
            console.log(msg);
            //convert and send data to server
            websocket.send(JSON.stringify(msg));
                 $('#chatmessage').val('');
                $('.emojionearea-editor').empty();
        }
    });
    $("#chatmessage").keyup(function(e){ 
        var code = e.which; // recommended to use e.which, it's normalized across browsers
        console.log(code);
        if(code==13){
            console.log('enter key');
           var message = $('#chatmessage').val()||$('#chatmessage').data("emojioneArea").getText();
               if(message){
                console.log('emojione to short');
                console.log(emojione.toShort(message));
            message = urlify(message);
                var msg = {
                    from:$('#user_id_hidden').html(),
                    message:emojione.toShort(message),
                    type:"usermsg",
                };
                //convert and send data to server
                websocket.send(JSON.stringify(msg));
                 $('#chatmessage').val('');
             $('.emojionearea-editor').empty();
            }
        } // missing closing if brace
    });
 
    //#### Message received from server?
    websocket.onmessage = function(ev) {
        var msg = JSON.parse(ev.data); //PHP sends Json data
        console.log(msg);
        if(msg.type == 'usermsg' && msg.from) 
        {
                var imgmessage =emojione.toImage(msg.message);
                var template = chat_item.join('\n');
                template = template.replace(/#name/g,msg.from);
                template = template.replace(/#time/g,moment.unix(msg.timestamp).format('D MMM YYYY HH:mm:ss'));
                template = template.replace(/#message/g,imgmessage);
                if(msg.from =='administrator'){
                    template = template.replace(/#image/g,'/dw24/assets/images/admin.png');
                }else{
                    template = template.replace(/#image/g,'/dw24/assets/images/users.png');
                }
                 var $template = '';
                if(msg.from==$('#user_id').html()){
                    template = template.replace(/#side/g,'right');
                    template = template.replace(/#offset/g,'col-md-offset-5');
                    template = template.replace(/#color/g,'self-color');
                    $template  = $(template)
                    $template.find('img.direct-chat-img').remove();
                    $template.find('.direct-chat-name').remove();
                }else{

                    template = template.replace(/#side/g,'');
                    template = template.replace(/#offset/g,'');
                    template = template.replace(/#color/g,'');
                    $template  = $(template);

                    var audio = new Audio('/dw24/assets/sounds/sound.mp3');
                    audio.play();
                }

                $('#dialog').append($template);
                  if(!human_scroll){
                    updateScroll();
                }
            
        }
        // if(msg.type == 'system')
        // {

        //     if(msg.method = 'init_session'){
        //         current_sessionid = msg.session_id;
        //     }else{
        //          //prepare json data
        //         $('#message_box').append('<div class="system_msg">'+msg.message+'</div>');
        //     }
        // }
        
        $('#message').val(''); //reset text
    };
    
    websocket.onerror   = function(ev){$('#message_box').append('<div class="system_error">Error Occurred - '+ev.data+'</div>');}; 
    websocket.onclose   = function(ev){$('#message_box').append('<div class="system_msg">Connection Closed</div>');}; 
});
function bottomFunction() {
   $('#dialog').scrollTop($('#dialog')[0].scrollHeight);
   human_scroll = false;
}