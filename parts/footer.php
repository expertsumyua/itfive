
<footer class="blog-footer">
    <div class="container">
        <div class="row row-cols-3 justify-content-between">
            <a href="/" class="text-decoration-none text-left">IT <span class="text-warning">Five</span></a>
            <nav class="it-five__nav nav d-flex justify-content-around">
                <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="/">Главная</a>
                <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="cat.php">Услуги</a>
                <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="services.php">Заказы</a>
                <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="http://<?php echo $_SERVER['HTTP_HOST']?>/contacts.php">Контакты</a>

            </nav>
            <p class="text-right">

                ©IT Five
                <?php
                echo date("Y");
                ?>
            </p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/js/bootstrap.min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/assets/js/main.js"></script>

</body>
</html>
