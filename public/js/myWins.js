$(document).ready(function() {
    var get_closed_auctions = function(){
        $.ajax({
            type: "POST",
            url: "../../getMyClosedAuctions",
            data: {userId: userId},
            success: function (deals) {
                container = $('.victories');
                $.each(deals, function(key, value){
                    container.appendChild('<div class="row">' +
                                                '<div class="col-xs-2">'+value['category']+'</div>'+
                                                '<div class="col-xs-2">'+value['car']+'</div>'+
                                                '<div class="col-xs-2">'+value['district']+'</div>'+
                                                '<div class="col-xs-2">'+value['name']+'</div>'+
                                                '<div class="col-xs-2">'+value['price']+'</div>'+
                                          '</div>')
                });
            }
        });
    }
});