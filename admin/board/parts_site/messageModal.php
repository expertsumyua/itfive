<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $title ?></h5>
        <a href="/board.php?board=<?php echo $_GET["board"]?>" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
        </div>
        <form action="<?php echo $link?>" method="POST">
            <div class="modal-body">

              <p><h3><?php echo $message_modal?></h3></p>

            </div>
            <div class="modal-footer">
            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>-->
            
            <?php
            if ($link != "") {
                ?>
                <a href="<?php echo $link ?>" class="btn btn-outline-secondary btn-lg" role="button" aria-pressed="true">OK</a>
                <?php
            } else {
              ?>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
              <?php
            }             
            ?>
            
            </div>
        </form>

    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>