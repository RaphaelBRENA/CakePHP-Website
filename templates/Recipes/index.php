<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Recipe> $recipes
 * @var array $tags
 * @var int|null $tagId
 */
?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title"><?= __('Recettes') ?></h2>

        <?php if (isset($authUser) && $authUser->role == 0): ?>
            <?= $this->Html->link(
                '<i class="fas fa-plus-circle me-2"></i>' . __('Nouvelle Recette'),
                ['action' => 'add'],
                ['class' => 'btn btn-success rounded-pill px-4', 'escape' => false]
            ) ?>
        <?php endif; ?>
    </div>

    <div class="search-container">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <?= $this->Form->control('search', [
                        'label' => false,
                        'placeholder' => '🔍 Rechercher une recette...',
                        'value' => $search ?? null,
                        'class' => 'form-control border-end-0 rounded-pill rounded-end',
                        'id' => 'searchInput',
                        'type' => 'search'
                    ]) ?>
                    <button type="button" class="btn btn-outline-secondary rounded-pill rounded-start" id="voiceSearchBtn">
                        <i class="fas fa-microphone"></i>
                    </button>
                    <?= $this->Form->button(
                        '<i class="fas fa-search me-2"></i> Rechercher',
                        [
                            'class' => 'btn btn-primary ms-2 rounded-pill',
                            'escapeTitle' => false
                        ]
                    ) ?>
                </div>
            </div>
            <div class="col-md-6">
                <?= $this->Form->control('tag', [
                    'options' => $tags,
                    'empty' => '-- Tous les tags --',
                    'label' => '<i class="fas fa-tags me-2"></i> Filtrer par tag',
                    'class' => 'form-select rounded-pill',
                    'value' => $tagId,
                    'escape' => false
                ]) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">
        <?php foreach ($recipes as $recipe): ?>
            <div class="col">
                <div class="card h-100 shadow recipe-card">
                    <?php
                    echo $this->Html->image('uploaded/' . $recipe->id . ".jpg", [
                        "alt" => $recipe->name,
                        "class" => "card-img-top"
                    ]);
                    ?>

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title"><?= h($recipe->name) ?></h5>
                            <?php
                            $badgeClass = 'bg-success';
                            if ($recipe->difficulty_level == 'Difficile') {
                                $badgeClass = 'bg-danger';
                            } elseif ($recipe->difficulty_level == 'Moyen') {
                                $badgeClass = 'bg-warning text-dark';
                            }
                            ?>
                            <span class="badge <?= $badgeClass ?> badge-difficulty">
                                <?= $recipe->difficulty_level === null ? 'N/A' : $recipe->difficulty_level ?>
                            </span>
                        </div>

                        <div class="mb-3">
                            <?php
                            $rating = $recipe->ratings ?? 0;
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                                    echo '<i class="fas fa-star text-warning"></i>';
                                } else if ($i - 0.5 <= $rating) {
                                    echo '<i class="fas fa-star-half-alt text-warning"></i>';
                                } else {
                                    echo '<i class="far fa-star text-warning"></i>';
                                }
                            }
                            ?>
                            <small class="text-muted ms-1">(<?= $recipe->ratings === null ? 'N/A' : $recipe->ratings ?>/5)</small>
                        </div>

                        <div class="recipe-stats">
                            <div class="recipe-stat">
                                <div class="stat-value"><?= $recipe->preparation === null ? '--' : $recipe->preparation ?></div>
                                <div class="stat-label">Préparation (min)</div>
                            </div>
                            <div class="recipe-stat">
                                <div class="stat-value"><?= $recipe->cooking === null ? '--' : $recipe->cooking ?></div>
                                <div class="stat-label">Cuisson (min)</div>
                            </div>
                            <div class="recipe-stat">
                                <div class="stat-value"><?= $recipe->servings === null ? '--' : $recipe->servings ?></div>
                                <div class="stat-label">Portions</div>
                            </div>
                            <div class="recipe-stat">
                                <div class="stat-value"><?= $recipe->price === null ? '--' : $recipe->price ?>€</div>
                                <div class="stat-label">Prix</div>
                            </div>
                        </div>

                        <div class="btn-action-group mt-auto">
                            <?= $this->Html->link(
                                '<i class="fas fa-eye"></i>',
                                ['action' => 'view', $recipe->id],
                                ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'Voir', 'data-bs-toggle' => 'tooltip']
                            )
                            ?>

                            <?php if (isset($authUser) && $authUser->role == 0): ?>
                                <?= $this->Html->link(
                                    '<i class="fas fa-edit"></i>',
                                    ['action' => 'edit', $recipe->id],
                                    ['class' => 'btn btn-sm btn-outline-warning', 'escape' => false, 'title' => 'Éditer', 'data-bs-toggle' => 'tooltip']
                                )
                                ?>

                                <?= $this->Form->postLink(
                                    '<i class="fas fa-trash"></i>',
                                    ['action' => 'delete', $recipe->id],
                                    [
                                        'confirm' => __('Êtes-vous sûr de vouloir supprimer {0} ?', $recipe->name),
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'escape' => false,
                                        'title' => 'Supprimer',
                                        'data-bs-toggle' => 'tooltip'
                                    ]
                                )
                                ?>
                                <?= $this->Html->link(
                                    '<i class="fas fa-language"></i>',
                                    ['action' => 'translate', $recipe->id],
                                    ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false, 'title' => 'Traduire', 'data-bs-toggle' => 'tooltip']
                                )
                                ?>
                                <?= $this->Html->link(
                                    '<i class="fas fa-share"></i>',
                                    ['action' => 'share', $recipe->id],
                                    ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'Partager', 'data-bs-toggle' => 'tooltip']
                                )
                                ?>
                            <?php endif; ?>

                            <?php if (isset($authUser)): ?>
                                <?= $this->Html->link(
                                    '<i class="fas fa-shopping-cart"></i>',
                                    ['controller' => 'cart', 'action' => 'add', $recipe->id],
                                    ['class' => 'btn btn-sm btn-outline-success', 'escape' => false, 'title' => 'Ajouter au panier', 'data-bs-toggle' => 'tooltip']
                                )
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (count($recipes) == 0): ?>
        <div class="text-center p-5 bg-light rounded-3 mb-4">
            <i class="fas fa-utensils fa-4x text-muted mb-3"></i>
            <h4>Aucune recette trouvée</h4>
            <?= $this->Html->link(
                '<i class="fas fa-plus-circle me-2"></i>' . __('Ajouter une recette'),
                ['action' => 'add'],
                ['class' => 'btn btn-success mt-3', 'escape' => false]
            ) ?>
        </div>
    <?php endif; ?>

    <!-- Language Switcher -->
    <div class="language-switcher text-center">
        <h5 class="mb-3"><?= __('Changer de langue') ?></h5>
        <?php
        $baseUrl = [
            'controller' => $this->request->getParam('controller'),
            'action' => $this->request->getParam('action'),
            'pass' => $this->request->getParam('pass')
        ];
        ?>

        <div class="btn-group" role="group" aria-label="Language Switcher">
            <?= $this->Html->link(
                '<img src="/img/france_flag.svg" width="20" class="me-2" alt="FR">Français',
                array_merge($baseUrl, ['?' => ['lang' => 'fr']]),
                ['class' => 'btn btn-' . ($currentLanguage === 'fr' ? 'primary' : 'outline-primary'), 'escape' => false]
            ) ?>

            <?= $this->Html->link(
                '<img src="/img/uk_flag.svg" width="20" class="me-2" alt="EN">English',
                array_merge($baseUrl, ['?' => ['lang' => 'en']]),
                ['class' => 'btn btn-' . ($currentLanguage === 'en' ? 'primary' : 'outline-primary'), 'escape' => false]
            ) ?>
        </div>
    </div>

    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false, 'class' => 'page-item']) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false, 'class' => 'page-item']) ?>
            <?= $this->Paginator->numbers(['class' => 'page-item']) ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false, 'class' => 'page-item']) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false, 'class' => 'page-item']) ?>
        </ul>
    </nav>
</div>

<?php $this->Html->script('speech-recognition.js', ['block' => true]); ?>

