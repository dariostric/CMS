var languageid=0;

function language_init() {
        var i=0;
        $.ajax({
            type: "POST",
            url: "php/handlers/languageinit.php",
            data: "",
            cache: false,
            success: function(resp){
                languageid=resp;
                show_interface(0,languageid);
                show_title(0,languageid);

                language_bar();
                show_menu();
                
            }
        });
}

function show_menu(){
        $.ajax({
            type: "POST",
            url: "php/handlers/menu.php",
            data: "language="+languageid,
            cache: false,
            success: function(resp){
                $("#menu").html(unescape(resp));
            }
        });   
}

function show_interface(id,language) {
        languageid=language;
        $.ajax({
            type: "POST",
            url: "php/handlers/page.php",
            data: "id="+id+"&language="+language,
            cache: false,
            success: function(resp){
                $("#main").html(unescape(resp));
            }
        });
        show_title(id,language);
        
}

function show_title(id,language) {
        $.ajax({
            type: "POST",
            url: "php/handlers/title.php",
            data: "id="+id+"&language="+language,
            cache: false,
            success: function(resp){
                $("#title").html(unescape(resp));
            }
        });

}

function widthen() {

               $("#screen").html('<div id="box1">'+$(this).html+'</div>');
               $("#screen").css('visibility', 'visible');
}

function dropdown_engage(pageid, language) {
$.ajax({
        type: "POST",
        url: "php/handlers/show_underpage.php",
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

function language_bar() {
    $.ajax({
            type: "POST",
            url: "php/handlers/language_bar.php",
            data: "",
            cache: false,
            success: function(resp){
                $("#languagebar").html(resp);
            }
        }); 
}

function choose_language(id) {
        languageid=id;
        show_interface(0,languageid);
        language_bar();
        show_menu();
        show_title(0,languageid);
}

        

    
    
