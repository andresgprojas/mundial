/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
    
    $(".endSesion").click(function() {
        $.ajax({
            type: 'POST',
            url: '../Controller/login',
            data: {
                'action': 'endSesion'
            },
            success: function(a) {
                if (a == "1") {
                    window.location.replace("../");
                }
            }
        })
    })
    $(document).tooltip({
        position: {
            my: "center bottom-20",
            at: "center top",
            using: function(position, feedback) {
                $(this).css(position);
                $("<div>")
                        .addClass("arrow")
                        .addClass(feedback.vertical)
                        .addClass(feedback.horizontal)
                        .appendTo(this);
            }
        }
    });
    creaAccordion = function(_div) {
        $('#' + _div).accordion({
            heightStyle: "content"
        });
        $('#' + _div).accordion("option", "icons", null);
    }
    $.ajax({
        type: 'POST',
        url: '../Controller/login',
        data: {
            'action': 'sesion'
        },
        beforeSend: function() {
            $(".gray").css({'display': 'fixed'})
        },
        success: function(a) {
            if (a == '0')
                window.location.replace("../");
            else {
                $.ajax({
                    type: 'POST',
                    url: '../Controller/partidos',
                    data: {
                        'action': 'loadAll'
                    },
                    success: function(a) {
                        if (a == "0") {
                            window.location.replace("../");
                        }
                        $("#accordion").html(a)
                        $(".panel-body a").tooltip()
                        $(".gray").css({'display': 'none'})
                    }
                })
            }
            $("#nick").html(a)

        }
    })
    verCriterios = function(id) {
        $.ajax({
            type: 'POST',
            url: '../ControlAdm/getPuntosA',
            data: {
                'action': 'loadView',
                'partido': id
            },
            beforeSend: function() {
                $(".gray").css({'display': 'fixed'})
            },
            success: function(a) {
                if (a == '0') {
                    window.location.replace("../");
                }
                $("#divPronosticos .modal-body").html(a)
                $("#divPronosticos").modal('show')
                $(".gray").css({'display': 'none'})
                $('#divPronosticos form').ajaxForm(options);

            }
        })
        return false;
    }
    $("#divPronosticos").click(function() {

    })
    var options = {
        success: function(a) {
            if (a == "0")
                window.location.replace("../");
            $("#divPronosticos .modal-body").html(a)
            $(".gray").css({'display': 'none'})
        },
        beforeSend: function() {
//    alert('a')
            $(".gray").css({'display': 'fixed'})
        }
    }

})