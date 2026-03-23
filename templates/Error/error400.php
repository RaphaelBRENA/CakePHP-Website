<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="score">Fromages collectés: 0</div>
<div id="instructions">ERREUR <?= $this->get('code') ?></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
<noscript>
    <div class="error-wrapper">
        <h1>400</h1>
        <p>Oups ! Il semblerait que cette page n'existe pas.</p>
    </div>
</noscript>
<?= $this->Html->script('error.js') ?>
<?= $this->Html->css('error') ?>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="score">Fromages collectés: 0</div>
<div id="instructions">ERREUR <?= $this->get('code') ?></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
<noscript>
    <div class="error-wrapper">
        <h1>400</h1>
        <p>Oups ! Il semblerait que cette page n'existe pas.</p>
    </div>
</noscript>
<?= $this->Html->script('error.js') ?>
<?= $this->Html->css('error') ?>
</body>
</html>
<?php
///**
// * @var \App\View\AppView $this
// * @var string $message
// * @var string $url
// */
//use Cake\Core\Configure;
//
//$this->layout = 'error';
//
//if (Configure::read('debug')) :
//    $this->layout = 'dev_error';
//
//    $this->assign('title', $message);
//    $this->assign('templateName', 'error400.php');
//
//    $this->start('file');
//    echo $this->element('auto_table_warning');
//    $this->end();
//endif;
//?>
<!--<h2>--><?php //= h($message) ?><!--</h2>-->
<!--<p class="error">-->
<!--    <strong>--><?php //= __d('cake', 'Error') ?><!--: </strong>-->
<!--    --><?php //= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
<!--</p>-->
