<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ustensil $ustensil
 * @var \Cake\Collection\CollectionInterface|string[] $recipes
 */
?>
<div class="container mt-4">
    <div class="row">
        <aside class="col-md-3">
            <div class="list-group">
                <h4 class="list-group-item list-group-item-action active"><?= __('Actions') ?></h4>
                <?= $this->Html->link(__('List Ustensils'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            </div>
        </aside>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><?= __('Add Ustensil') ?></h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($ustensil, ['type' => 'file', 'class' => 'needs-validation', 'novalidate' => true]) ?>
                    <fieldset>
                        <div class="mb-3">
                            <?= $this->Form->control('name', [
                                'class' => 'form-control',
                                'label' => ['text' => 'Nom de l\'ustensile', 'class' => 'form-label']
                            ]) ?>
                        </div>
                        <div class="mb-3">
                            <?= $this->Form->control('recipes._ids', [
                                'options' => $recipes,
                                'class' => 'form-select',
                                'label' => ['text' => 'Associer aux recettes', 'class' => 'form-label']
                            ]) ?>
                        </div>
                        <div class="mb-3">
                            <?= $this->Form->control('image', [
                                'type' => 'file',
                                'class' => 'form-control',
                                'label' => ['text' => 'Image de l\'ustensile de cuisine', 'class' => 'form-label']
                            ]) ?>
                        </div>
                    </fieldset>
                    <div class="d-grid gap-2">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>