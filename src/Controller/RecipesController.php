<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Http\Exception\BadRequestException;

    use Cake\I18n\I18n;

    class RecipesController extends AppController
    {
        public function beforeFilter(\Cake\Event\EventInterface $event)
        {
            parent::beforeFilter($event);

            $this->Authentication->allowUnauthenticated(['index','view', 'share', 'api']);
        }
        public function initialize(): void
        {
            parent::initialize();

            $this->loadComponent('Authentication');

            $lang = $this->request->getQuery('lang');
            if ($lang) {
                $this->request->getSession()->write('User.language', $lang);
            }
            $userLanguage = $this->request->getSession()->read('User.language', 'fr');
            if($userLanguage != 'fr') {
                I18n::setLocale($userLanguage);
            }

        }


        public function api()
        {

            $recipes = $this->Recipes->find()->contain(['Ingredients'])->all();

            $data = [];
            foreach ($recipes as $recipe) {
                $data[] = [
                    'name' => $recipe->name,
                    'description' => $recipe->description,
                    'total_time' => $recipe->preparation + $recipe->resting + $recipe->cooking,
                    'servings' => $recipe->servings,
                    'difficulty_level' => $recipe->difficulty_level,
                    'price' => $recipe->price,
                    'ratings' => $recipe->ratings,
                    'ingredients' => !empty($recipe->ingredients) ?
                array_map(fn($ingredient) => $ingredient->name, $recipe->ingredients) : []


                ];
            }


            // $this->set(compact('data'));
            // $this->viewBuilder()->setOption('serialize', ['data']);

            $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);


            $this->response = $this->response->withType('application/json')
                                            // ->withHeader('Content-Disposition', 'attachment; filename="recipes.json"')
                                             ->withStringBody($jsonData);

            return $this->response;
        }



    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
        public function index()
        {
            $currentLanguage = I18n::getLocale();
            $this->set(compact('currentLanguage'));

          $this->paginate = [
            'limit' => 3,
            'order' => ['Recipes.name' => 'asc']
            ];

        $recipes = $this->paginate($this->Recipes);
            $query = $this->Recipes->find();
            $search = $this->request->getQuery('search');
            if ($search === '') {
                $queryParams = $this->request->getQueryParams();
                unset($queryParams['search']);
                return $this->redirect(['?' => $queryParams]);
            }
            $tagId = $this->request->getQuery('tag');
            if($tagId === ''){
                $queryParams = $this->request->getQueryParams();
                unset($queryParams['tag']);
                return $this->redirect(['?' => $queryParams]);
            }
            $tags = $this->Recipes->Tags->find('list', ['keyField' => 'id', 'valueField' => 'name']);
            if ($search !== null) {
                $query->where(['LOWER(Recipes.name) LIKE' => '%' . strtolower($search) . '%']);
            }

            if ($tagId !== null) {
                $query->matching('Tags', function ($q) use ($tagId) {
                    return $q->where(['Tags.id' => $tagId]);
                });
            }

            $recipes = $this->paginate($query);
            $this->set(compact('recipes', 'search', 'tags', 'tagId'));
            // $this->set(compact('recipes', 'search', 'tags', 'tagId','recipesData'));
        }



        /**
     * View method
     *
     * @param string|null $id Recipe id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $recipe = $this->Recipes->get($id, contain: ['Ingredients', 'Tags', 'Ustensils', 'Comments', 'Steps']);

        $this->set(compact('recipe'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */




 public function add()
{

    $this->verifyAccess();
    $recipe = $this->Recipes->newEmptyEntity();
    if ($this->request->is('post')) {
        $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());
        if ($this->Recipes->save($recipe)) {
            $file = $this->request->getUploadedFile('image');
            if ($file && $file->getError() === UPLOAD_ERR_OK) {
                $uploadPath = WWW_ROOT . 'img' . DS . 'uploaded' . DS;
                $filename = $recipe->id . ".jpg";
                $file->moveTo($uploadPath . $filename);
                $this->applyWatermark($uploadPath . $filename, WWW_ROOT . 'img' . DS . 'filigrane2.png');
                $recipe->image = 'uploaded/' . $filename;
                $this->Recipes->save($recipe);
            }
            $this->Flash->success(__('La recette a été enregistrée. Veuillez maintenant ajouter les étapes.'));
            return $this->redirect(['action' => 'ingredients', $recipe->id]);
        }

        $this->Flash->error(__('La recette n\'a pas pu être enregistrée. Veuillez réessayer.'));
    }

    $ingredients = $this->Recipes->Ingredients->find('list', limit: 200)->all();
    $ustensils = $this->Recipes->Ustensils->find('list', limit: 200)->all();
    $tags = $this->Recipes->Tags->find('list', limit: 200)->all();

    $this->set(compact('recipe', 'ingredients', 'ustensils', 'tags'));
}



    /**
     * Edit method
     *
     * @param string|null $id Recipe id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {


        $this->verifyAccess();
        $recipe = $this->Recipes->get($id, contain: ['Ingredients', 'Tags', 'Ustensils']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());
            if ($this->Recipes->save($recipe)) {
                $this->Flash->success(__('The recipe has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The recipe could not be saved. Please, try again.'));
        }
        $ingredients = $this->Recipes->Ingredients->find('list', limit: 200)->all();
        $tags = $this->Recipes->Tags->find('list', limit: 200)->all();
        $ustensils = $this->Recipes->Ustensils->find('list', limit: 200)->all();
        $this->set(compact('recipe', 'ingredients', 'tags', 'ustensils'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Recipe id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->verifyAccess();
        $this->request->allowMethod(['post', 'delete']);
        $recipe = $this->Recipes->get($id);
        if ($this->Recipes->delete($recipe)) {
            $this->Flash->success(__('The recipe has been deleted.'));
        } else {
            $this->Flash->error(__('The recipe could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }



    private function applyWatermark($imagePath, $watermarkPath) {
        $image = imagecreatefromstring(file_get_contents($imagePath));
        $watermark = imagecreatefrompng($watermarkPath);
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        $watermarkWidth = imagesx($watermark);
        $watermarkHeight = imagesy($watermark);
        $ratio = 0.2;
        $newWatermarkWidth = $imageWidth * $ratio;
        $newWatermarkHeight = ($newWatermarkWidth / $watermarkWidth) * $watermarkHeight;
        if ($newWatermarkHeight > $imageHeight) {
            $newWatermarkHeight = $imageHeight;
            $newWatermarkWidth = ($newWatermarkHeight / $watermarkHeight) * $watermarkWidth;
        }
        $resizedWatermark = imagecreatetruecolor((int)$newWatermarkWidth, (int)$newWatermarkHeight);
        imagealphablending($resizedWatermark, false);
        imagesavealpha($resizedWatermark, true);
        imagecopyresampled($resizedWatermark, $watermark, 0, 0, 0, 0, (int)$newWatermarkWidth, (int)$newWatermarkHeight, $watermarkWidth, $watermarkHeight);
        $destX = $imageWidth - $newWatermarkWidth;
        $destY = $imageHeight - $newWatermarkHeight;
        imagecopy($image, $resizedWatermark, (int)$destX, (int)$destY, 0, 0, (int)$newWatermarkWidth, (int)$newWatermarkHeight);
        imagepng($image, $imagePath);
        imagedestroy($image);
        imagedestroy($watermark);
        imagedestroy($resizedWatermark);
    }
    public function share($id){
        throw new BadRequestException('Requête invalide');
        $baseUrl = $this->request->getAttribute('base');
        $fullUrl = $this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost();
        if ($this->request->getUri()->getPort()) {
            $fullUrl .= ':' . $this->request->getUri()->getPort();
        }
        $fullUrl .= $baseUrl;
        $recipe = $this->Recipes->find()
            ->select(['name'])
            ->where(['id' => $id])
            ->first();
        if ($recipe) {
            $name = $recipe->name;
            $this->set(compact('id', 'name', 'fullUrl'));
        }
    }

        public function ingredients($recipeId)
        {
            $recipe = $this->Recipes->get($recipeId, [
                'contain' => ['Ingredients']
            ]);
            $ingredients = $this->Recipes->Ingredients->find('list')->toArray();
            $existingIngredients = [];
            foreach ($recipe->ingredients as $ingredient) {
                $existingIngredients[$ingredient->id] = $ingredient->_joinData->quantity;
            }
            if ($this->request->is(['post', 'put'])) {
                $data = $this->request->getData();
                $ingredientsData = [];
                foreach ($data['ingredients'] as $ingredientId => $quantity) {
                    if (!empty($quantity)) {
                        $ingredientsData[] = [
                            'id' => $ingredientId,
                            '_joinData' => [
                                'quantity' => $quantity
                            ]
                        ];
                    }
                }
                $recipe = $this->Recipes->patchEntity($recipe, ['ingredients' => $ingredientsData], [
                    'associated' => ['Ingredients._joinData']
                ]);

                if ($this->Recipes->save($recipe)) {
                    return $this->redirect(['controller' => 'Steps', 'action' => 'add', $recipe->id]);
                } else {
                    $this->Flash->error(__('Impossible d\'ajouter les ingrédients. Veuillez réessayer.'));
                }
            }
            $this->set(compact('recipe', 'existingIngredients'));
        }


        public function translate($id)
        {
            $recipe = $this->Recipes->get($id);
            $this->set(compact('recipe'));
            I18n::setLocale('en');
            if ($this->request->is(['patch', 'post', 'put'])) {
                $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());
                if ($this->Recipes->save($recipe)) {
                    $this->Flash->success(__('La traduction a été enregistrée.'));
                    return $this->redirect(['action' => 'view', $id]);
                }
                $this->Flash->error(__('La traduction n\'a pas pu être enregistrée. Veuillez réessayer.'));
            }
            $this->set(compact('recipe'));
        }



    }
