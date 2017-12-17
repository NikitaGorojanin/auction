/**
 * Created by Nikita on 01.08.2017.
 */
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    mygoods = {};

    function getGoods() {
        $.ajax({
            type: "POST",
            url: "getGoods",
            data: {userId: userId},
            success: function (msg) {
                var ind = msg.indexOf('{');
                var jsonData = msg.substring(ind);
                var data = JSON.parse(jsonData);
                goodsDiv = $('.goods');
                $.each(data['goods'], function (key, good) {
                    car = good['car_id'];
                    category = good['category_id'];
                    myKey = car+"_"+category;
                    if(mygoods[myKey]==null)
                        mygoods[myKey] = new Array();
                    mygoods[myKey].push(good);

                });
                console.log(mygoods);

                $.each(mygoods, function (key, goods) {
                    good = goods[0];
                    car = good['car_name'];
                    category = good['category_name'];
                    goodsDiv.append(
                        "<button class=\"mygood\" id = \"" + key + "\">" +
                        "<span class=\"text-warning\">Машина:</span>" + car +
                        "<span class=\"text-warning\">Товар:</span>" + category +
                        "</button>"
                    );
                })

            }
        });
    }

    function getAuctionsForGood(keyInMyGoodsArray){
        auctionsDiv = $('.auctions');
        auctionsDiv.empty();
        auctionHeaders = $('.auction_header');
        auctionHeaders.empty();
        auctionHeaders.append("Активные аукционы");
        $.each(mygoods[keyInMyGoodsArray], function (key, auction) {
            carId = auction['car_id'];
            categoryId = auction['category_id'];
            districtId = auction['district_id'];
            auctionsDiv.append(
                "<div><a href='showAuction/car"+carId+"/category"+categoryId+"/district"+districtId+"'>"+
                        auction['district_name']+
                "</a></div>"
            );
        })
    }

    $(document).delegate("button", "click",  function () {
       id = $(this).attr('id');
       getAuctionsForGood(id);
    });

    getGoods();
});
