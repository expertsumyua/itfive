<div class="col mt-3">
    <div class="px-3 h-100" style="background: #F2F2F2">
        <div class="card border-0 rounded-0" style="background: #F2F2F2">
            <div class="card-body row h-50">
                <div class="col-7">
                    <p class="card-text d-inline"><?php echo $row['short_description'] ?></p>
                </div>
                <div class="col-5 d-flex align-items-center justify-content-center">
                    <?php $show_img = base64_encode($row['img']) ?>
                    <img class="img-fluid" src="data:image/jpeg;base64,<?= $show_img ?>">
                </div>
                
            </div>
            <div class="card-footer" style="background: #F2F2F2">
                <p class="order d-inline">Цена: <strong><?php echo $row['cost'] ?>$</strong></p>
                    <a href="#"class="btn btn-outline-primary ml-5 justify-content-end">Заказать</a>
                </p>
            </div>
        </div>
    </div>
</div>
