<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 * @var \Cake\Collection\CollectionInterface|string[] $recipes
 */
?>
<div class="row">
    <aside class="col-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Actions</h4>
            </div>
            <div class="card-body">
                <?= $this->Html->link(__('List Tags'), ['action' => 'index'], ['class' => 'btn btn-outline-primary btn-block']) ?>
            </div>
        </div>
    </aside>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Add Tag</h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create($tag, ['class' => 'needs-validation', 'novalidate' => true]) ?>
                <fieldset>
                    <?php
                        echo $this->Form->control('name', ['class' => 'form-control mb-3']);
                        echo $this->Form->control('recipes._ids', ['options' => $recipes, 'class' => 'form-control']);
                    ?>
                </fieldset>
                <div class="mt-3">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

