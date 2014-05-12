/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    setInterval(function(){
        
        $('#divTabla').dataTable().fnDestroy();
        $('#divTabla').dataTable( {
            "bSort": false,
            "bFilter": false,
            "bLengthChange": false,
            "aoColumns": [
      
            {
                "sWidth": "20%"
            },
            {
                "sWidth": "10%"
            },
            {
                "sWidth": "15%", 
                "sClass" : "text-center"
            },
      
            ],
            "bProcessing": true,
            "bSort": false,
            "bServerSide": true,
            "sAjaxSource": "../Controller/post"
        } );
    },600000);
    
    $(".endSesion").click(function(){
        $.ajax({
            type:   'POST',
            url:    '../Controller/login',
            data:{
                'action': 'endSesion'
            },
            success: function(a){
                if (a=="1"){
                    window.location.replace("../");
                }
            }
        })
    })
    $(document).tooltip({
        position: {
            my: "center bottom-20",
            at: "center top",
            using: function( position, feedback ) {
                $( this ).css( position );
                $( "<div>" )
                .addClass( "arrow" )
                .addClass( feedback.vertical )
                .addClass( feedback.horizontal )
                .appendTo( this );
            }
        }
    });
    creaAccordion = function(_div){
        $('#'+_div).accordion({
            heightStyle: "content"
        });
        $('#'+_div).accordion("option", "icons", null);
    }
    $.ajax({
        type:   'POST',
        url:    '../Controller/login',
        data:{
            'action': 'sesion'
        },
        success: function(a){
            if (a == '0')
                window.location.replace("../");
            else{
                $.ajax({
                    type:   'POST',
                    url:    '../Controller/partidos',
                    data:{
                        'action': 'loadAll'
                    },
                    success: function(a){
                        if (a == "0"){
                            window.location.replace("../");
                        }
                        $("#accordion").html(a)
                        $(".panel-body a").tooltip()

                    }
                })
            }
            $("#nick").html(a)

        }
    })
    verCriterios = function(id){
        $.ajax({
            type:   'POST',
            url:    '../Controller/getPuntos',
            data:{
                'action': 'loadView',
                'partido': id
            },
            success: function(a){
                if(a == '0'){
                    window.location.replace("../");
                }
                $("#divPronosticos .modal-body").html(a)
                $("#divPronosticos").modal('show')
                //                $("#divPronosticos").dialog({
                //                    width:'80%',
                //                    title: $("#partido_"+id+" a").html(),
                //                    modal: true
                //                })
                $('#divPronosticos form').ajaxForm(options);

            }
        })
        return false;
    }
    $("#divPronosticos").click(function(){
                    
        })
    var options = {
        success: function(a){
            if (a == "0")
                window.location.replace("../");
            $("#divPronosticos .modal-body").html(a)
        }
    }
    $('#divTabla').dataTable( {
        "bProcessing": true,
        "bSort": false,
        "bFilter": false,
        "bLengthChange": false,
        "bServerSide": true,
        "sAjaxSource": "../Controller/post",
        "aoColumns": [
      
        {
            "sWidth": "20%", 
            "sClass" : "text-center"
        },
        {
            "sWidth": "10%", 
            "sClass" : "text-center"
        },
        {
            "sWidth": "15%", 
            "sClass" : "text-center"
        },
      
        ]
    } );
    
    
    
//    index-------------------------------

})
        