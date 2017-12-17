/**
 * Created by Nikita on 24.09.2017.
 */
$(document).ready(function() {
    $(".form").submit(function(){

       if (userRole == "seller")
       {
           var price = $("#price").val();
           if(price.length==0)
           {
               alert("Введите цену на Ваш товар");
               return false;
           }
       }
       return true;
   });
});