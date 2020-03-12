/*
обновление продукта
*/
//кешируем url
var $siteURL = 'http://shop-master.local/admin/';



if($update) {
    $update.onsubmit = function (e) {
        //изменняем поведение по умолчании ставим на блок form preventDefault
        e.preventDefault();

        //получаем переменные
        var $id = $update.querySelector('input[name="id"]');
        var $title = $update.querySelector('input[name="title"]');
        var $description = $update.querySelector('input[name="description"]');
        var $content = $update.querySelector('input[name="content"]');

        //формируем строку запроса
        var $dannie = "update=" + $id.value +
            "&title=" + $title.value +
            "&description=" + $description.value +
            "&content=" + $content.value;

        //создаем запрос
        var ajax = new XMLHttpRequest();
        ajax.open("POST", $update.action, false);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send($dannie);

        //обновляем блок сообщений
        var $updateEdit = document.querySelector("#update_edit");
        $updateEdit.innerHTML = ajax.response;
    };
}

function checkStatus(obj, id) {

    //создаем новый обект
    var ajax = new XMLHttpRequest();
    //конфигурируем делаем запрос
    ajax.open("POST", $siteURL + "actions/orders_status.php", true);
    console.log($siteURL + "actions/orders_status.php");
    //устранавливаем значение http заголовка
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //ждем загрузки и выполняем код
    ajax.onload = function () {
        if (obj.value == 0){
            obj.value = 1

        }else{
            obj.value = 0
        }
    };
    //отправка запроса
    ajax.send("id=" + id + "&status=" + obj.value);
    
}

