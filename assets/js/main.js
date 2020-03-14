var $loginOut = document.querySelector('#login-out');
var $siteURL = "http://itfive.local/";
if($loginOut){
    $loginOut.addEventListener('click', (ev)=>{
        let $el = ev.target;
        //создаем новый обект
        var ajax = new XMLHttpRequest();
        //конфигурируем делаем запрос
        ajax.open("POST", $siteURL, true);
        //устранавливаем значение http заголовка
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //ждем загрузки и выполняем код
        ajax.onload = function () {
            document.cookie = name+'=; Max-Age=-99999999;';
                location.assign($siteURL);
        };
        //отправка запроса
        ajax.send();
    })
}


//Добавление в корзину
function addToBasket(btn) {
    console.dir(btn);
     var ajax = new XMLHttpRequest();
        ajax.open('POST', $siteURL + 'modules/basket/add-basket.php', false);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.send('id=' + btn.dataset.ser + "&sum_count=" + sum_count);     // ajax.send('cat-id=' + btn.dataset.cat + '&ser-id=' + btn.dataset.ser ); 
        console.dir(ajax); 

        var response = JSON.parse(ajax.response);
        var btnGoBasket = document.querySelector("#add-basket span");
            console.dir(response);
            
            var arr_count = new Array();
            for(var i=0; i<response.basket.length; i++) {
                
                var count = +response.basket[i].count; 
                arr_count.push(count);
            }
            
        var sum_count = arr_count.reduce((sum, current)=>sum+current);
        btnGoBasket.innerText = sum_count;
}

// Удаление товара с корзины
function deleteProductBasket(obj, id) {
    // console.dir(obj.parentNode.parentNode);
     var ajax = new XMLHttpRequest();
     ajax.open("POST", $siteURL + '/modules/basket/delete.php', false);
     ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
     ajax.send('id=' + id);
 
     obj.parentNode.parentNode.remove();
 }

 // редактирование количества товара
 function formEditCount(id) {
    var count = document.querySelector("#count" + id);
    var price = document.querySelector("#cost" + id);
    var start_price = document.querySelector("#start_price" + id);
   
//console.dir(start_price);
//console.dir(count);
    var ajax = new XMLHttpRequest();
        ajax.open("POST", $siteURL + '/modules/basket/edit_count_product.php', false);
        ajax.setRequestHeader( "Content-type", "application/x-www-form-urlencoded");
        ajax.send("id=" + id + "&count=" + count.value); 

        var response = JSON.parse(ajax.response);
        var edit_counte = document.querySelector(".edit_input");
            edit_counte.innerText = response;
            price.innerText =  start_price.value * response + "$";
        
}