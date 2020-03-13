<div class="row">
    <div class="col-12 px-5 my-4">
        <div class="border">
            <div class="cat-top">
                <div class="row">
                    <div class="col-md-8 top-left">
                        <div class="cat-header">
                            <h3 class=" mb-4 col-8 border-bottom cat-title">
                                <?php echo $row['title'] ?>
                            </h3>
                            <a href="services.php?id=<?php echo $row['id'] ?>" type="button" class=" col-4 btn btn-outline-success order-btn">Заказать</a>
                        </div>
                        <div class="cat-col-text px-5">
                            <p><?php echo $row['description'] ?></p>
                        </div>
                    </div>
                    <div class="top-right col-md-4 p-4">
                        <img class="order-img" src="assets/img/image%2016.png" alt="">
                    </div>
                </div>
            </div>
            <div class="cat-bottom border-top b-0">
                <div class="row">
                    <div class="col-md-4 bottom-left p-3">
                        <?php echo $row['kit_html'] ?>
                    </div>
                    <div class="col-md-4 border-right bottom-middle p-3">
                        <?php echo $row['other_html'] ?>
                    </div>
                    <div class="col-md-4 bottom-right">
                        <div class=" d-flex flex-column justify-content-center h-100">
                            <?php $show_img = base64_encode($row['img']) ?>
                            <img class="bottom-img" src="data:image/jpeg;base64,<?=$show_img ?>">
                            <div class="price">От <?php echo $row['cost'] ?>$</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>