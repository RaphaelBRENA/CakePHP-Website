<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Recipe $recipe
 * @var \Cake\Collection\CollectionInterface|string[] $ingredients
 * @var \Cake\Collection\CollectionInterface|string[] $tags
 * @var \Cake\Collection\CollectionInterface|string[] $ustensils
 */
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card p-3">
                <h4 class="mb-3"><?= __('Actions') ?></h4>
                <?= $this->Html->link(__('Liste des recettes'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card p-4 shadow-sm">
                <h2 class="mb-4"><?= __('Ajouter une Recette') ?></h2>
                
                <?= $this->Form->create($recipe, ['class' => 'needs-validation', 'type' => 'file']) ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $this->Form->control('name', ['class' => 'form-control mb-3', 'label' => 'Nom']) ?>
                        <?= $this->Form->control('description', ['type' => 'textarea', 'class' => 'form-control mb-3']) ?>
                        <?= $this->Form->control('preparation', ['class' => 'form-control mb-3', 'label' => 'Temps de préparation (min)']) ?>
                        <?= $this->Form->control('resting', ['class' => 'form-control mb-3', 'label' => 'Temps de repos (min)']) ?>
                        <?= $this->Form->control('cooking', ['class' => 'form-control mb-3', 'label' => 'Temps de cuisson (min)']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('servings', ['class' => 'form-control mb-3', 'label' => 'Nombre de portions']) ?>
                        <?= $this->Form->control('difficulty_level', ['class' => 'form-control mb-3', 'label' => 'Niveau de difficulté']) ?>
                        <?= $this->Form->control('price', ['class' => 'form-control mb-3', 'label' => 'Prix']) ?>
                        <?= $this->Form->control('ratings', ['class' => 'form-control mb-3', 'label' => 'Évaluation']) ?>
                    </div>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('ingredients._ids', ['options' => $ingredients, 'class' => 'form-select', 'label' => 'Ingrédients']) ?>
                </div>
                
                <div class="mb-3">
                    <?= $this->Form->control('tags._ids', ['options' => $tags, 'class' => 'form-select', 'label' => 'Tags']) ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('ustensils._ids', ['options' => $ustensils, 'class' => 'form-select', 'label' => 'Ustensiles']) ?>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('image', ['type' => 'file', 'class' => 'form-control', 'label' => 'Image de la recette']) ?>
                </div>

                <?= $this->Form->button(__('Soumettre'), ['class' => 'btn btn-success']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
