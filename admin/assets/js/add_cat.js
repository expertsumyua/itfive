/*
добавление продукта
*/
var $addCategories = document.querySelector('#addCategory');
if ($addCategories) {
    $addCategories.onsubmit = function (e) {
        //изменняем поведение по умолчании ставим на блок form preventDefault
        e.preventDefault();

        //получаем переменные
        var $title = $addCategories.querySelector('input[name="title"]');

        //формируем строку запроса
        const $danni = "add-category=1" +
            "&title=" + $title.value;

        //создаем запрос
        var ajax = new XMLHttpRequest();
        ajax.open("POST", $addCategories.action, false);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send($danni);

        //обновляем блок сообщений
        var $listCategory = document.querySelector("#listCategory");
        $listCategory.innerHTML = ajax.response;
    };
}