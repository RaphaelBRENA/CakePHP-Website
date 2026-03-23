<?php
$cakeDescription = 'Ratatouille';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $cakeDescription ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css') ?>
    <?= $this->Html->css('style') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
    <?= $this->Html->css('cart.css') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3010d94d2f.js" crossorigin="anonymous"></script>


</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Ratatouille</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <?= $this->Html->link('Accueil', ['controller' => 'Recipes', 'action' => 'index'], ['class' => 'nav-link']) ?>
                    </li>


                    <?php if (isset($authUser) && $authUser->role == 0): ?>
                        <li class="nav-item">
                            <?= $this->Html->link('Ajouter une recette', ['controller' => 'Recipes', 'action' => 'add'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link('Ingrédients', ['controller' => 'Ingredients', 'action' => 'index'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link('Ustensiles', ['controller' => 'Ustensils', 'action' => 'index'], ['class' => 'nav-link']) ?>
                        </li>

                    <?php endif; ?>

                    <?php if (isset($authUser)): ?>
                        <li class="cart-container">
                            <a href="<?= $this->Url->build(['controller' => 'Cart', 'action' => 'index']) ?>" class="cart-link">
                                <img src="<?= $this->Url->image('cart.png') ?>" alt="Panier" class="cart-icon">
                                <span id="cart-count" class="cart-count"><?= $this->request->getSession()->read('Cart') ? count($this->request->getSession()->read('Cart')) : 0 ?></span>
                            </a>
                        </li>
                        <li>
                            <?= $this->Html->link('Se déconnecter', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?>

                        </li>
                         <?php endif; ?>



                    <li class="nav-item">
                        <?php if (!isset($authUser)): ?>
                            <?= $this->Html->link('Se connecter', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
                            <?= $this->Html->link('S\'inscrire', ['controller' => 'Users', 'action' => 'subscribe'], ['class' => 'nav-link']) ?>
                        <?php endif; ?>
                        <?= $this->Html->link('Magasins', ['controller' => 'ShoppingList', 'action' => 'stores'], ['class' => 'nav-link']) ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p class="mb-0">&copy; <?= date('Y') ?> Ratatouille - Tous droits réservés</p>
    </footer>

</body>

</html>
