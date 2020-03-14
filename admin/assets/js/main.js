

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
            location.assign($siteURL);
        };
        //отправка запроса
        ajax.send();
    })
}