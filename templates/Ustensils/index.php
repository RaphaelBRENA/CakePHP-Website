<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ustensil> $ustensils
 */
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><?= __('Ustensils') ?></h3>
        <?= $this->Html->link(__('New Ustensil'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ustensils as $ustensil): ?>
                    <tr>
                        <td><?= $this->Number->format($ustensil->id) ?></td>
                        <td><?= h($ustensil->name) ?></td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $ustensil->id], ['class' => 'btn btn-info btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ustensil->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ustensil->id], [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $ustensil->id),
                                    'class' => 'btn btn-danger btn-sm'
                                ]) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<< ' . __('First'), ['class' => 'page-link']) ?>
            <?= $this->Paginator->prev('< ' . __('Previous'), ['class' => 'page-link']) ?>
            <?= $this->Paginator->numbers(['class' => 'page-link']) ?>
            <?= $this->Paginator->next(__('Next') . ' >', ['class' => 'page-link']) ?>
            <?= $this->Paginator->last(__('Last') . ' >>', ['class' => 'page-link']) ?>
        </ul>
    </nav>

    <p class="text-center text-muted">
        <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
    </p>
</div>