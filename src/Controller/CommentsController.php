<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Comments->find()
            ->contain(['Users', 'Recipes']);
        $comments = $this->paginate($query);

        $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, contain: ['Users', 'Recipes']);
        $this->set(compact('comment'));
    }





public function add($recipeId = null)
{
    $authUser = $this->Authentication->getIdentity();
    $comment = $this->Comments->newEmptyEntity();
    if ($this->request->is('post')) {
        
        $comment = $this->Comments->patchEntity($comment, $this->request->getData());
        $apiUrl = "https://www.purgomalum.com/service/containsprofanity?text=" . urlencode($comment['comment']);
        $response = file_get_contents($apiUrl);
        if ($response === "true") {
            $this->Flash->error("Votre commentaire contient un mot interdit.");
            return $this->redirect(['action' => 'add', $recipeId]);
        }
       
        $comment->recipe_id = $recipeId;

      
        if ($this->Comments->save($comment)) {
            $this->Flash->success(__('Le commentaire a été enregistré avec succès.'));
            return $this->redirect(['controller' => 'Recipes', 'action' => 'view', $recipeId]);
        }

        $this->Flash->error(__('Le commentaire n\'a pas pu être enregistré. Veuillez réessayer.'));
    }

    $this->set(compact('comment', 'recipeId','authUser'));
}



    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            $apiUrl = "https://www.purgomalum.com/service/containsprofanity?text=" . urlencode($comment['comment']);
            $response = file_get_contents($apiUrl);
            if ($response === "true") {
                $this->Flash->error("Votre commentaire contient un mot interdit.");
                return $this->redirect(['action' => 'edit', $id]);
            }
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $users = $this->Comments->Users->find('list', limit: 200)->all();
        $this->set(compact('comment', 'users', 'recipes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
