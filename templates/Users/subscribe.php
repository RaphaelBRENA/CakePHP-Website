<section class="wrapper d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="img__container mb-4">
                    <img src="https://images.unsplash.com/photo-1546793665-c74683f339c1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80"
                        alt="salad" class="img-fluid rounded shadow">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h2 class="subtitle text-center text-primary">S'inscrire</h2>

                    <?= $this->Form->create() ?>
                    <fieldset>
                        <legend class="text-center"><?= __('Veuillez saisir vos informations') ?></legend>
                        <div class="mb-3">
                            <?= $this->Form->control('firstname', ['class' => 'form-control', 'label' => 'Prénom']) ?>
                        </div>
                        <div class="mb-3">
                            <?= $this->Form->control('lastname', ['class' => 'form-control', 'label' => 'Nom']) ?>
                        </div>
                        <div class="mb-3">
                            <?= $this->Form->control('email', ['class' => 'form-control', 'label' => 'Email']) ?>
                        </div>
                        <div class="mb-3">
                            <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Mot de passe']) ?>
                        </div>
                    </fieldset>
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="<?= \Cake\Core\Configure::read('ReCaptcha.siteKey') ?>"></div>
                        <?= $this->Form->hidden('js_enabled', ['value' => '0', 'id' => 'js_enabled']) ?>
                    </div>
                    <div class="d-grid gap-2">
                        <?= $this->Form->button(__('S\'inscrire'), ['class' => 'btn btn-primary']) ?>
                    </div>

                    <div class="text-center mt-3">
                        <?= $this->Html->link(
                            'Se connecter',
                            ['controller' => 'Users', 'action' => 'login'],
                            ['class' => 'btn btn-outline-secondary']
                        ); ?>
                    </div>
                    <?= $this->Form->end() ?>

                    <p class="text-muted text-center mt-3 small">Nous ne vous enverrons pas de spam. Désinscription à tout moment.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->Html->script('captcha.js') ?>
<?= $this->Html->script('https://www.google.com/recaptcha/api.js', ['async' => true, 'defer' => true]) ?>