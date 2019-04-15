$(document).ready(function(){
  $(".menu-box-link").click(function(){
    $(this).toggleClass("fa-minus-circle");
    $(this).toggleClass("fa-plus-circle");
  });
});


$(document).ready(function(){
    $(".input-search").on("keyup",function(){
        var value = $(this).val().toLowerCase();
        $(".update-menu .menu-box-name").filter(function(){
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready(function(){
    $(".submenu-box-link:not(.blank_accordion)").click(function(){
        $(this).toggleClass("fa-caret-up");
        $(this).toggleClass("fa-caret-down");
    });
});

$(document).ready(function(){
    $(".hidden-menu1").click(function(){
        $("#hidden-menu-item1").slideToggle(200);
        $(".hidden-menu-icon1").toggleClass("fa-caret-down");
        $(".hidden-menu-icon1").toggleClass("fa-caret-up");
    });
});

$(document).ready(function(){
    $(".hidden-menu2").click(function(){
        $("#hidden-menu-item2").slideToggle(200);
        $(".hidden-menu-icon2").toggleClass("fa-caret-down");
        $(".hidden-menu-icon2").toggleClass("fa-caret-up");
    });
});

$(document).ready(function(){
    $(".hidden-menu3").click(function(){
        $("#hidden-menu-item3").slideToggle(200);
        $(".hidden-menu-icon3").toggleClass("fa-caret-down");
        $(".hidden-menu-icon3").toggleClass("fa-caret-up");
    });
});
