<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\I18n\I18n;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Recipes Model
 *
 * @property \App\Model\Table\CommentsTable&\Cake\ORM\Association\HasMany $Comments
 * @property \App\Model\Table\StepsTable&\Cake\ORM\Association\HasMany $Steps
 * @property \App\Model\Table\IngredientsTable&\Cake\ORM\Association\BelongsToMany $Ingredients
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 * @property \App\Model\Table\UstensilsTable&\Cake\ORM\Association\BelongsToMany $Ustensils
 *
 * @method \App\Model\Entity\Recipe newEmptyEntity()
 * @method \App\Model\Entity\Recipe newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Recipe> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Recipe get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Recipe findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Recipe patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Recipe> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Recipe|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Recipe saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Recipe>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Recipe>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Recipe>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Recipe> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Recipe>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Recipe>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Recipe>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Recipe> deleteManyOrFail(iterable $entities, array $options = [])
 */
class RecipesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('recipes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Comments', [
            'foreignKey' => 'recipe_id',
        ]);
        $this->hasMany('Steps', [
            'foreignKey' => 'recipe_id',
        ]);
        $this->belongsToMany('Ingredients', [
            'foreignKey' => 'recipe_id',
            'targetForeignKey' => 'ingredient_id',
            'joinTable' => 'ingredients_recipes',
        ]);
       $this->belongsToMany('Tags', [
            'foreignKey' => 'recipe_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'recipes_tags',
        ]);
        $this->belongsToMany('Ustensils', [
            'foreignKey' => 'recipe_id',
            'targetForeignKey' => 'ustensil_id',
            'joinTable' => 'recipes_ustensils',
        ]);
        $this->addBehavior('Translate', ['fields' => ['name', 'description']]);
        $this->addBehavior('Translate', [
            'strategyClass' => \Cake\ORM\Behavior\Translate\EavStrategy::class,
            'fields' => ['name', 'description'],
        ]);
        $this->addBehavior('Translate', [
            'defaultLocale' => 'en_US',
        ]);
    }

//     public function getRecipesData(): array
// {
   
//     $recipes = $this->Recipes->find()->all();

    
//     $data = [];
//     foreach ($recipes as $recipe) {
//         $data[] = [
//             'name' => $recipe->name,
//             'description' => $recipe->description,
//             'total_time' => $recipe->preparation + $recipe->resting + $recipe->cooking,
//             'servings' => $recipe->servings,
//             'difficulty_level' => $recipe->difficulty_level,
//             'price' => $recipe->price,
//             'ratings' => $recipe->ratings
//         ];
//     }

//     return $data;
// }


    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('preparation')
            ->allowEmptyString('preparation');

        $validator
            ->integer('resting')
            ->allowEmptyString('resting');

        $validator
            ->integer('cooking')
            ->allowEmptyString('cooking');

        $validator
            ->integer('servings')
            ->allowEmptyString('servings');

        $validator
            ->integer('difficulty_level')
            ->allowEmptyString('difficulty_level');

        $validator
            ->numeric('price')
            ->allowEmptyString('price');

        $validator
            ->integer('ratings')
            ->allowEmptyString('ratings');

        return $validator;
    }
}
