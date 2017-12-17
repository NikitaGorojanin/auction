/**
 * Created by Nikita on 29.07.2017.
 */
$(document).ready(function() {
    var selfOrderId = -1;
    var curBuyersChoices = [];
    var draw = SVG('drawing').size('100%', '100%');
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
        interval = setInterval(printSalersAndBuyers, 1000);
    }

    var drawBuyersChoices = function()
    {
        //draw.rect(100, 100).move(100, 50).fill('#f06');
        draw.clear();
        var lineAttr = {
            'stroke': '#000000',
            'stroke-width': 3,
            'stroke-dasharray': '5px, 4px'
        };
        $.each(curBuyersChoices, function(key, line){
            var buyerDivId = line['buyer_order_id'];
            var sellerDivId = line['seller_order_id'];
            var buyerDiv = $("#"+buyerDivId.toString());
            var sellerDiv = $("#"+sellerDivId.toString());
            var canvX = $("#drawing").position().left;
            var canvY = $("#drawing").position().top;
            var startX = sellerDiv.position().left + sellerDiv.width() - canvX;
            var startY = sellerDiv.position().top + sellerDiv.height()/2 - canvY;
            var finishX = buyerDiv.position().left - canvX;
            var finishY = buyerDiv.position().top + buyerDiv.height()/2 - canvY;

            var tmp = sellerDiv.position();
            console.log(startX+" "+startY);
            console.log(finishX+" "+finishY);

            var line = draw.line(startX, startY, finishX, finishY).stroke({ width: 3 }).attr(lineAttr);
        });
    }

    var printSalersAndBuyers = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "../../getSellersAndBuyersListInAuction",
            data: {carId: carId, categoryId: categoryId, districtId: districtId, userId: userId, userRole: userRole},
            success: function (msg) {
                if (msg.goToContacts==true)
                {
                    $.ajax({
                        type: "POST",
                        url: "../../setBuyerAccepted",
                        success: function (msg) {}
                    });
                    goToContactsPage(msg.data);
                }
                else {
                    var ind = msg.indexOf('{');
                    var jsonData = msg.substring(ind);
                    var result = JSON.parse(jsonData);
                    console.log(result);

                    var sellers = result['data']['sellers'];
                    console.log(sellers);
                    var buyers = result['data']['buyers'];
                    var sellersListDiv = $('.sellsers');
                    var buyersListDiv = $('.buyers');
                    sellersListDiv.empty();
                    buyersListDiv.empty();
                    $.each(sellers, function (key, seller) {
                        var price = seller['price'];
                        var percent = Math.round(seller['price'] * 0.025);
                        var remind = price - percent;
                        if (seller['user_id'] == userId) {
                            selfOrderId = seller['id'];
                            var id = seller['id'].toString();
                            sellersListDiv.append(
                                "<div class=\"col-xs-12 seller user\">" + seller['user_name'] +
                                "<div class=\"col-xs-12 text-center border-black\">" +
                                "<img class=\"seller-smile\" id=\'" + seller['id'] + "\' src=\"../../../../resources/images/smi.JPG\" style=\"height: 100px\">" +
                                "</div>" +
                                "<div class=\"col-xs-6 text-center border-black price\">" + price + "</div>" +
                                "<div class=\"col-xs-6 text-center border-black\">" + remind + "</div>" +
                                "</div>"
                            );
                        }
                        else
                            sellersListDiv.append(
                                "<div class=\"col-xs-12 seller user\" >" +
                                "<div class=\"col-xs-12 text-center border-black\">" +
                                "<img class=\"seller-smile\" id=\'" + seller['id'] + "\' src=\"../../../../resources/images/smi.JPG\" style=\"height: 100px\">" +
                                "</div>" +
                                "<div class=\"col-xs-6 text-center border-black\">" + price + "</div>" +
                                "</div>");
                    });
                    $.each(buyers, function (key, buyer) {
                        var price = buyer['price'];
                        if (price == 0)
                            price = "-";

                        var locationPart = "";
                        if (buyer['latitude'] != 0 && buyer['longitude'] != 0) {
                            locationPart = "<div> " +
                                "<img src=\"../../../../resources/images/location20.png\" class=\"location\" " +
                                "lat='" + buyer['latitude'] + "' lng='" + buyer['longitude'] + "'>" +
                                "</div>"
                        }

                        if (buyer['user_id'] == userId) {
                            selfOrderId = buyer['id'];
                            buyersListDiv.append(
                                "<div class=\"col-xs-12 buyer user\">" + locationPart + buyer['user_name'] +
                                "<div class=\"col-xs-12 text-center border-black\">" +
                                "<img class=\"buyer-smile\" id=\'" + buyer['id'] + "\' src=\"../../../../resources/images/smi.JPG\" style=\"height: 100px\">" +
                                "</div>" +
                                "<div class=\"col-xs-6 text-center border-black\">" + price + "</div>" +
                                "</div>");
                        }
                        else
                            buyersListDiv.append(
                                "<div class=\"col-xs-12 buyer user\">" + locationPart +
                                "<div class=\"col-xs-12 text-center border-black\">" +
                                "<img class=\"buyer-smile\" id=\'" + buyer['id'] + "\' src=\"../../../../resources/images/smi.JPG\" style=\"height: 100px\">" +
                                "</div>" +
                                "<div class=\"col-xs-6 text-center border-black\">" + price + "</div>" +
                                "</div>");
                    });
                    curBuyersChoices = result['data']['buyerChoises'];
                    drawBuyersChoices();
                }
            }
        });
    }


    var goToContactsPage = function(dataForContacts){
        console.log(dataForContacts);
        var form = ''
        $.each(dataForContacts, function (key, value) {
            form += '<input type="hidden" name="'+key+'" value="'+value+'">'
        })
        $('body').append('<form class="form_for_redirect_to_contacts" action="../../partnerContacts" method="POST"></form>');
        $('.form_for_redirect_to_contacts').append(form);
        $('.form_for_redirect_to_contacts').append('<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'">');
        $('.form_for_redirect_to_contacts').submit();

    }

    $("div").on('click', '.price', function(event){
        event.stopImmediatePropagation();
        changePrice();
    });

    printSalersAndBuyers();

   var interval = setInterval(printSalersAndBuyers, 1000);

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

    var createNewChoice = function(sellerOrderId)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "../../setBuyerChooseSeller",
            data: {
                buyersOrderId: selfOrderId, sellersOrderId: sellerOrderId,
                carId: carId, categoryId: categoryId, districtId: districtId
            },
            success: function (msg) {
                printSalersAndBuyers();
            }
        });
    }

    var removeChoice = function()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "../../removeBuyerChoise",
            data: {
                buyersOrderId: selfOrderId, carId: carId, categoryId: categoryId, districtId: districtId
            },
            success: function (msg) {
                printSalersAndBuyers();
            }
        });
    }

    var buyerClickOnSeller = function(sellerId){
        if(userRole == "buyer")
        {
            var sellerOrderId = sellerId;
            var isBuyerHasOtherWishs = false;
            var isBuyerWishThisSaller = false;
            $.each(curBuyersChoices, function (key, line) {
                if (line['buyer_order_id'] == selfOrderId)
                {
                    isBuyerHasOtherWishs = true;
                }
                if(line['buyer_order_id'] == selfOrderId && line['seller_order_id'] == sellerOrderId)
                {
                    isBuyerWishThisSaller = true;
                }
            });

            if(!isBuyerWishThisSaller && !isBuyerHasOtherWishs) {
                var confirmToSuggestion = confirm("Нажимая на продавца, вы соглашаетесь с его ценой!");
                if (confirmToSuggestion) {
                    createNewChoice(sellerOrderId);
                }
            }
            else {
                if(isBuyerWishThisSaller)
                {
                    //Отказ от товара
                    var unconfirmToSuggestion = confirm("Вы хотите отказаться от этого предложения?");
                    if (unconfirmToSuggestion)
                    {
                        removeChoice();
                    }
                }
                else
                {
                    if(isBuyerHasOtherWishs)
                    {
                        //Отказ от другого товара и переход на этот
                        var changeConfirmToSuggestion = confirm("Хотите отказаться от других товаров и перейти на этот?");
                        if (changeConfirmToSuggestion)
                        {
                            removeChoice();
                            createNewChoice(sellerOrderId);
                        }
                    }
                }
            }
        }
    }

    $(document).delegate(".seller-smile", "click", function () {
        event.stopImmediatePropagation();
        buyerClickOnSeller($(this).attr('id'));
    });

    var isRelationExist = function(buyerId, sallerId)
    {
        console.log(curBuyersChoices);
        var isExist = false;
        $.each(curBuyersChoices, function (key, line) {
            if(line['buyer_order_id'] == buyerId && line['seller_order_id'] == sallerId)
            {
                isExist = true;
            }
        });
        return isExist;
    }

    var sellerClickOnBuyer = function(buyerId){
        if(userRole == "seller")
        {
            var buyerOrderId = buyerId;
            if(isRelationExist(buyerOrderId, selfOrderId))
            {
                var agreeConfirmToSuggestion = confirm("Вы соглашаетесь на сделку!");
                if (agreeConfirmToSuggestion)
                {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "../../finishAuctionAndShowContactPage",
                        data: {
                            sellerOrderId: selfOrderId, buyerOrderId: buyerOrderId,
                            carId: carId, categoryId: categoryId, districtId: districtId,
                            carName: carName, categoryName: categoryName, districtName: districtName,
                        },
                        success: function (contacts) {
                            console.log(contacts['carName'])
                            var form = ''
                            $.each(contacts, function (key, value) {
                                form += '<input type="hidden" name="'+key+'" value="'+value+'">'
                            })
                            console.log(form);
                            $('body').append('<form class="form_for_redirect_to_contacts" action="../../partnerContacts" method="POST"></form>');
                            $('.form_for_redirect_to_contacts').append(form);
                            $('.form_for_redirect_to_contacts').append('<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'">');
                            $('.form_for_redirect_to_contacts').submit();
                        }
                    });

                }
            }
        }
    }

    $(document).delegate(".buyer-smile", "click", function () {
        event.stopImmediatePropagation();
        sellerClickOnBuyer($(this).attr('id'))
    });
});