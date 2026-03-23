<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Step $step
 * @var string[]|\Cake\Collection\CollectionInterface $recipes
 */
?>
<div class="row">
    <aside class="col-md-4">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $step->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $step->id), 'class' => 'side-nav-item btn btn-danger']
            ) ?>
            <?= $this->Html->link(__('List Steps'), ['action' => 'index'], ['class' => 'side-nav-item btn btn-primary']) ?>
        </div>
    </aside>
    <div class="col-md-8">
        <div class="steps form content">
            <?= $this->Form->create($step) ?>
            <fieldset>
                <legend><?= __('Edit Step') ?></legend>
                <?php
                echo $this->Form->control('recipe_id', [
                    'options' => $recipes,
                    'empty' => true,
                    'class' => 'form-control'
                ]);
                echo $this->Form->control('step_number', ['class' => 'form-control']);
                echo $this->Form->control('description', ['class' => 'form-control']);
                ?>
            </fieldset>
            <div class="form-group">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>