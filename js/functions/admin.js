
var pageid=0;
var languageid=0;



function language_init() {
        var i=0;
        $.ajax({
            type: "POST",
            url: "../php/handlers/languageinit.php",
            data: "",
            cache: false,
            success: function(resp){
                languageid=resp;
                show_interface(1);
            }
        });
}

function login_ajax(){
    $("#login_butt").click(function() {
        $.cookie('username_vig', $("#username").val(), { expires: 1 });
        $.cookie('pass_vig', $("#password").val(), { expires: 1 });
        $.ajax({
            type: "POST",
            url: "../php/handlers/login.php",
            data: "username="+$("#username").val()+"&password="+$("#password").val(),
            cache: false,
            success: function(resp){
                if (resp=="yes") {
                    
                    show_interface(1);
                    show_menu();
                    
                } else {
                    $("#resp1").html("Pogrešno korisničko ime ili lozinka");
                }
            }
        });   
    });
}

function check_ajax() {
    if($.cookie('username_vig') && $.cookie('pass_vig')){
    $.ajax({
            type: "POST",
            url: "../php/handlers/login.php",
            data: "username="+$.cookie('username_vig')+"&password="+$.cookie('pass_vig'),
            cache: false,
            success: function(resp){
                if (resp=="yes") {
                    language_init();
                    show_menu();
                    $.cookie('username_vig', $.cookie('username_vig'), { expires: 1 });
                    $.cookie('pass_vig', $.cookie('pass_vig'), { expires: 1 });
                }
            }
    });}
}

function show_menu(){
        $.ajax({
            type: "POST",
            url: "../php/handlers/menu.php",
            data: "language="+languageid,
            cache: false,
            success: function(resp){
                $("#menu").html(unescape(resp));
            }
        });   
}

function show_interface(page_id) {
    var a="";
    $.ajax({
            type: "POST",
            url: "../php/handlers/show_post_list.php",
            data: "page_id="+page_id,
            cache: false,
            success: function(resp){
                $("#container").html(
                    
                    '<div id="main">'+
                    '<div id="box1">'+
                    
                        '<div id="buttonholder">'+
                        '<button id="addew" onclick="show_form()">Dodaj novi post</button>'+
                        '<button id="addew" onclick="openlinkimage()">Slike</a></button>'+
                        '<button id="addew" onclick="openlinkdata()">Datoteke</button>'+
                        '<button id="addew" onclick="show_pages(0)">Stranice</button>'+
                        '<button id="addew" onclick="show_languages()">Jezici</button>'+
                        '</div>'+
                       
                    resp+
                    '</div>'+
            
                    '</div>'
                );
                show_menu();
                $("#footer").html('<iframe width="640" height="480" src="http://www.youtube.com/embed/OJiGsZMJtH4" frameborder="0" allowfullscreen></iframe>');       
            }
    });   
    
    
    
    
}

function navigation() {
    
}

function show_posts() {
    $.ajax({
            type: "POST",
            url: "../php/handlers/show_post_list.php",
            data: "",
            cache: false,
            success: function(resp){
                if (resp=="yes") {
                    show_interface();
                    show_menu();
                } else {
                    $("#resp1").html("Pogrešno korisničko ime ili lozinka");
                }
            }
        }); 
}

function show_form() {
    $.ajax({
                type: "POST",
                url: "../php/handlers/show_form.php",
                data: "",
                cache: false,
                success: function(resp){
                    $("#box1").html(resp);
                    }
            }); 
}


function new_post() {

        $.ajax({
            type: "POST",
            url: "../php/handlers/form_post.php",
            data: "",
            cache: false,
            success: function(resp){
                    $("#box1").html(resp)
            }
        }); 
        
}

function submit_post() {
    var i;
    var title='';
    var text='';
    for(i=1; i<30; i++) {
        if($("#posttext"+i).html()=="") {
            title+=i+"|"+escape($("#posttitle"+i).val())+"|";
            text+=i+"|"+escape($("#posttext"+i).val())+"|";
        }
    }
    
    $.ajax({
            type: "POST",
            url: "../php/handlers/submit_post.php",
            data: "title="+title+"&content="+text+"&page="+$("#pageid").val()+"&type="+$("#posttype").val(),
            cache: false,
            success: function(resp){
                    alert(resp);
            }
        }); 
}

