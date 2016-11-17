$(function () {

    pageobj.find('.majorboxN').click(function(){
        var player2 = $(this);
        var index_similar = pageobj.find('.majorboxN').index(player2);

        var ability_draw = {
            name: [ability.name[0],ability.name[index_similar+1]],
            value: [ability.value[0],ability.value[index_similar+1]]
        };

        drawRadar(ability_draw);

        pageobj.find('.majorboxN .playercardsmall').removeClass('active');
        player2.find('.playercardsmall').addClass('active');
    });


});