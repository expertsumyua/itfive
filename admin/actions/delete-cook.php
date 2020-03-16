<?php

setcookie("customers_id", '', time() - 1000, "/");
setcookie("status", '', time() - 1000, "/");
setcookie("basket", '', time() - 1000, "/");
header('Location: /');