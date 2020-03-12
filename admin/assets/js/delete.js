

/*
удаление продукта
*/

function deleteProduct(elem) {
        var $product = document.querySelector('#delProduct');
        var $ssylka = elem.dataset.link;

        var ajax = new XMLHttpRequest();

        ajax.open("GET", $ssylka, false);
        ajax.send();

        $product.innerHTML = ajax.responseText;
}
/*
удаление категорий
*/

function deleteCat(elem) {
        var $product = document.querySelector('#delProduct');
        var $ssylka = elem.dataset.link;

        var ajax = new XMLHttpRequest();

        ajax.open("GET", $ssylka, false);
        ajax.send();

        $product.innerHTML = ajax.responseText;
}