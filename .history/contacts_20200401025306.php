<?php
//устанавливаем страницу
$page = "index";
include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
?>
<div class="it-five container bg-white">
<h3>Наши контакты в Киеве:</h3>
<div>
    <h5>01021, Украина, Киев, ул. Мечникова, 16, офис 6-09</h5>
    <p>9:30-18:00 Пн-Пт</p>
    <p>+38 (094) 710-03-07, +38 (095) 295-79-57</p>
    <p class="mb-0">Просим вас заранее согласовать дату и время вашего визита с секретарем.</p>
    <p>Обслуживание клиентов в офисе до 17:30</p>
</div>

    <div id = "map" style="height: 250px; width: 100%;"> </div>
        <script>
            function initMap() {
                var pos = {lat: 50.4373686 , lng: 30.5319964 }
                var opt = {
                    center: pos,
                    zoom: 15,
                };
                var myMap = new google.maps.Map(document.getElementById("map"), opt);
                var marker = new google.maps.Marker({
                    position: pos,
                    map: myMap,
                    title: "Центральный офис",

                });

            }
            </script>

</div>    
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEO9UPaEVLGrXid8MBqQ1icVF-ySdHrFY&callback=initMap" async defer> </script> 

