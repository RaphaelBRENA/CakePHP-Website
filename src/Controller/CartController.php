<?php
// src/Controller/CartController.php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Http\Exception\NotFoundException;

class CartController extends AppController
{
    //public \App\Model\Table\RecipesTable $Recipes;
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['index','add', 'remove', 'clear', 'update']);
    }

    public function initialize(): void
    {
        parent::initialize();
        //$this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        //$this->loadComponent('Session');
        $this->loadComponent('Authentication');
    }

    public function update($recipeId)
    {
        $cart = $this->request->getSession()->read('Cart') ?? [];
        $newQuantity = $this->request->getData('quantity');
        if ($newQuantity < 1) {
            unset($cart[$recipeId]);
            $this->Flash->success(__('Recette supprimée du panier.'));
        } else {
            $cart[$recipeId]['quantity'] = $newQuantity;
            $this->Flash->success(__('Nombre de portions modifiées'));
        }
        $this->request->getSession()->write('Cart', $cart);
        return $this->redirect($this->referer());
    }

    public function add($recipeId)
    {
        //$recipe = $this->Recipes->findById($recipeId)->first();
        $recipesTable = $this->fetchTable('Recipes');
        $recipe = $recipesTable->findById($recipeId)->first();

        if (!$recipe) {
            throw new NotFoundException(__('Recette introuvable'));
        }
        $cart = $this->request->getSession()->read('Cart') ?? [];
        if (isset($cart[$recipeId])) {
            $cart[$recipeId]['quantity'] += $recipe->servings;
        } else {
            $cart[$recipeId] = [
            'id' => $recipe->id,
            'name' => $recipe->name,
            'quantity' => $recipe->servings,
            ];
        }
        $this->request->getSession()->write('Cart', $cart);
        $this->Flash->success(__('Recette ajouté au panier.'));
        return $this->redirect($this->referer());
    }

    public function index()
    {
        $cart = $this->request->getSession()->read('Cart') ?? [];
        $this->set(compact('cart'));
    }

       public function remove($productId)
    {
        $cart = $this->request->getSession()->read('Cart') ?? [];

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->request->getSession()->write('Cart', $cart);
            $this->Flash->success(__('Recette supprimé du panier.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function clear()
    {
        $this->request->getSession()->delete('Cart');
        $this->Flash->success(__('Le panier a été vidé.'));
        return $this->redirect(['action' => 'index']);
    }
}
