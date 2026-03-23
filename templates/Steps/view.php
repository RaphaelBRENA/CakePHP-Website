<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Step $step
 */
?>
<div class="row">
    <aside class="col-md-4">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Step'), ['action' => 'edit', $step->id], ['class' => 'side-nav-item btn btn-warning btn-block mb-2']) ?>
            <?= $this->Form->postLink(__('Delete Step'), ['action' => 'delete', $step->id], ['confirm' => __('Are you sure you want to delete # {0}?', $step->id), 'class' => 'side-nav-item btn btn-danger btn-block mb-2']) ?>
            <?= $this->Html->link(__('List Steps'), ['action' => 'index'], ['class' => 'side-nav-item btn btn-primary btn-block mb-2']) ?>
            <?= $this->Html->link(__('New Step'), ['action' => 'add'], ['class' => 'side-nav-item btn btn-success btn-block']) ?>
        </div>
    </aside>
    <div class="col-md-8">
        <div class="steps view content">
            <h3><?= h($step->id) ?></h3>
            <table class="table table-bordered">
                <tr>
                    <th><?= __('Recipe') ?></th>
                    <td><?= $step->hasValue('recipe') ? $this->Html->link($step->recipe->name, ['controller' => 'Recipes', 'action' => 'view', $step->recipe->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($step->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Step Number') ?></th>
                    <td><?= $step->step_number === null ? '' : $this->Number->format($step->step_number) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote class="blockquote">
                    <?= $this->Text->autoParagraph(h($step->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>