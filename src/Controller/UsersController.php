<?php
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\ORM\TableRegistry;

    class UsersController extends AppController
    {



    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login','subscribe']);
    }

    public function index()
    {
        

    }

    public function login()
    {
       // $this->viewBuilder()->setLayout('mini');

        $result = $this->Authentication->getResult();

        if ($result && $result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/recipes/index';
            return $this->redirect($target);
        }
        if ($this->request->is('post')) {
            $this->Flash->error('Invalid username or password');
        }
    }

    public function subscribe()
    {
        $user = $this->Users->newEmptyEntity();
        if (!empty($this->request->getData())){
            $this->Users->patchEntity($user, $this->getRequest()->getData());
            $jsEnabled = $this->request->getData('js_enabled');
            if ($jsEnabled === '1') {
                $recaptchaResponse = $this->request->getData('g-recaptcha-response');
                $recaptchaVerification = $this->verifyReCaptcha($recaptchaResponse);
                if (!$recaptchaVerification) {
                    $this->Flash->error('Validation reCaptcha échouée.');
                    return $this->redirect($this->referer());
                }
            }
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Utilisateur créé'));
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            $this->Flash->error(__('Une erreur est survenue'));
        }
        $this->set(compact('user'));
    }




        public function logout()
    {
        $this->request->getSession()->delete('Cart');
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
/*
    public function admin(){
        $recipesTable = TableRegistry::getTableLocator()->get('Recipes');
        $recipe = $recipesTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $recipesTable->patchEntity($recipe, $this->request->getData());


            if ($recipesTable->save($recipe)) {
                $this->Flash->success(__('La recette a été ajoutée avec succès.'));
                return $this->redirect(['controller' => 'Recipes', 'action' => 'index']);
            }

            $this->Flash->error(__('Erreur lors de l\'ajout de la recette.'));
        }

        $this->set(compact('recipe'));
    }*/



    public function admin()
    {
        if ($this->Authentication->user('role') !== 0) {
            $this->Flash->error(__('Accès refusé. Vous devez être administrateur.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is('post')) {
            $this->Flash->error('Pas autorisé à y aller, vous etes pas admin');
        }

        return $this->redirect(['controller' => 'Recipes', 'action' => 'add']);
    }
    private function verifyReCaptcha($response)
    {
        $secretKey = \Cake\Core\Configure::read('ReCaptcha.secretKey');
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = ['secret' => $secretKey, 'response' => $response];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);
        return $resultJson->success;
    }
}
