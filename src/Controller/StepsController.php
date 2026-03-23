<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Steps Controller
 *
 * @property \App\Model\Table\StepsTable $Steps
 */
class StepsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Steps->find()
            ->contain(['Recipes']);
        $steps = $this->paginate($query);

        $this->set(compact('steps'));
    }

    /**
     * View method
     *
     * @param string|null $id Step id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $step = $this->Steps->get($id, contain: ['Recipes']);
        $this->set(compact('step'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $step = $this->Steps->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $step = $this->Steps->patchEntity($step, $this->request->getData());
    //         if ($this->Steps->save($step)) {
    //             $this->Flash->success(__('The step has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The step could not be saved. Please, try again.'));
    //     }
    //     $recipes = $this->Steps->Recipes->find('list', limit: 200)->all();
    //     $this->set(compact('step', 'recipes'));
    // }

    public function add($recipeId = null)
{
    $step = $this->Steps->newEmptyEntity();


    if ($recipeId) {
        $step->recipe_id = $recipeId;
    }

    if ($this->request->is('post')) {
        $step = $this->Steps->patchEntity($step, $this->request->getData());
        if ($this->Steps->save($step)) {
            $this->Flash->success(__('L\'étape a été enregistrée avec succès.'));


            return $this->redirect(['action' => 'add', $recipeId]);
        }
        $this->Flash->error(__('L\'étape n\'a pas pu être enregistrée. Veuillez réessayer.'));
    }


    $recipes = $recipeId ? [] : $this->Steps->Recipes->find('list', limit: 200)->all();

    $this->set(compact('step', 'recipes', 'recipeId'));
}


    /**
     * Edit method
     *
     * @param string|null $id Step id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $step = $this->Steps->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $step = $this->Steps->patchEntity($step, $this->request->getData());
            if ($this->Steps->save($step)) {
                $this->Flash->success(__('The step has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The step could not be saved. Please, try again.'));
        }
        $recipes = $this->Steps->Recipes->find('list', limit: 200)->all();
        $this->set(compact('step', 'recipes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Step id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $step = $this->Steps->get($id);
        if ($this->Steps->delete($step)) {
            $this->Flash->success(__('The step has been deleted.'));
        } else {
            $this->Flash->error(__('The step could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
