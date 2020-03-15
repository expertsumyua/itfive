
<?php

if ($page == "products" || $page == "users" || $page == "categories"){
    ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Page level plugins -->
<script src="./assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="./assets/js/variable.js"></script>
<script src="./assets/js/add.js"></script>
<script src="./assets/js/add_cat.js"></script>
<?php
}else{
    ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--<script src="http://<?php /*echo $_SERVER['HTTP_HOST']*/?>/admin/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="http://<?php /*echo $_SERVER['HTTP_HOST']*/?>/admin/assets/js/ruang-admin.min.js"></script>-->
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/assets/vendor/chart.js/Chart.min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/assets/js/demo/chart-area-demo.js"></script>

<!-- Page level plugins -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/assets/js/main.js"></script>

<!-- Page level custom scripts -->
<?php
}
?>