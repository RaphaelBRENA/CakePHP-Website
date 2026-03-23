<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ingredients Model
 *
 * @property \App\Model\Table\RecipesTable&\Cake\ORM\Association\BelongsToMany $Recipes
 *
 * @method \App\Model\Entity\Ingredient newEmptyEntity()
 * @method \App\Model\Entity\Ingredient newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Ingredient> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ingredient get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Ingredient findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Ingredient patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Ingredient> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ingredient|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Ingredient saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Ingredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ingredient>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ingredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ingredient> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ingredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ingredient>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ingredient>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ingredient> deleteManyOrFail(iterable $entities, array $options = [])
 */
class IngredientsTable extends Table
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

        $this->setTable('ingredients');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');


        $this->belongsToMany('Recipes', [
            'through' => 'IngredientsRecipes',
            'foreignKey' => 'ingredient_id',
            'targetForeignKey' => 'recipe_id'
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('unit')
            ->maxLength('unit', 50)
            ->allowEmptyString('unit');

        return $validator;
    }
}
