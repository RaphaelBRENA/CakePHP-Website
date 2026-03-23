<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 * @var string[]|\Cake\Collection\CollectionInterface $recipes
 */
?>
<div class="row">
    <aside class="col-md-3">
        <div class="card bg-light p-3 mb-3">
            <h4 class="card-title"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tag->id],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $tag->id),
                    'class' => 'btn btn-danger w-100 mb-2'
                ]
            ) ?>
            <?= $this->Html->link(__('List Tags'), ['action' => 'index'], ['class' => 'btn btn-secondary w-100']) ?>
        </div>
    </aside>

    <div class="col-md-9">
        <div class="card p-4">
            <h3 class="card-title"><?= __('Edit Tag') ?></h3>
            <?= $this->Form->create($tag) ?>
            <fieldset>
                <legend class="mb-3"><?= __('Tag Details') ?></legend>
                <?php
                echo $this->Form->control('name', ['class' => 'form-control mb-3']);
                echo $this->Form->control('recipes._ids', ['options' => $recipes, 'class' => 'form-select']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success mt-3']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>