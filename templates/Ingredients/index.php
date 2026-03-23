<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ingredient> $ingredients
 */
?>
<div class="ingredients index content container mt-4">
    <?= $this->Html->link(__('New Ingredient'), ['action' => 'add'], ['class' => 'btn btn-success mb-3 float-right']) ?>
    <h3 class="mb-4"><?= __('Ingredients') ?></h3>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('unit') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ingredients as $ingredient): ?>
                <tr>
                    <td><?= $this->Number->format($ingredient->id) ?></td>
                    <td><?= h($ingredient->name) ?></td>
                    <td><?= h($ingredient->unit) ?></td>
                    <td class="text-center">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ingredient->id], ['class' => 'btn btn-info btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ingredient->id], ['class' => 'btn btn-warning btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ingredient->id], [
                            'class' => 'btn btn-danger btn-sm',
                            'confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id)
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="paginator text-center mt-3">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<< ' . __('First'), ['class' => 'page-item']) ?>
            <?= $this->Paginator->prev('< ' . __('Previous'), ['class' => 'page-item']) ?>
            <?= $this->Paginator->numbers(['class' => 'page-item', 'tag' => 'li', 'currentClass' => 'active']) ?>
            <?= $this->Paginator->next(__('Next') . ' >', ['class' => 'page-item']) ?>
            <?= $this->Paginator->last(__('Last') . ' >>', ['class' => 'page-item']) ?>
        </ul>
        <p class="text-muted"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
