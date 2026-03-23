<?= $this->Html->css('cartIndex.css') ?>
<div class="night-sky-overlay"></div>
<div class="bistro-lights bistro-lights-1"></div>
<div class="main-container">
    <div class="bistro-sign">
        <div class="bistro-sign-inner">
            <h1>Ratatouille</h1>
            <div class="bistro-tagline">Votre Panier Gourmand</div>
        </div>
    </div>
    <div class="cart-content">
        <?php if (!empty($cart)) : ?>
            <div class="tablecloth-container">
                <div class="tablecloth-pattern"></div>
                <table class="bistro-table">
                    <thead>
                    <tr>
                        <th scope="col">Aperçu</th>
                        <th scope="col">Recette du Chef</th>
                        <th scope="col">Nombre de Portions</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cart as $item) : ?>
                        <tr>
                            <td class="dish-image">
                                <div class="plate-container">
                                    <?= $this->Html->image('uploaded/' . $item['id'] . ".jpg", [
                                        "alt" => "Image non chargée",
                                        "class" => "dish-thumbnail"
                                    ]); ?>
                                </div>
                            </td>
                            <td class="dish-name">
                                <?= $this->Html->link(
                                    h($item['name']),
                                    ['controller' => 'Recipes', 'action' => 'view', $item['id']],
                                    ['class' => 'dish-link']
                                ) ?>
                            </td>
                            <td class="dish-quantity">
                                <?= $this->Form->create(null, [
                                    'url' => ['action' => 'update', $item['id']],
                                    'class' => 'quantity-form'
                                ]) ?>
                                <div class="quantity-control">
                                    <input type="number" name="quantity" min="1" class="quantity-input" value="<?= h($item['quantity']) ?>">
                                </div>
                                <button type="submit" class="bistro-button update-button">
                                    <span>Mettre à jour</span>
                                </button>
                                <?= $this->Form->end() ?>
                            </td>
                            <td class="dish-actions">
                                <?= $this->Html->link(
                                    '<i class="fas fa-trash"></i> <span>Supprimer</span>',
                                    ['action' => 'remove', $item['id']],
                                    ['class' => 'bistro-button remove-button', 'escape' => false]
                                ) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="table-edge"></div>
            </div>
            <div class="cart-actions">
                <div class="french-flag-divider">
                    <div class="flag-blue"></div>
                    <div class="flag-white"></div>
                    <div class="flag-red"></div>
                </div>
                <div class="action-buttons">
                    <?= $this->Html->link(
                        '<i class="fas fa-trash-alt"></i> <span>Vider le panier</span>',
                        ['action' => 'clear'],
                        ['class' => 'bistro-button clear-button', 'escape' => false]
                    ) ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-utensils"></i> <span>Préparer les ingrédients</span>',
                        ['controller' => 'ShoppingList', 'action' => 'index'],
                        ['class' => 'bistro-button checkout-button', 'escape' => false]
                    ) ?>
                </div>
            </div>
        <?php else : ?>
            <div class="empty-cart">
                <div class="empty-plate"></div>
                <p>Votre panier est vide comme une assiette après le service!</p>
                <div class="empty-quote">
                    "Tout le monde peut cuisiner, mais seuls les esprits courageux peuvent devenir de grands chefs"
                </div>
                <?= $this->Html->link(
                    'Découvrir nos recettes',
                    ['controller' => 'Recipes', 'action' => 'index'],
                    ['class' => 'bistro-button discover-button']
                ) ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="bistro-footer">
        <div class="footer-content">
            <div class="footer-text">Votre Panier Gourmand></div>
        </div>
    </div>
</div>