function delete_post(post_id) {
    var answer = confirm ("Da li ste sigurni da želite obrisati post?")
    if (answer) {
        $.ajax({
                type: "POST",
                url: "../php/handlers/delete_post.php",
                data: "post="+post_id,
                cache: false,
                success: function(resp){
                    alert(resp);
                    $("#"+post_id).toggle();
                    }
            }); 
    }
}
    
function show_change_post(post_id) {

    $.ajax({
                type: "POST",
                url: "../php/handlers/show_change_post.php",
                data: "post="+post_id,
                cache: false,
                success: function(resp){
                    $("#box1").html(unescape(resp));
                    }
            }); 
}

function change_post(post_id) {
    var i;
    var title='';
    var text='';
    for(i=1; i<50; i++) {
        if($("#posttext"+i).val()) {
            title+=i+"|"+escape($("#posttitle"+i).val())+"|";
            text+=i+"|"+escape($("#posttext"+i).val())+"|";
            
        }
    }
    $.ajax({
            type: "POST",
            url: "../php/handlers/change_post.php",
            data: "title="+title+"&content="+text+"&page="+$("#pageid").val()+"&type="+$("#posttype").val()+"&post="+post_id,
            cache: false,
            success: function(resp){
                    alert(resp);
            }
        }); 
}

function show_data() {
    $.ajax({
            type: "POST",
            url: "../php/handlers/show_data_list.php",
            data: "",
            cache: false,
            success: function(resp){
                $("#box1").html(
                    unescape(resp)
                );
                
            }
    });   
}

function delete_data(data_id) {
    var answer = confirm ("Da li ste sigurni da želite obrisati datoteku?")
    if (answer) {
        $.ajax({
                type: "POST",
                url: "../php/handlers/delete_data.php",
                data: "data="+data_id,
                cache: false,
                success: function(resp){
                    alert(resp);
                    $("#"+data_id).toggle();
                    }
            }); 
    }
}

function show_images() {
    $.ajax({
            type: "POST",
            url: "../php/handlers/show_image_list.php",
            data: "",
            cache: false,
            success: function(resp){
                $("#box1").html(
                    resp
                );
                
            }
    });   
}

function delete_image(image_id) {
    var answer = confirm ("Da li ste sigurni da želite obrisati sliku?")
    if (answer) {
        $.ajax({
                type: "POST",
                url: "../php/handlers/delete_image.php",
                data: "image="+image_id,
                cache: false,
                success: function(resp){
                    alert(resp);
                    $("#"+image_id).toggle();
                    }
            }); 
    }
}

function close_screen() {
    $("#screen").css("visibility", "transparent");
    $("#screen").css("height", "1px");
    $("#screen").html('');

}

function show_connect_image(postid) {
    $.ajax({
            type: "POST",
            url: "../php/handlers/show_image_connect_list.php",
            data: "postid="+postid,
            cache: false,
            success: function(resp){
                $("#screen").html('<button onclick="close_screen()">X</button><div id="box1">'+resp+'</div>');
                
            }
    });   
    $("#screen").css("height", $("body").css("height"));
    $("#screen").css("visibility", "visible");
}

function connect_image(imgid, postid) {
    $.ajax({
            type: "POST",
            url: "../php/handlers/connect_image.php",
            data: "postid="+postid+"&imgid="+imgid+"&width="+$("#width"+imgid).val()+"&kind="+$("#kind"+imgid).val(),
            cache: false,
            success: function(resp){
                show_connect_image(postid);
                
            }
    });  
}

function disconnect_image(imgid,postid){
    $.ajax({
            type: "POST",
            url: "../php/handlers/disconnect_image.php",
            data: "postid="+postid+"&imgid="+imgid,
            cache: false,
            success: function(resp){
                show_connect_image(postid);
                
            }
    });  
}

function show_connect_data(postid) {
    $.ajax({
            type: "POST",
            url: "../php/handlers/show_data_connect_list.php",
            data: "postid="+postid,
            cache: false,
            success: function(resp){
                $("#screen").html('<button onclick="close_screen()">X</button><div id="box1">'+resp+'</div>');
                
            }
    });   
    $("#screen").css("height", $("body").css("height"));
    $("#screen").css("visibility", "visible");
}

