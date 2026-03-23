<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;

/**
 * Ingredients Controller
 *
 * @property \App\Model\Table\IngredientsTable $Ingredients
 */
class IngredientsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication');
    }



    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->verifyAccess();
        $query = $this->Ingredients->find();
        $ingredients = $this->paginate($query);

        $this->set(compact('ingredients'));
    }

    /**
     * View method
     *
     * @param string|null $id Ingredient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->verifyAccess();
        $ingredient = $this->Ingredients->get($id, contain: ['Recipes']);
        $this->set(compact('ingredient'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
{
    $this->verifyAccess();
    $ingredient = $this->Ingredients->newEmptyEntity();
    if ($this->request->is('post')) {
        $ingredient = $this->Ingredients->patchEntity($ingredient, $this->request->getData());

        if ($this->Ingredients->save($ingredient)) {
            $file = $this->request->getData('image');
            if ($file && $file->getError() === UPLOAD_ERR_OK) {
                $uploadPath = WWW_ROOT . 'img' . DS . 'uploaded' . DS;
                $filename = 'ingr_' . $ingredient->id . ".jpg";
                $file->moveTo($uploadPath . $filename);
                $ingredient->image = 'uploaded/' . $filename;
                $this->Ingredients->save($ingredient);
            }

            $this->Flash->success(__('L\'ingrédient a été sauvegardé.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->Flash->error(__('L\'ingrédient n\'a pas pu être sauvegardé. Veuillez réessayer.'));
    }

    $recipes = $this->Ingredients->Recipes->find('list', limit: 200)->all();
    $this->set(compact('ingredient', 'recipes'));
}

    /**
     * Edit method
     *
     * @param string|null $id Ingredient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $this->verifyAccess();
        $ingredient = $this->Ingredients->get($id, contain: ['Recipes']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ingredient = $this->Ingredients->patchEntity($ingredient, $this->request->getData());
            if ($this->Ingredients->save($ingredient)) {
                $this->Flash->success(__('The ingredient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ingredient could not be saved. Please, try again.'));
        }
        $recipes = $this->Ingredients->Recipes->find('list', limit: 200)->all();
        $this->set(compact('ingredient', 'recipes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ingredient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->verifyAccess();
        $this->request->allowMethod(['post', 'delete']);
        $ingredient = $this->Ingredients->get($id);
        if ($this->Ingredients->delete($ingredient)) {
            $this->Flash->success(__('The ingredient has been deleted.'));
        } else {
            $this->Flash->error(__('The ingredient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
