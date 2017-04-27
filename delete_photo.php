<?php

    $photo = $_GET[file];

    if (file_exists($photo)) {
        unlink ($photo);
    }

?>
