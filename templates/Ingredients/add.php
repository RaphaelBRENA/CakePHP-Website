<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ingredient $ingredient
 * @var \Cake\Collection\CollectionInterface|string[] $recipes
 */
?>
<div class="container mt-4">
    <div class="row">
        <aside class="col-md-3">
            <div class="card p-3">
                <h4 class="card-title"><?= __('Actions') ?></h4>
                <div class="list-group">
                    <?= $this->Html->link(__('Liste des Ingrédients'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </aside>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?= __('Ajouter un Ingrédient') ?></h3>

                    <?= $this->Form->create($ingredient, ['type' => 'file']) ?>
                    <fieldset>
                        <div class="mb-3">
                            <?= $this->Form->control('name', [
                                'class' => 'form-control',
                                'label' => ['text' => 'Nom', 'class' => 'form-label']
                            ]) ?>
                        </div>

                        <div class="mb-3">
                            <?= $this->Form->control('unit', [
                                'type' => 'select',
                                'options' => [
                                    'g' => 'Grammes (g)',
                                    'kg' => 'Kilogrammes (kg)',
                                    'ml' => 'Millilitres (ml)',
                                    'l' => 'Litres (l)',
                                    'c.à.c' => 'Cuillères à café',
                                    'c.à.s' => 'Cuillères à soupe',
                                    'pincées' => 'Pincées',
                                    'unités' => 'Unités',
                                ],
                                'class' => 'form-select',
                                'label' => ['text' => 'Unité', 'class' => 'form-label']
                            ]) ?>
                        </div>

                        <div class="mb-3">
                            <?= $this->Form->control('image', [
                                'type' => 'file',
                                'class' => 'form-control',
                                'label' => ['text' => 'Image', 'class' => 'form-label']
                            ]) ?>
                        </div>
                    </fieldset>

                    <div class="d-grid gap-2">
                        <?= $this->Form->button(__('Valider'), ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

