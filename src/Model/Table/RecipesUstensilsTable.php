<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RecipesUstensils Model
 *
 * @property \App\Model\Table\RecipesTable&\Cake\ORM\Association\BelongsTo $Recipes
 * @property \App\Model\Table\UstensilsTable&\Cake\ORM\Association\BelongsTo $Ustensils
 *
 * @method \App\Model\Entity\RecipesUstensil newEmptyEntity()
 * @method \App\Model\Entity\RecipesUstensil newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RecipesUstensil> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RecipesUstensil get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RecipesUstensil findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RecipesUstensil patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RecipesUstensil> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RecipesUstensil|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RecipesUstensil saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RecipesUstensil>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RecipesUstensil>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RecipesUstensil>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RecipesUstensil> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RecipesUstensil>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RecipesUstensil>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RecipesUstensil>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RecipesUstensil> deleteManyOrFail(iterable $entities, array $options = [])
 */
class RecipesUstensilsTable extends Table
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

        $this->setTable('recipes_ustensils');
        $this->setDisplayField(['recipe_id', 'ustensil_id']);
        $this->setPrimaryKey(['recipe_id', 'ustensil_id']);

        $this->belongsTo('Recipes', [
            'foreignKey' => 'recipe_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Ustensils', [
            'foreignKey' => 'ustensil_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['ustensil_id'], 'Ustensils'), ['errorField' => 'ustensil_id']);

        return $rules;
    }
}
