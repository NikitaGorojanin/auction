/**
 * Created by Nikita on 29.07.2017.
 */
$(document).ready(function() {



    function changePrice(){
        clearInterval(interval);
        var price = prompt("Введите новую цену:");
        if(price != null && price != "")
        {
            var validPrice = price.trim();
            if(validPrice.match(/^[1-9][0-9]*$/))
            {
                setNewPrice(validPrice);
            }
            else
                alert("Цена должна быть целым положительным числом!")
        }
        interval = setInterval(printSalersAndBuyers, 10000);
    }

    var printSalersAndBuyers = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "../../getSalersAndBuyersListInAuction",
            data: {carId: carId, categoryId: categoryId, districtId: districtId},
            success: function (msg) {
                var ind = msg.indexOf('{');
                var jsonData = msg.substring(ind);
                var result = JSON.parse(jsonData);
                var salers = result['salers'];
                var buyers = result['buyers'];
                var salersListDiv = $('.salers_list');
                var buyersListDiv = $('.buyers_list');
                salersListDiv.empty();
                buyersListDiv.empty();

                $.each(salers, function(key, saler){
                    var price = saler['price'];
                    var percent = saler['price']*0.025;
                    var remind = price - percent;
                    if(saler['user_id'] == userId)
                    {
                        salersListDiv.append(
                            "<div class=\"participant saler mybox\" id=\"mybox1\">"+saler['user_name']+
                                "<table class=\"tg\">"+
                                    "<tr>"+
                                        "<th class=\"tg-yw4l\" colspan=\"4\" rowspan=\"4\">"+
                                        "<img src=\"../../../../resources/images/smile64.png\">"+
                                        "</th>"+
                                        "<th class=\"tg-223e\" colspan=\"4\" rowspan=\"2\">"+
                                            "<div class='changePrice'>"+price+"</div>" +
                                        "</th>"+
                                    "</tr>"+
                                    "<tr></tr>"+
                                    "<tr>"+
                                        "<td class=\"tg-223e\" colspan=\"2\" rowspan=\"2\">"+percent+"</td>"+
                                        "<td class=\"tg-19ig\" colspan=\"2\" rowspan=\"2\">"+remind+"</td>"+
                                    "</tr>"+
                                    "<tr></tr>"+
                                "</table>"+
                            "</div>"
                        );
                    }
                    else
                        salersListDiv.append(
                        "<div class=\"participant saler\">"+
                            "<table class=\"tg\">"+
                                "<tr>"+
                                    "<th class=\"tg-3we0\" colspan=\"2\" rowspan=\"2\">"+
                                    "<img src=\"../../../../resources/images/smile64.png\">"+
                                    "</th>"+
                                    "<th class=\"tg-yw4l\" colspan=\"4\" rowspan=\"2\">"+
                                          price+
                                    "</th>"+
                                "</tr>"+
                                "<tr></tr>"+
                            "</table>"+
                        "</div>");
                });
                $.each(buyers, function (key, buyer) {
                    var price = buyer['price'];
                    if(buyer['user_id'] == userId)
                    {
                        buyersListDiv.append(
                            "<div class=\"participant buyer mybox\">"+buyer['user_name']+
                                "<table class=\"tg mytable\">"+
                                    "<tr>"+
                                        "<th class=\"tg-3we0\" colspan=\"2\" rowspan=\"2\">"+
                                            "<img src=\"../../../../resources/images/smile64.png\">"+
                                        "</th>"+
                                        "<th class=\"tg-yw4l\" colspan=\"4\" rowspan=\"2\">"+
                                            "<div class='changePrice'>"+price+"</div>" +
                                        "</th>"+
                                    "</tr>"+
                                    "<tr>"+
                                    "</tr>"+
                                "</table>"+
                            "</div>");
                    }
                    else
                        buyersListDiv.append(
                            "<div class=\"participant buyer\">"+
                                "<table class=\"tg\">"+
                                    "<tr>"+
                                        "<th class=\"tg-3we0\" colspan=\"2\" rowspan=\"2\">"+
                                            "<img src=\"../../../../resources/images/smile64.png\">"+
                                        "</th>"+
                                        "<th class=\"tg-yw4l\" colspan=\"4\" rowspan=\"2\">"+price+"</th>"+
                                    "</tr>"+
                                    "<tr>"+
                                    "</tr>"+
                                "</table>"+
                            "</div>");
                });
                //console.log(salers);
            }
        });
    }

    $("div").on('click', '.changePrice', function(event){
        event.stopImmediatePropagation();
        changePrice();
    });

    printSalersAndBuyers();

   var interval = setInterval(printSalersAndBuyers, 10000);

    var setNewPrice = function(price)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "../../setNewPrice",
            data: {carId: carId, categoryId: categoryId, districtId: districtId, price: price},
            success: function (msg) {
                printSalersAndBuyers();
            }
        });
    }


});