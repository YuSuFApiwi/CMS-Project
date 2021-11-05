<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong><?php echo isset($name_alert) ? $name_alert : 'erreur fatale' ?></strong>
    <?php
        echo isset($msg_alert) ? $msg_alert : 'Il y a une erreur';
    ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>