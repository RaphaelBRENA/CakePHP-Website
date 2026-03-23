<?= $this->Html->css('shoppingList.css') ?>
<div class="night-sky-overlay"></div>
<div class="bistro-lights bistro-lights-1"></div>
<div class="bistro-lights bistro-lights-2"></div>
<div class="main-container">
    <div class="bistro-sign">
        <div class="bistro-sign-inner">
            <h1>Ratatouille</h1>
            <div class="bistro-tagline">Liste du Marché</div>
        </div>
    </div>
    <div class="shopping-list-content">
        <div class="shopping-list-header">
            <h2>Liste des Ingrédients</h2>
        </div>
        <?php if (!empty($ingredientsList)) : ?>
            <div class="shopping-list-table-container">
                <div class="shopping-list-table-wrapper">
                    <table class="bistro-table">
                        <thead>
                        <tr>
                            <th class="ingredient-name-header">Ingrédient</th>
                            <th class="ingredient-quantity-header">Quantité</th>
                            <th class="ingredient-unit-header">Unité</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ingredientsList as $index => $ingredient): ?>
                            <tr class="ingredient-row" data-index="<?= $index ?>">
                                <td class="ingredient-name">
                                    <div class="ingredient-icon-wrapper">
                                        <div class="ingredient-icon ingredient-icon-<?= $index % 8 + 1 ?>"></div>
                                    </div>
                                    <span><?= h($ingredient['name']) ?></span>
                                </td>
                                <td class="ingredient-quantity"><?= h($ingredient['quantity']) ?></td>
                                <td class="ingredient-unit"><?= h($ingredient['unit']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-decoration table-decoration-bottom"></div>
            </div>
        <?php else : ?>
            <div class="empty-list">
                <div class="empty-basket"></div>
                <p>Votre liste de courses est vide!</p>
                <div class="empty-quote">
                    "L'art de la cuisine commence par une liste d'ingrédients parfaite"
                </div>
                <?= $this->Html->link(
                    'Retour au panier',
                    ['controller' => 'Cart', 'action' => 'index'],
                    ['class' => 'bistro-button return-button']
                ) ?>
            </div>
        <?php endif; ?>
        <div class="export-section">
            <div class="french-flag-divider">
                <div class="flag-blue"></div>
                <div class="flag-white"></div>
                <div class="flag-red"></div>
            </div>
            <div class="export-header">
                <div class="export-icon"></div>
                <h3>Exportation de la Liste</h3>
            </div>
            <div class="export-description">
                <p>Exportez votre liste de courses dans le format de votre choix</p>
            </div>
            <div class="export-buttons-container">
                <div class="export-buttons">
                    <div class="export-row">
                        <?= $this->Html->link(
                            '<i class="fas fa-file-pdf"></i><span>PDF</span>',
                            ['action' => 'exportPDF'],
                            ['class' => 'export-button export-pdf', 'escape' => false]
                        ) ?>
                        <?= $this->Html->link(
                            '<i class="fas fa-file-excel"></i><span>Excel</span>',
                            ['action' => 'exportExcel'],
                            ['class' => 'export-button export-excel', 'escape' => false]
                        ) ?>
                        <?= $this->Html->link(
                            '<i class="fas fa-file-powerpoint"></i><span>PowerPoint</span>',
                            ['action' => 'exportPowerPoint'],
                            ['class' => 'export-button export-powerpoint', 'escape' => false]
                        ) ?>
                    </div>
                    <div class="export-row">
                        <?= $this->Html->link(
                            '<i class="fas fa-file-word"></i><span>Word</span>',
                            ['action' => 'exportWord'],
                            ['class' => 'export-button export-word', 'escape' => false]
                        ) ?>
                        <?= $this->Html->link(
                            '<i class="fas fa-file-image"></i><span>PNG</span>',
                            ['action' => 'exportPng'],
                            ['class' => 'export-button export-png', 'escape' => false]
                        ) ?>
                        <?= $this->Html->link(
                            '<i class="fas fa-file-alt"></i><span>Texte</span>',
                            ['action' => 'exportTxt'],
                            ['class' => 'export-button export-txt', 'escape' => false]
                        ) ?>
                    </div>
                    <div class="export-row">
                        <?= $this->Html->link(
                            '<i class="fas fa-file-code"></i><span>JSON</span>',
                            ['action' => 'exportJson'],
                            ['class' => 'export-button export-json', 'escape' => false]
                        ) ?>
                        <?= $this->Html->link(
                            '<i class="fas fa-file-code"></i><span>XML</span>',
                            ['action' => 'exportXml'],
                            ['class' => 'export-button export-xml', 'escape' => false]
                        ) ?>
                        <?= $this->Html->link(
                            '<i class="fas fa-file-csv"></i><span>CSV</span>',
                            ['action' => 'exportCsv'],
                            ['class' => 'export-button export-csv', 'escape' => false]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="actions-footer">
        <?= $this->Html->link(
            '<i class="fas fa-arrow-left"></i> Retour au panier',
            ['controller' => 'Cart', 'action' => 'index'],
            ['class' => 'bistro-button return-button', 'escape' => false]
        ) ?>
    </div>
</div>
