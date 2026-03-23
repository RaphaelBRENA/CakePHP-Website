<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment $comment
 */
?>
<div class="row">
    <aside class="col-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Actions</h4>
            </div>
            <div class="list-group list-group-flush">
                <?= $this->Html->link(__('Edit Comment'), ['action' => 'edit', $comment->id], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Form->postLink(__('Delete Comment'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'class' => 'list-group-item list-group-item-action text-danger']) ?>
                <?= $this->Html->link(__('List Comments'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
                <?= $this->Html->link(__('New Comment'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            </div>
        </div>
    </aside>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="card-title mb-0"><?= h($comment->title) ?></h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th><?= __('User') ?></th>
                        <td><?= $comment->hasValue('user') ? $this->Html->link($comment->user->id, ['controller' => 'Users', 'action' => 'view', $comment->user->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Recipe') ?></th>
                        <td><?= $comment->hasValue('recipe') ? $this->Html->link($comment->recipe->name, ['controller' => 'Recipes', 'action' => 'view', $comment->recipe->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Title') ?></th>
                        <td><?= h($comment->title) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($comment->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Rate') ?></th>
                        <td><?= $comment->rate === null ? '' : $this->Number->format($comment->rate) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Date') ?></th>
                        <td><?= h($comment->date) ?></td>
                    </tr>
                </table>
                <div class="mt-3">
                    <strong><?= __('Comment') ?></strong>
                    <blockquote class="blockquote p-3 bg-light border rounded">
                        <?= $this->Text->autoParagraph(h($comment->comment)); ?>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
