<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ustensil $ustensil
 * @var string[]|\Cake\Collection\CollectionInterface $recipes
 */
?>
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar Actions -->
        <aside class="col-md-3">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><?= __('Actions') ?></h5>
                </div>
                <div class="list-group list-group-flush">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ustensil->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $ustensil->id),
                        'class' => 'list-group-item list-group-item-action text-danger'
                    ]) ?>
                    <?= $this->Html->link(__('List Ustensils'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0"><?= __('Edit Ustensil') ?></h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($ustensil, ['class' => 'needs-validation', 'novalidate' => true]) ?>
                    <fieldset>
                        <div class="mb-3">
                            <?= $this->Form->control('name', [
                                'class' => 'form-control',
                                'label' => ['text' => 'Nom de l\'ustensile', 'class' => 'form-label']
                            ]) ?>
                        </div>

                        <div class="mb-3">
                            <?= $this->Form->control('recipes._ids', [
                                'type' => 'select',
                                'multiple' => 'checkbox',
                                'options' => $recipes,
                                'class' => 'form-check-input',
                                'label' => ['text' => 'Recettes associées', 'class' => 'form-label']
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