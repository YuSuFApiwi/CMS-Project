<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><?php echo isset($name_alert) ? $name_alert : 'Fait avec succès' ?></strong>
    <?php
        echo isset($msg_alert) ? $msg_alert : 'opération réussie';
    ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>