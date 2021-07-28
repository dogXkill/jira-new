<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>
<script type="text/javascript" src="assets/js/CometServerApi.js" ></script>
<script type="text/javascript" src="https://comet-server.ru/doc/html_chat.js" ></script>
<link rel="stylesheet" type="text/css" href="https://comet-server.ru/doc/html_chat.css"></link>

<!-- Осталось настроить сам чат и запустить, для этого пишем небольшой скрипт. -->
<div id="html-chat"></div>
<div id="web_chat_holder"></div>
<style>
/* Здесь настроим css стили для чата*/
.holder-html-chat{ padding:10px;background-color: #fff;width: 100%;}
.html-chat-history , #WebChatFormForm{ max-width: 100%; overflow: auto;max-height:450px; padding: 5px;}
.html-chat-js-name{ margin-top:10px; }
.html-chat-js-input ,#WebChatTextID{ max-width: 100%;max-height: 100px;width: 100%;margin-top:10px; }
.html-chat-js-button-holder{ margin-bottom: 0px;margin-top: 10px; }
.html-chat-js-button-holder input{ width: 220px; }
.html-chat-js-answer{ float:right; display: none;}
.html-chat-js-answer a{ color: #777;font-size: 12px; font-family: cursive;}
.html-chat-js-answer a:hover{ color: #338;font-size: 12px; font-family: cursive;}
.html-chat-msg{ margin: 0px; }
#WebChatNameID{display: none;}
.html-chat-history p , #WebChatFormForm p{float: none!important;color:black;opacity:1; }
.red_text{color:red;}
.green_text{color:green;}
.grey_text{
  font-size: 0.9em!important;
    color: grey!important;
    font-style: italic!important;
    font-weight: 900!important;
}

.message{
  padding: 0 0 30px 58px;
    clear: both;
    margin-bottom: 45px;
}
.message.right {
    padding: 0 58px 30px 0;
    margin-right: -19px;
    margin-left: 19px;
}
.message.right .bubble {
    float: right;
    border-radius: 5px 5px 0px 5px;
    background: #32b3e4;
    color: white;
}
.message img{
  float: left;
    margin-left: -38px;
    border-radius: 50%;
    width: 30px;
    margin-top: 12px;
}
.message.right img {
    float: right;
    margin-left: 0;
    margin-right: -38px;
}
.message .bubble {
    background: #d7d8d8;
    font-size: 13px;
    font-weight: 600;
    padding: 12px 13px;
    border-radius: 5px 5px 5px 0px;
    color: #2595f1;
    position: relative;
    float: left;
}
#WebChatFormForm{
  padding-right: 20px;
}
#sendmessage {
    height: 60px;
    border-top: 1px solid #e7ebee;
    position: absolute;
    bottom: 0;
    right: 0px;
    width: 100%;
    background: #fff;
    padding-bottm: 50px;
}
#sendmessage textarea {
    background: #fff;
    margin: 13px 0 0 21px;
    border: none;
    padding: 0;
    font-size: 14px;
    font-family: "Open Sans", sans-serif;
    font-weight: 400;
    color: #333333;
}
#sendmessage input[type="button"] {
    /* background: #fff url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/send.png) 0 -41px no-repeat; */
    background: #fff url(chat/corner-up-left.svg) no-repeat;
    width: 30px!important;
    height: 30px;
    position: absolute;
    right: 15px;
    top: 23px;
    border: none;
}
#sendmessage textarea:focus {
    outline: 0;
}
</style>

<script>

    var timer = new Date();
function web_send_msg()
{
    // Получение значений из элементов ввода.
    var text = $("#WebChatTextID").val();
    // var name = $("#WebChatNameID").val();
    var name="<?php echo $_SESSION['name'];?>";

    // Очистка формы
    $("#WebChatTextID").val("");

    // Зпишем время в момент отправки сообщения
    timer = new Date();

    // Добавление отправленного сообщения к списку сообщений.
    //$("#WebChatFormForm").append("<p><b>"+HtmlEncode(name)+": </b>"+HtmlEncode(text)+"</p>");

    // Отправка сообщения в канал чата
    CometServer().web_pipe_send("web_chat_pipe", {"text":text, "name":name});

    // Уведомим остальные вкладки о том что мы добавили сообщение в чат
    comet_server_signal().send_emit("AddToChat", {"text":text, "name":name})
}


