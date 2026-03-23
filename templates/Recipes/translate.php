
<div class="recipes form">
    <?= $this->Form->create($recipe) ?>
    <fieldset>
        <legend><?= __('Traduire la recette') ?></legend>

        <div class="original-content">
            <h3><?= __('Contenu original') ?></h3>
            <div class="form-group">
                <label><?= __('Nom original') ?></label>
                <p class="form-control-static"><?= h($recipe->name) ?></p>
            </div>
            <div class="form-group">
                <label><?= __('Description originale') ?></label>
                <p class="form-control-static"><?= h($recipe->description) ?></p>
            </div>
        </div>

        <hr>

        <div class="translation-form">
            <h3><?= __('Traduction') ?></h3>
            <?php
            echo $this->Form->control('name', [
                'label' => __('Nom traduit'),
                'class' => 'form-control',
                'placeholder' => __('Saisissez la traduction du nom')
            ]);

            echo $this->Form->control('description', [
                'label' => __('Description traduite'),
                'type' => 'textarea',
                'class' => 'form-control',
                'placeholder' => __('Saisissez la traduction de la description'),
                'rows' => 5
            ]);
            ?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Enregistrer la traduction'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
