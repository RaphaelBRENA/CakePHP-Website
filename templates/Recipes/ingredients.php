<div class="recipes form">
    <?= $this->Form->create($recipe) ?>
    <fieldset>
        <legend><?= __('Ajouter des ingrédients à la recette : ') ?><?= h($recipe->name) ?></legend>
        <table>
            <thead>
                <tr>
                    <th><?= __('Ingrédient') ?></th>
                    <th><?= __('Quantité') ?></th>
                    <th><?= __('Unité') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recipe->ingredients as $ingredient): ?>
                    <?php $id = $ingredient->id ?>
                    <tr>
                        <td><?= h($ingredient->name) ?></td>
                        <td>
                            <?= $this->Form->control("ingredients.{$id}", [
                                'type' => 'number',
                                'label' => false,
                                'value' => 0,
                                'step' => '0.01',
                                'min' => '0'
                            ]) ?>
                        </td>
                        <td>
                            <?= h($ingredient->unit ?? 'Unité inconnue') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
    <?= $this->Form->button(__('Enregistrer les ingrédients')) ?>
    <?= $this->Form->end() ?>
</div>