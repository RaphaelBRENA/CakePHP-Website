<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */
?>
<div class="row">
    <aside class="col-md-3">
        <div class="card bg-light p-3 mb-3">
            <h4 class="card-title"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tag'), ['action' => 'edit', $tag->id], ['class' => 'btn btn-warning w-100 mb-2']) ?>
            <?= $this->Form->postLink(
                __('Delete Tag'),
                ['action' => 'delete', $tag->id],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $tag->id),
                    'class' => 'btn btn-danger w-100 mb-2'
                ]
            )
            ?>
            <?= $this->Html->link(__('List Tags'), ['action' => 'index'], ['class' => 'btn btn-secondary w-100 mb-2']) ?>
            <?= $this->Html->link(__('New Tag'), ['action' => 'add'], ['class' => 'btn btn-primary w-100']) ?>
        </div>
    </aside>

    <div class="col-md-9">
        <div class="card p-4">
            <h3 class="card-title"><?= h($tag->name) ?></h3>
            <table class="table table-striped table-bordered">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($tag->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tag->id) ?></td>
                </tr>
            </table>

            <div class="related mt-4">
                <h4><?= __('Related Recipes') ?></h4>
                <?php if (!empty($tag->recipes)) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Name') ?></th>
                                    <th><?= __('Description') ?></th>
                                    <th><?= __('Preparation') ?></th>
                                    <th><?= __('Resting') ?></th>
                                    <th><?= __('Cooking') ?></th>
                                    <th><?= __('Servings') ?></th>
                                    <th><?= __('Difficulty Level') ?></th>
                                    <th><?= __('Price') ?></th>
                                    <th><?= __('Ratings') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tag->recipes as $recipe) : ?>
                                    <tr>
                                        <td><?= h($recipe->id) ?></td>
                                        <td><?= h($recipe->name) ?></td>
                                        <td><?= h($recipe->description) ?></td>
                                        <td><?= h($recipe->preparation) ?></td>
                                        <td><?= h($recipe->resting) ?></td>
                                        <td><?= h($recipe->cooking) ?></td>
                                        <td><?= h($recipe->servings) ?></td>
                                        <td><?= h($recipe->difficulty_level) ?></td>
                                        <td><?= h($recipe->price) ?></td>
                                        <td><?= h($recipe->ratings) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                __('View'),
                                                ['controller' => 'Recipes', 'action' => 'view', $recipe->id],
                                                ['class' => 'btn btn-info btn-sm']
                                            ) ?>
                                            <?= $this->Html->link(
                                                __('Edit'),
                                                ['controller' => 'Recipes', 'action' => 'edit', $recipe->id],
                                                ['class' => 'btn btn-warning btn-sm']
                                            ) ?>
                                            <?= $this->Form->postLink(
                                                __('Delete'),
                                                ['controller' => 'Recipes', 'action' => 'delete', $recipe->id],
                                                [
                                                    'confirm' => __('Are you sure you want to delete # {0}?', $recipe->id),
                                                    'class' => 'btn btn-danger btn-sm'
                                                ]
                                            ) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>