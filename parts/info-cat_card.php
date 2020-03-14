<div class="row">
    <div class="col-12 px-5 my-4">
        <div class="border">
            <div class="cat-top">

                <div class="row">

                    <div class="col-md-8 top-left">
                        <div class="cat-header">

                            <h3 class="cat-title mx-4 col-10 border-bottom ">
                                <?php echo $row['title'] ?>
                            </h3>
                            
                        </div>
                        <div class="cat-col-text px-5">
                            <p><?php echo $row['description'] ?></p>
                        </div>
                    </div>

                    <div class="col-md-4 top-right">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <?php $show_img = base64_encode($row['img']) ?>
                            <img class="bottom-img" src="data:image/jpeg;base64,<?=$show_img ?>">
                            <div class="price">От <?php echo $row['cost'] ?>$</div>
                        </div>
                    </div>                 

                </div>

            </div>

            <div class="cat-bottom border-top">

                <div class="row">

                    <div class="col-md-4 bottom-left p-3">
                        <?php echo $row['kit_html'] ?>
                    </div>

                    <div class="col-md-4 bottom-middle p-3">
                        <?php echo $row['other_html'] ?>
                    </div>

                    <div class="col-md-4 bottom-right p-3">
                        <img class="order-img w-75" src="assets/img/image%2016.png" alt="">
                        <a href="services.php?id=<?php echo $row['id'] ?>" type="button" class=" col-5 btn btn-outline-success order-btn rounded-0">Заказать</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>