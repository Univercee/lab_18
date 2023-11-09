<div class="d-flex flex-column text-danger">
    <?php
        if(!empty($_SESSION['errors'])){
            foreach($_SESSION['errors'] as $error){
                echo "<p>$error</p>";
            }
        }
        unset($_SESSION['errors']);
    ?>
</div>