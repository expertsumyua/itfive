

var $loginOut = document.querySelector('#login-out');
var $siteURL = "http://itfive.local/";
if($loginOut){
    $loginOut.addEventListener('click', (ev)=>{
        let $el = ev.target;
        //создаем новый обект
        var ajax = new XMLHttpRequest();
        //конфигурируем делаем запрос
        ajax.open("POST", $siteURL + "admin/actions/delete-cook.php", true);
        //устранавливаем значение http заголовка
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //ждем загрузки и выполняем код
        ajax.onload = function () {
            document.cookie = 'customers_id=; Max-Age=-99999999;';
            document.cookie = 'status=; Max-Age=-99999999;';
            document.cookie = 'basket=; Max-Age=-99999999;';
            location.assign($siteURL);
        };
        //отправка запроса
        ajax.send();
    })
}

 // редактирование количества товара
 function formEditCount(id) {
    var count = document.querySelector("#count" + id);
    var price = document.querySelector("#cost" + id);
    var start_price = document.querySelector("#start_price" + id);

    var ajax = new XMLHttpRequest();
        ajax.open("POST", $siteURL + '/modules/basket/edit_count_product.php', false);
        ajax.setRequestHeader( "Content-type", "application/x-www-form-urlencoded");
        ajax.send("id=" + id + "&count=" + count.value);

        var response = JSON.parse(ajax.response);
        var edit_counte = document.querySelector(".edit_input");
            edit_counte.innerText = response;
            price.innerText =  start_price.value * response + "$";

     sunCount();

}

function sunCount() {
    var $add_basket = document.querySelector("#add-basket span");
    var $edit_input = document.querySelectorAll(".edit_input");
    var $arrCoun = new Array();
    for (let $i = 0; $i < $edit_input.length; $i++) {

        var $coun = +$edit_input[$i].value;
            $arrCoun.push($coun);
    }

    if($coun) {
        var $arrCoun = $arrCoun.reduce((sum, current) => sum + current);
        $add_basket.innerHTML = $arrCoun;
    }else {
        $add_basket.innerHTML = 0;
    }

}