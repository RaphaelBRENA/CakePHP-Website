<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment $comment
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $recipes
 */
?>
<div class="container mt-4">
    <div class="row">
        <aside class="col-md-3">
            <div class="card p-3 mb-3">
                <h4 class="card-title">Actions</h4>
                <?= $this->Html->link(__('List Comments'), ['action' => 'index'], ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </aside>
        <div class="col-md-9">
            <div class="card p-4">
                <h2 class="mb-4">Add Comment</h2>
                <?= $this->Form->create($comment, ['class' => 'needs-validation']) ?>

                <div class="mb-3">
                    <?= $this->Form->control('user_display', [
                        'type' => 'text',
                        'class' => 'form-control',
                        'value' => $authUser ? $authUser->firstname . ' ' . $authUser->lastname : '',
                        'readonly' => true,
                        'label' => 'User'
                    ]) ?>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('title', ['class' => 'form-control', 'label' => 'Title']) ?>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('comment', ['class' => 'form-control', 'label' => 'Comment']) ?>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('date', [
                        'type' => 'text',
                        'class' => 'form-control',
                        'value' => date('Y-m-d H:i:s'),
                        'readonly' => true,
                        'label' => 'Date'
                    ]) ?>
                </div>

                <div class="mb-3">
                    <?= $this->Form->control('rate', [
                        'class' => 'form-control',
                        'label' => 'Rate',
                        'options' => [1 => 'Pas aimé', 2 => 'Pas trop aimé', 3 => 'Moyennement aimé', 4 => 'Presque parfait', 5 => 'Parfait']
                    ]) ?>
                </div>

                <?= $this->Form->control('user_id', [
                    'type' => 'hidden',
                    'value' => $authUser ? $authUser->id : ''
                ]) ?>

                <?= $this->Form->control('recipe_id', [
                    'type' => 'hidden',
                    'value' => $recipeId 
                ]) ?>

                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
