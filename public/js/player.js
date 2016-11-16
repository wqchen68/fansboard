$(function () {

    $('.filter').keydown(function(e){
        var filter = $(this);
        setTimeout(function(){
            pageobj.find('.plist td').each(function(){
                if( $(this).text().toLowerCase().search(filter.val().toLowerCase())!==-1 ){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            });
        },0);
    });

    $(document).keydown(function(e){
        e.stopPropagation();
        var height = $('.playerList-combo').find('td.active').outerHeight();
        var scroll = $('.playerList-combo').parent().scrollTop();
        switch(e.which){
        case 38:
            if( $('.sign-btn.active').length>0 ){
                $('.playerList-combo').parent().scrollTop(scroll-height);
                $('.sign-btn.active').parent('tr').prev('tr').children('td').click();
                return false;
            }
        break;
        case 40:
            if( $('.sign-btn.active').length>0 ){
                $('.playerList-combo').parent().scrollTop(scroll+height);
                $('.sign-btn.active').parent('tr').next('tr').children('td').click();
                return false;
            }
        break;
        }
    });

    $.fn.extend({
        changePlayerImg: function(card){
            $(this).find('.face').attr({src:'/player/'+card['fbid']+'.png',fbid:card['fbid']});
            $(this).find('.cardplayer').html(card['cardplayer']);
            $(this).find('.cardteamposi').html(card['cardteamposi']);
            $(this).find('.cardinjna').html(card['cardinjna']);
            $(this).find('.cardstat').html(card['cardstat']);
        }
    });


});
