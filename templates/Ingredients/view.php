<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ingredient $ingredient
 */
?>
<div class="container mt-4">
    <div class="row">
        <aside class="col-md-3">
            <div class="card p-3">
                <h4 class="card-title"><?= __('Actions') ?></h4>
                <div class="list-group">
                    <?= $this->Html->link(__('Edit Ingredient'), ['action' => 'edit', $ingredient->id], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= $this->Form->postLink(__('Delete Ingredient'), ['action' => 'delete', $ingredient->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id),
                        'class' => 'list-group-item list-group-item-action text-danger'
                    ]) ?>
                    <?= $this->Html->link(__('List Ingredients'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= $this->Html->link(__('New Ingredient'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </aside>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?= h($ingredient->name) ?></h3>
                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($ingredient->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Unit') ?></th>
                            <td><?= h($ingredient->unit) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($ingredient->id) ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title"><?= __('Related Recipes') ?></h4>
                    <?php if (!empty($ingredient->recipes)) : ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
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
                                    <?php foreach ($ingredient->recipes as $recipe) : ?>
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
                                            <div class="btn-group">
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
