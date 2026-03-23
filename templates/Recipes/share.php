<h1 class="text-center mb-4"><?= h($name) ?></h1>

<div class="d-flex justify-content-center flex-wrap gap-2">
    <a href="https://twitter.com/intent/tweet?url=<?= h($fullUrl . "/recipes/view/" . $id) ?>&text=<?= h(urlencode('Regardez cette recette géniale de ' . $name . ' !')) ?>"
       class="btn btn-primary" target="_blank">Partager sur X</a>

    <a href="https://api.whatsapp.com/send?text=<?= h(urlencode('Regardez cette recette géniale de ' . $name . ' ! ' . $fullUrl . "/recipes/view/" . $id)) ?>"
       class="btn btn-success" target="_blank">Partager sur WhatsApp</a>

    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= h($fullUrl . "/recipes/view/" . $id) ?>"
       class="btn btn-primary" target="_blank">Partager sur Facebook</a>

    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= h($fullUrl . "/recipes/view/" . $id) ?>"
       class="btn btn-info text-white" target="_blank">Partager sur LinkedIn</a>

    <a href="mailto:?subject=<?= rawurlencode('Découvrez cette recette : ' . $name) ?>&body=<?= rawurlencode('Regardez cette recette géniale de ' . $name . ' ! ' . $fullUrl . "/recipes/view/" . $id) ?>"
       class="btn btn-secondary" target="_blank">Partager par e-mail</a>
</div>

<div class="mt-4 text-center">
    <label for="share-link" class="form-label">Lien de partage :</label>
    <input type="text" id="share-link" class="form-control w-50 mx-auto text-center" value="<?= h($fullUrl . "/recipes/view/" . $id) ?>" readonly onclick="this.select()">
</div>