// Функция выполнится в после загрузки страницы
$(document).ready(function()
{
  CometServer().start({dev_id: 3536 }) // Идентификатор разработчика на comet-server.ru
    // Создание формы для чата. Вёрстка.
    var html =  "<div style=\"padding:10px;\" >"
	          + "<div id=\"WebChatFormForm\" style=\"overflow: auto;\"></div>"
		  + "<input type=\"text\" id=\"WebChatNameID\" style=\"margin-top:10px;\" placeholder=\"Укажите ваше имя...\" > <div id=\"answer_div\" style=\"float:right;\" ></div>"
            +"<div id='sendmessage'>"
            + "<textarea id = \"WebChatTextID\" placeholder = \"Ввод...\" ></textarea>"

                  //+ "<div style=\"margin-bottom: 0px;margin-top: 10px;\">"
                  +    "<input type=\"button\" style=\"width: 220px;\" onclick=\"web_send_msg();\"  >"
                  //+    " <div id=\"answer_error\"  style=\"float:right;\" ></div>"
                  //+ "</div>"
            +"</div>"
             +  "</div>";
    $("#web_chat_holder").html(html);

    // Подписываемся на канал в который и будут отпавлятся сообщения чата.
    CometServer().subscription("web_chat_pipe", function(msg){
        //console.log(["msg", msg]);
        // Добавление полученого сообщения к списку сообщений.
        var dop_class="black";
        var name_ac="<?php echo $_SESSION['name'];?>";
      //  console.log(msg.data.name);

            if (msg.data.name==name_ac){
               dop_class="green_text";
               vid_sms='right';
              //console.log("test:"+$(this).text());
            }else{
              dop_class="red_text";
              vid_sms='';
            }
            //+HtmlEncode(msg.data.name)+
        $("#WebChatFormForm").append("<div class='message "+vid_sms+"'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg'><div class='bubble'>"+HtmlEncode(msg.data.text)+"</div></div>");//выгрузка всех сообщений
        var div = $("#WebChatFormForm");
        div.scrollTop(div.prop('scrollHeight'));
    });

    // Подписываемся на событие добавления сообщения в чат нами, для того чтобы если чат открыт в нескольких вкладках
    // наше сообщение добавленое на одной вкладке отобразилось на всех остальных без перезагрузки страницы
    comet_server_signal().connect("AddToChat", function(msg){
        // console.log(["msg", msg]);
        var dop_class="black";
        var name_ac="<?php echo $_SESSION['name'];?>";
      //  console.log(msg.data.name);

      if (msg.name==name_ac){
         dop_class="green_text";
         vid_sms='right';
        //console.log("test:"+$(this).text());
      }else{
        dop_class="red_text";
        vid_sms='';
      }
        // Добавление полученого сообщения к списку сообщений.
        $("#WebChatFormForm").append("<div class='message "+vid_sms+"'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg'><div class='bubble'>"+HtmlEncode(msg.text)+"</div></div>");//выгрузка всех сообщений

        //$("#WebChatFormForm").append("<p><b class='"+dop_class+"'>"+HtmlEncode(msg.name)+": </b>"+HtmlEncode(msg.text)+"</p>");
        var div = $("#WebChatFormForm");
        div.scrollTop(div.prop('scrollHeight'));
    });

    // Подписываемся на канал в который и будут отпавлятся уведомления о доставке отправленых сообщений.
    CometServer().subscription("#web_chat_pipe", function(p)
    {
        // Зпишем время в момент получения отчёта о доставке сообщения
        var etime = new Date();

        console.log(["answer_to_web_chat_pipe", p]);
        //$("#answer_div").html("Сообщение доставлено "+p.data.number_messages+" получателям за "+ (etime.getTime() - timer.getTime() )+"ms");
        $("#answer_error").html(" "+p.data.error);
        // var name_ac="<?php echo $_SESSION['name'];?>: ";
        // $('#WebChatFormForm > p >b').each(function(i){
        //
        //     if ($(this).text()==name_ac){
        //        $(this).css("color",'green');
        //       //console.log("test:"+$(this).text());
        //     }else{
        //       $(this).css("color",'red');
        //       console.log("test:"+$(this).text()+"/"+name_ac);
        //     }
        //   });
    });

   // Загружаем историю сообщений
   CometServer().get_pipe_log("web_chat_pipe");
   // var name_ac="<?php echo $_SESSION['name'];?>: ";
   // $('#WebChatFormForm > p >b').each(function(i){
   //
   //     if ($(this).text()==name_ac){
   //        $(this).css("color",'green');
   //       //console.log("test:"+$(this).text());
   //     }else{
   //       $(this).css("color",'red');
   //       console.log("test:"+$(this).text()+"/"+name_ac);
   //     }
   //   });
     cometApi.subscription("track_online.subscription", function(msg)
      {
    //     var currentdate = new Date();
    // var datetime = + currentdate.getDate() + "/"
    //             + (currentdate.getMonth()+1)  + "/"
    //             + currentdate.getFullYear() + "  "
    //             + currentdate.getHours() + ":"
    //             + currentdate.getMinutes() + ":"
    //             + currentdate.getSeconds();
    //
    //
    //     // console.log(msg);
    //     var name_ac="<?php echo $_SESSION['name'];?>";
    //     if (name_ac=="Слава"){name_vxod="Майкл";}else{name_vxod="Слава";}
    //     $("#WebChatFormForm").append("<p class='grey_text'><b >"+HtmlEncode(name_vxod)+": </b>"+HtmlEncode('зашёл в чат!')+" "+datetime+"</p>");
    //     var div = $("#WebChatFormForm");
    //     div.scrollTop(div.prop('scrollHeight'));
        // alert("0");
          // Обработка события что кто то зашёл на сайт и подписался на канал track_online
      });
      cometApi.subscription("track_online.unsubscription", function(msg)
      {
    //     var currentdate = new Date();
    // var datetime = + currentdate.getDate() + "/"
    //             + (currentdate.getMonth()+1)  + "/"
    //             + currentdate.getFullYear() + "  "
    //             + currentdate.getHours() + ":"
    //             + currentdate.getMinutes() + ":"
    //             + currentdate.getSeconds();
    //
    //
    //     // console.log(msg);
    //     var name_ac="<?php echo $_SESSION['name'];?>";
    //     if (name_ac=="Слава"){name_vxod="Майкл";}else{name_vxod="Слава";}
    //     $("#WebChatFormForm").append("<p class='grey_text'><b >"+HtmlEncode(name_vxod)+": </b>"+HtmlEncode('вышел из чата!')+" "+datetime+"</p>");
    //     var div = $("#WebChatFormForm");
    //     div.scrollTop(div.prop('scrollHeight'));
          // Обработка события что кто-то покинул сайт и/или отписался от канала track_online
      });
});


function HtmlEncode(s)
{
  var el = document.createElement("div");
  el.innerText = el.textContent = s;
  s = el.innerHTML;
  return s;
}
</script>
<!-- https://comet-server.com/wiki/doku.php/comet:simple-chat-example -->
