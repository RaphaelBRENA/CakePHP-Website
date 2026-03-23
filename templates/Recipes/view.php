<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Recipe $recipe
 */
?>
<div class="container mt-4">


    <!--  tags  -->
    <div class="mb-4">
        <h4 class="mb-3">Tags associés :</h4>
        <?php if (!empty($recipe->tags)) : ?>
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($recipe->tags as $tag) : ?>
                    <span class="badge bg-secondary"><?= h($tag->name) ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>


    <!-- Infos -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><?= h($recipe->name) ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Portions : </strong><?= h($recipe->servings) ?></li>
                        <li class="list-group-item"><strong>Temps de préparation : </strong><?= h($recipe->preparation) ?> min</li>
                        <li class="list-group-item"><strong>Temps de repos : </strong><?= h($recipe->resting) ?> min</li>
                        <li class="list-group-item"><strong>Temps de cuisson : </strong><?= h($recipe->cooking) ?> min</li>
                        <li class="list-group-item"><strong>Niveau de difficulté : </strong><?= h($recipe->difficulty_level) ?></li>
                        <li class="list-group-item"><strong>Prix : </strong><?= h($recipe->price) ?> €</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <div class="alert alert-info">
                        <strong>Description :</strong>
                        <p><?= $this->Text->autoParagraph(h($recipe->description)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Ingredients -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Ingrédients</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($recipe->ingredients)) : ?>
                <ul class="list-group">
                    <?php foreach ($recipe->ingredients as $ingredient) : ?>
                        <li class="list-group-item d-flex align-items-center">

                            <img src="<?= $this->Url->build('/img/uploaded/ingr_' . $ingredient->id . '.jpg') ?>" alt="<?= h($ingredient->name) ?>" width="50" height="50" class="me-3">

                            <?= h($ingredient->name) ?> <?= ($ingredient->_joinData->quantity) ?> <?= h($ingredient->unit) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Aucun ingrédient ajouté.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Ustensils -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Ustensiles</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($recipe->ustensils)) : ?>
                <ul class="list-group">
                    <?php foreach ($recipe->ustensils as $ustensil) : ?>
                        <li class="list-group-item d-flex align-items-center">

                            <img src="<?= $this->Url->build('/img/uploaded/ust_' . $ustensil->id . '.jpg') ?>" alt="<?= h($ustensil->name) ?>" width="50" height="50" class="me-3">

                            <?= h($ustensil->name) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>Aucun ustensile ajouté.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ste^ps -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Étapes de la recette</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($recipe->steps)) : ?>
                <ol class="list-group list-group-numbered">
                    <?php foreach ($recipe->steps as $step) : ?>
                        <li class="list-group-item">
                            <strong>Étape <?= h($step->step_number) ?>:</strong> <?= h($step->description) ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            <?php else : ?>
                <p>Aucune étape enregistrée.</p>
            <?php endif; ?>
        </div>
    </div>


    <!-- comments -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Commentaires</h4>
        </div>
        <div class="card-body">
            <?= $this->Html->link(
                'Ajouter un commentaire',
                ['controller' => 'Comments', 'action' => 'add', $recipe->id],
                ['class' => 'btn btn-success']
            ) ?>

            <?php if (!empty($recipe->comments)) : ?>
                <ol class="list-group list-group-numbered">
                    <?php foreach ($recipe->comments as $comment) : ?>
                        <li class="list-group-item">
                            <strong><?= $authUser ? $authUser->firstname . ' ' . $authUser->lastname : '' ?> </strong>: <?= "Titre:", h($comment->title)," Commentaire: ", h($comment->comment) ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            <?php else : ?>
                <p>Aucun commentaire enregistré.</p>
            <?php endif; ?>
        </div>
    </div>





    <!-- Actions -->
    <div class="mt-4 d-flex gap-2">
        <?= $this->Html->link(__('Modifier la recette'), ['action' => 'edit', $recipe->id], ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->postLink(__('Supprimer la recette'), ['action' => 'delete', $recipe->id], [
            'confirm' => __('Êtes-vous sûr de vouloir supprimer cette recette ?'),
            'class' => 'btn btn-danger'
        ]) ?>
        <?= $this->Html->link(__('Retour à la liste'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
</div>
