<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Recipe $recipe
 * @var string[]|\Cake\Collection\CollectionInterface $ingredients
 * @var string[]|\Cake\Collection\CollectionInterface $tags
 * @var string[]|\Cake\Collection\CollectionInterface $ustensils
 */
?>
<div class="container mt-4">
    <div class="row">
        <!-- Barre latérale avec les actions -->
        <aside class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0"><?= __('Actions') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->postLink(
                        __('Supprimer'),
                        ['action' => 'delete', $recipe->id],
                        [
                            'confirm' => __('Êtes-vous sûr de vouloir supprimer la recette # {0} ?', $recipe->id),
                            'class' => 'btn btn-danger w-100 mb-2'
                        ]
                    ) ?>
                    <?= $this->Html->link(
                        __('Liste des Recettes'),
                        ['action' => 'index'],
                        ['class' => 'btn btn-outline-primary w-100']
                    ) ?>
                </div>
            </div>
        </aside>

       
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><?= __('Modifier la Recette') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($recipe, ['class' => 'needs-validation', 'novalidate' => true]) ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= $this->Form->control('name', [
                                'class' => 'form-control',
                                'label' => 'Nom de la recette'
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('description', [
                                'class' => 'form-control',
                                'label' => 'Description'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $this->Form->control('preparation', [
                                'class' => 'form-control',
                                'label' => 'Temps de préparation (min)'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $this->Form->control('resting', [
                                'class' => 'form-control',
                                'label' => 'Temps de repos (min)'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $this->Form->control('cooking', [
                                'class' => 'form-control',
                                'label' => 'Temps de cuisson (min)'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $this->Form->control('servings', [
                                'class' => 'form-control',
                                'label' => 'Portions'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $this->Form->control('difficulty_level', [
                                'class' => 'form-control',
                                'label' => 'Niveau de difficulté'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $this->Form->control('price', [
                                'class' => 'form-control',
                                'label' => 'Prix (€)'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $this->Form->control('ratings', [
                                'class' => 'form-control',
                                'label' => 'Évaluations'
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('ingredients._ids', [
                                'class' => 'form-select',
                                'label' => 'Ingrédients',
                                'multiple' => true,
                                'options' => $ingredients
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('tags._ids', [
                                'class' => 'form-select',
                                'label' => 'Tags',
                                'multiple' => true,
                                'options' => $tags
                            ]) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $this->Form->control('ustensils._ids', [
                                'class' => 'form-select',
                                'label' => 'Ustensiles',
                                'multiple' => true,
                                'options' => $ustensils
                            ]) ?>
                        </div>
                    </div>

                   
                    <div class="mt-4 text-end">
                        <?= $this->Form->button(__('Enregistrer'), ['class' => 'btn btn-success']) ?>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
