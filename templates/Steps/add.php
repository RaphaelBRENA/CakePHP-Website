<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Step $step
 * @var \Cake\Collection\CollectionInterface|string[] $recipes
 */
?>
<div class="row">
    <aside class="col-md-4">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Liste des étapes'), ['action' => 'index'], ['class' => 'side-nav-item btn btn-primary']) ?>
        </div>
    </aside>

    <div class="col-md-8">
        <div class="steps form content">
            <?= $this->Form->create($step) ?>
            <fieldset>
                <legend><?= __('Ajouter une étape') ?></legend>
                <?php
                if (isset($recipeId)) {
                    echo $this->Form->control('recipe_id', [
                        'type' => 'hidden',
                        'value' => $recipeId
                    ]);
                    echo "<p><strong>Recette associée : </strong>" . h($recipeId) . "</p>";
                } else {
                    echo $this->Form->control('recipe_id', [
                        'options' => $recipes,
                        'empty' => true,
                        'class' => 'form-control'
                    ]);
                }

                echo $this->Form->control('step_number', ['class' => 'form-control']);
                echo $this->Form->control('description', ['class' => 'form-control']);
                ?>
            </fieldset>
            <div class="form-group">
                <?= $this->Form->button(__('Ajouter l\'étape'), ['class' => 'btn btn-success']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
        <div class="form-group">
            <?= $this->Html->link(__('Terminer'), ['controller' => 'Recipes', 'action' => 'view', $recipeId], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
</div>