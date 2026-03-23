<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ustensils Model
 *
 * @property \App\Model\Table\RecipesTable&\Cake\ORM\Association\BelongsToMany $Recipes
 *
 * @method \App\Model\Entity\Ustensil newEmptyEntity()
 * @method \App\Model\Entity\Ustensil newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Ustensil> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ustensil get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Ustensil findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Ustensil patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Ustensil> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ustensil|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Ustensil saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Ustensil>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ustensil>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ustensil>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ustensil> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ustensil>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ustensil>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Ustensil>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Ustensil> deleteManyOrFail(iterable $entities, array $options = [])
 */
class UstensilsTable extends Table
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

        $this->setTable('ustensils');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Recipes', [
            'foreignKey' => 'ustensil_id',
            'targetForeignKey' => 'recipe_id',
            'joinTable' => 'recipes_ustensils',
        ]);

        
    }

    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        return $validator;
    }
}