function connect_data(dataid, postid) {
    $.ajax({
            type: "POST",
            url: "../php/handlers/connect_data.php",
            data: "postid="+postid+"&dataid="+dataid,
            cache: false,
            success: function(resp){
                show_connect_data(postid);
                
            }
    });  
}

function disconnect_data(dataid,postid){
    $.ajax({
            type: "POST",
            url: "../php/handlers/disconnect_data.php",
            data: "postid="+postid+"&dataid="+dataid,
            cache: false,
            success: function(resp){
                show_connect_data(postid);
                
            }
    });  
}

function show_pages(page_id) {
    $.ajax({
            type: "POST",
            url: "../php/handlers/show_pages.php",
            data: "page="+page_id,
            cache: false,
            success: function(resp){
                $("#box1").html(unescape(resp));
                
            }
    });  
}

function new_page() {
    var i;
    var language='';
    for(i=1; i<20; i++) {
        if($("#page_name"+i).html()=="") {
            language+=i+"|"+$("#page_name"+i).val()+"|";
        }
    }
    language.replace("'", "&#146;");
    language.replace('"', "&#36;");
     $.ajax({
            type: "POST",
            url: "../php/handlers/new_page.php",
            data: "underpage="+$("#underpage").val()+"&number="+$("#page_number").val()+"&language="+language,
            cache: false,
            success: function(resp){
                show_pages();
                alert(resp);
            }
        }); 
}

function delete_page(page_id) {
    var answer = confirm ("Da li ste sigurni da želite obrisati stranicu (obrisati će te i sve povezane postove)?")
    if (answer) {
        $.ajax({
                type: "POST",
                url: "../php/handlers/delete_page.php",
                data: "page="+page_id,
                cache: false,
                success: function(resp){
                    alert(resp);
                    $("#"+page_id).toggle();
                    }
            }); 
    }
}

function change_page(page_id) {
    var i;
    var language='';
    for(i=1; i<20; i++) {
        if($("#page_name"+i).val()) {
            language+=i+"|"+$("#page_name"+i).val()+"|";
        }
    }
     $.ajax({
            type: "POST",
            url: "../php/handlers/change_page.php",
            data: "underpage="+$("#underpage").val()+"&number="+$("#page_number").val()+"&language="+language+"&pageid="+page_id,
            cache: false,
            success: function(resp){
                show_pages();
                alert(resp);
            }
        }); 
}



function dropdown_engage(pageid, language) {
    $.ajax({
        type: "POST",
        url: "../php/handlers/show_underpage.php",
        data: "page="+pageid+"&language="+language,
        cache: false,
        success: function(resp){
            $("#undermenu").html(resp);
            var offset = $("#menu"+pageid).offset();
            $("#undermenu").css("left", offset.left);
            $("#undermenu").css("top", offset.top);
            $("#undermenu").css("visibility", "visible");

            }
    }); 
}

function dropdown_destroy() {
                $("#undermenu").css("visibility", "hidden");
}

function show_languages() {
    $.ajax({
            type: "POST",
            url: "../php/handlers/show_languages.php",
            data: "",
            cache: false,
            success: function(resp){
                $("#box1").html(resp);
                
            }
    });  
    
}

function delete_language(language_id) {
    var answer = confirm ("Da li ste sigurni da želite obrisati jezik (obrisati će te i sve povezane postove)?")
    if (answer) {
        $.ajax({
                type: "POST",
                url: "../php/handlers/delete_language.php",
                data: "language="+language_id,
                cache: false,
                success: function(resp){
                    alert(resp);
                    $("#"+language_id).toggle();
                    }
            }); 
    }
}

function new_language() {
     $.ajax({
            type: "POST",
            url: "../php/handlers/new_language.php",
            data: "name="+$("#language_name").val()+"&short="+$("#language_short").val(),
            cache: false,
            success: function(resp){
                show_languages();
                alert(resp);
            }
        }); 
}

function language_bar() {
    $.ajax({
            type: "POST",
            url: "../php/handlers/language_bar.php",
            data: "",
            cache: false,
            success: function(resp){
                $("#languagebar").html(resp);
            }
        }); 
}

function choose_language(id) {
    languageid=id;
    $.cookie('language', id, { expires: 100 });
}

function openlinkimage() {
    window.open('upload_image.php', '_blank');
}

function openlinkdata() {
    window.open('upload_data.php', '_blank');
}

function openlinkmain() {
    window.open('index.html', '_self');
}



