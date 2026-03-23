<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IngredientsRecipes Model
 *
 * @property \App\Model\Table\RecipesTable&\Cake\ORM\Association\BelongsTo $Recipes
 * @property \App\Model\Table\IngredientsTable&\Cake\ORM\Association\BelongsTo $Ingredients
 *
 * @method \App\Model\Entity\IngredientsRecipe newEmptyEntity()
 * @method \App\Model\Entity\IngredientsRecipe newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\IngredientsRecipe> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IngredientsRecipe get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\IngredientsRecipe findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\IngredientsRecipe patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\IngredientsRecipe> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\IngredientsRecipe|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\IngredientsRecipe saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\IngredientsRecipe>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\IngredientsRecipe>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\IngredientsRecipe>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\IngredientsRecipe> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\IngredientsRecipe>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\IngredientsRecipe>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\IngredientsRecipe>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\IngredientsRecipe> deleteManyOrFail(iterable $entities, array $options = [])
 */
class IngredientsRecipesTable extends Table
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

        $this->setTable('ingredients_recipes');
        $this->setDisplayField(['recipe_id', 'ingredient_id']);
        $this->setPrimaryKey(['recipe_id', 'ingredient_id']);

        $this->belongsTo('Recipes', [
            'foreignKey' => 'recipe_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Ingredients', [
            'foreignKey' => 'ingredient_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->numeric('quantity')
            ->allowEmptyString('quantity');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['recipe_id'], 'Recipes'), ['errorField' => 'recipe_id']);
        $rules->add($rules->existsIn(['ingredient_id'], 'Ingredients'), ['errorField' => 'ingredient_id']);

        return $rules;
    }
}
