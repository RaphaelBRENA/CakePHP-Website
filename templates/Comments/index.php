<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Comment> $comments
 */
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><?= __('Comments') ?></h3>
        <?= $this->Html->link(__('New Comment'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('recipe_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('rate') ?></th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?= $this->Number->format($comment->id) ?></td>
                    <td><?= $comment->hasValue('user') ? $this->Html->link($comment->user->id, ['controller' => 'Users', 'action' => 'view', $comment->user->id]) : '' ?></td>
                    <td><?= $comment->hasValue('recipe') ? $this->Html->link($comment->recipe->name, ['controller' => 'Recipes', 'action' => 'view', $comment->recipe->id]) : '' ?></td>
                    <td><?= h($comment->title) ?></td>
                    <td><?= h($comment->date) ?></td>
                    <td><?= $comment->rate === null ? '' : $this->Number->format($comment->rate) ?></td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $comment->id], ['class' => 'btn btn-info btn-sm']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $comment->id], ['class' => 'btn btn-warning btn-sm']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'class' => 'btn btn-danger btn-sm']) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('First'), ['class' => 'page-link']) ?>
                <?= $this->Paginator->prev('< ' . __('Previous'), ['class' => 'page-link']) ?>
                <?= $this->Paginator->numbers(['class' => 'page-link']) ?>
                <?= $this->Paginator->next(__('Next') . ' >', ['class' => 'page-link']) ?>
                <?= $this->Paginator->last(__('Last') . ' >>', ['class' => 'page-link']) ?>
            </ul>
        </div>
        <p class="text-muted">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </p>
    </div>
</div>