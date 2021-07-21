


$(document).on('click','#boardItemMore',function(){
    let uri = window.location.pathname + '?page=' + (Number($(this).attr('rel')) + 1)
    boardMore(uri)
    window.history.pushState('', '', uri);
});


function boardMore (location) {
    $.ajax({
        type: "GET",
        url: location + '&more=1',
        success:function( data ) {
            $(document).find('.pagination').detach()
            $(document).find('.adsCatalog-catalog').append($(data))
            console.log(data);
        }
    });
}



