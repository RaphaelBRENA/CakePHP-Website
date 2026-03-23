<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ustensils Controller
 *
 * @property \App\Model\Table\UstensilsTable $Ustensils
 */

 
class UstensilsController extends AppController
{
   


       
    public function index()
    {
        $this->verifyAccess();
        
        $query = $this->Ustensils->find();
        $ustensils = $this->paginate($query);

        $this->set(compact('ustensils'));
    }

    
    public function view($id = null)
    {
        $ustensil = $this->Ustensils->get($id, contain: ['Recipes']);
        $this->set(compact('ustensil'));
    }

    public function add()
    {
        $this->verifyAccess();

        $ustensil = $this->Ustensils->newEmptyEntity();
        if ($this->request->is('post')) {
           // $file = $this->request->getUploadedFile('image');
            $ustensil = $this->Ustensils->patchEntity($ustensil, $this->request->getData());
           
            if ($this->Ustensils->save($ustensil)) {
                $file = $this->request->getData('image');
                if ($file && $file->getError() === UPLOAD_ERR_OK) {
                    $uploadPath = WWW_ROOT . 'img' . DS . 'uploaded' . DS;
                    $filename = 'ust_' . $ustensil->id . ".jpg";
                    $file->moveTo($uploadPath . $filename);
                    $ustensil->image = 'uploaded/' . $filename;
                    $this->Ustensils->save($ustensil);
                }
    
                $this->Flash->success(__('L\'ingrédient a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ustensil could not be saved. Please, try again.'));
        }
        $recipes = $this->Ustensils->Recipes->find('list', limit: 200)->all();
        $this->set(compact('ustensil', 'recipes'));
    }

   
    public function edit($id = null)
    {
        $this->verifyAccess();
        $ustensil = $this->Ustensils->get($id, contain: ['Recipes']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ustensil = $this->Ustensils->patchEntity($ustensil, $this->request->getData());
            if ($this->Ustensils->save($ustensil)) {
                $this->Flash->success(__('The ustensil has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ustensil could not be saved. Please, try again.'));
        }
        $recipes = $this->Ustensils->Recipes->find('list', limit: 200)->all();
        $this->set(compact('ustensil', 'recipes'));
    }

 
    public function delete($id = null)
    {
      $this->verifyAccess();
        $this->request->allowMethod(['post', 'delete']);
        $ustensil = $this->Ustensils->get($id);
        if ($this->Ustensils->delete($ustensil)) {
            $this->Flash->success(__('The ustensil has been deleted.'));
        } else {
            $this->Flash->error(__('The ustensil could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    
}
