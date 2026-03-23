<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Step> $steps
 */
?>
<div class="steps index content">
    <?= $this->Html->link(__('New Step'), ['action' => 'add'], ['class' => 'btn btn-primary float-right mb-3']) ?>
    <h3><?= __('Steps') ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('recipe_id') ?></th>
                    <th><?= $this->Paginator->sort('step_number') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($steps as $step): ?>
                    <tr>
                        <td><?= $this->Number->format($step->id) ?></td>
                        <td><?= $step->hasValue('recipe') ? $this->Html->link($step->recipe->name, ['controller' => 'Recipes', 'action' => 'view', $step->recipe->id]) : '' ?></td>
                        <td><?= $step->step_number === null ? '' : $this->Number->format($step->step_number) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $step->id], ['class' => 'btn btn-info btn-sm']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $step->id], ['class' => 'btn btn-warning btn-sm']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $step->id], [
                                'confirm' => __('Are you sure you want to delete # {0}?', $step->id),
                                'class' => 'btn btn-danger btn-sm'
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<< ' . __('first'), ['class' => 'page-item']) ?>
            <?= $this->Paginator->prev('< ' . __('previous'), ['class' => 'page-item']) ?>
            <?= $this->Paginator->numbers(['class' => 'page-item']) ?>
            <?= $this->Paginator->next(__('next') . ' >', ['class' => 'page-item']) ?>
            <?= $this->Paginator->last(__('last') . ' >>', ['class' => 'page-item']) ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>