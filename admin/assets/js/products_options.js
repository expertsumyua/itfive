// удаление продукта аяксом
function delete_product(element) {
    var resultConfirm = confirm('Удалить???');
    if(resultConfirm) {
        var data_table = document.querySelector("#data_table");
        
        var link = element.dataset.link;
        var ajax = new XMLHttpRequest();
            ajax.open("GET", link, false);
            ajax.send();
            
            console.dir(ajax);
            data_table.innerHTML = ajax.response;
    } else {
    alert('Чудово..!!!..))');
    }
}