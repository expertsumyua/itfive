/*
обновление категории
*/
var $editCat = document.querySelector('#editСat');
$editCat.onsubmit = function (e) {
    //изменняем поведение по умолчании ставим на блок form preventDefault
    e.preventDefault();
    //получаем переменные
    var $id = $editCat.querySelector('input[name="id"]');
    var $title = $editCat.querySelector('input[name="title"]');

    //формируем строку запроса
    var $option = "update=" + $id.value +
        "&title=" + $title.value;
    //создаем запрос
    var ajax = new XMLHttpRequest();
    ajax.open("POST", $editCat.action, true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send($option);

    //обновляем блок сообщений
    var $updCat = document.querySelector("#updateCat");
    $updCat.innerHTML = ajax.response;

}