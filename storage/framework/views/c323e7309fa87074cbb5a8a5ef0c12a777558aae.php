<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h4><?php echo e(config('app.name')); ?></h4>
    <p>Clique no Link abaixo para confirmar o envio da mensagem.</p>
    <p><a href="<?php echo e(route('main_confirm', ['purl' => $purl_code])); ?>">Confirmar mensagem</a></p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\OneTimeMessage\resources\views/emails/email_confirm_message.blade.php ENDPATH**/ ?>