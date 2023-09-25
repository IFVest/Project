<?php
    if (isset($errorMsgs) && (trim($errorMsgs) != "")) {
        echo '<div class="alert alert-danger" role="alert">'.$errorMsgs.' <\div>';
    }
?>