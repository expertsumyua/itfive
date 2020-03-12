/*
добавление продукта
*/
var $addProduct = document.querySelector('#addProduct');
/*
добавление продукта
*/
if($addProduct) {
    $addProduct.onsubmit = function (e) {
        //изменняем поведение по умолчании ставим на блок form preventDefault
        e.preventDefault();

        //получаем переменные
        var $title = $addProduct.querySelector('input[name="title"]');
        var $description = $addProduct.querySelector('input[name="description"]');
        var $content = $addProduct.querySelector('input[name="content"]');
        var $cat_id = $addProduct.querySelector('select[name="cat_id"]');

        //формируем строку запроса
        var $dannie = "add-product=1" +
            "&title=" + $title.value +
            "&description=" + $description.value +
            "&content=" + $content.value +
            "&cat_id=" + $cat_id.value;

        //создаем запрос
        var ajax = new XMLHttpRequest();
        ajax.open("POST", $addProduct.action, false);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send($dannie);

        //обновляем блок сообщений
        var $listProduct = document.querySelector("#listProduct");
        $listProduct.innerHTML = ajax.response;
    };
}