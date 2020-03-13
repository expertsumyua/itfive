<div class="row">
    <div class="col-12 px-5 my-4">
        <div class="border">

            <div class="cat-top p-3">
                <div class="row">
                    <div class="col-md-8 top-left">

                        <div class="cat-header">
                            <h3 class="mb-4 col-8 border-bottom">
                                <?php echo $row['title'] ?>
                            </h3>                            
                        </div>

                        <div class="cat-col-text px-3">
                            <p><?php echo $row['description'] ?></p>
                        </div>  
                        <div class="row px-5">
                            <div class="price mr-5">От <?php echo $row['cost'] ?>$</div>
                            <div>
                                <a href="services.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-success mx-5 rounded-0">Заказать</a>
                            </div>
                        </div>
                        
                        
 
                    </div>
                    <div class="col-md-4 top-right">
                        <?php $show_img = base64_encode($row['img']) ?>
                        <img class="bottom-img" src="data:image/jpeg;base64,<?=$show_img ?>">
                        <!-- <img class="order-img" src="assets/img/image%2016.png" alt=""> -->
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>