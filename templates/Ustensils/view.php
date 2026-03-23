<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ustensil $ustensil
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
                    <?= $this->Html->link(__('Edit Ustensil'), ['action' => 'edit', $ustensil->id], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= $this->Form->postLink(__('Delete Ustensil'), ['action' => 'delete', $ustensil->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $ustensil->id),
                        'class' => 'list-group-item list-group-item-action text-danger'
                    ]) ?>
                    <?= $this->Html->link(__('List Ustensils'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= $this->Html->link(__('New Ustensil'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0"><?= h($ustensil->name) ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light"><?= __('Name') ?></th>
                            <td><?= h($ustensil->name) ?></td>
                        </tr>
                        <tr>
                            <th class="bg-light"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($ustensil->id) ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Related Recipes Section -->
            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0"><?= __('Related Recipes') ?></h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($ustensil->recipes)) : ?>
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
                                        <th class="text-center"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ustensil->recipes as $recipe) : ?>
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
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <?= $this->Html->link(__('View'), ['controller' => 'Recipes', 'action' => 'view', $recipe->id], ['class' => 'btn btn-info btn-sm']) ?>
                                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Recipes', 'action' => 'edit', $recipe->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Recipes', 'action' => 'delete', $recipe->id], [
                                                        'confirm' => __('Are you sure you want to delete # {0}?', $recipe->id),
                                                        'class' => 'btn btn-danger btn-sm'
                                                    ]) ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted"><?= __('No related recipes found.') ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>