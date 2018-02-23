<?php
namespace Trois\Blog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Inflector;
use Cake\Core\Configure;

/**
* Tags Model
*
* @property \Trois\Blog\Model\Table\PostsTable|\Cake\ORM\Association\BelongsToMany $Posts
*
* @method \Trois\Blog\Model\Entity\Tag get($primaryKey, $options = [])
* @method \Trois\Blog\Model\Entity\Tag newEntity($data = null, array $options = [])
* @method \Trois\Blog\Model\Entity\Tag[] newEntities(array $data, array $options = [])
* @method \Trois\Blog\Model\Entity\Tag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
* @method \Trois\Blog\Model\Entity\Tag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
* @method \Trois\Blog\Model\Entity\Tag[] patchEntities($entities, array $data, array $options = [])
* @method \Trois\Blog\Model\Entity\Tag findOrCreate($search, callable $callback = null, $options = [])
*/
class TagsTable extends Table
{
  /**
  * Initialize method
  *
  * @param array $config The configuration for the Table.
  * @return void
  */
  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->setTable('tags');
    $this->setDisplayField('name');
    $this->setPrimaryKey('id');

    $this->addBehavior('Search.Search');
    $this->searchManager()
    ->add('q', 'Search.Like', [
      'before' => true,
      'after' => true,
      'mode' => 'or',
      'comparison' => 'LIKE',
      'wildcardAny' => '*',
      'wildcardOne' => '?',
      'field' => ['name']
    ]);
    $this->belongsToMany('Posts', [
      'foreignKey' => 'tag_id',
      'targetForeignKey' => 'post_id',
      'joinTable' => 'posts_tags',
      'className' => 'Trois/Blog.Posts'
    ]);

    // custom
    $i18n = Configure::read('I18n.languages');
    $translate = (empty($i18n))? false: true;
    $this->addBehavior('Trois/Utils.Sluggable', ['field' => 'name','translate' => $translate]);
    if($translate)
    {
      $this->addBehavior('Trois/Utils.Translate', ['fields' => ['name','slug','meta']]);
    }
  }

  /**
  * Default validation rules.
  *
  * @param \Cake\Validation\Validator $validator Validator instance.
  * @return \Cake\Validation\Validator
  */
  public function validationDefault(Validator $validator)
  {
    $validator
    ->integer('id')
    ->allowEmpty('id', 'create');

    $validator
    ->scalar('name')
    ->maxLength('name', 255)
    ->requirePresence('name', 'create')
    ->notEmpty('name');

    $validator
    ->scalar('slug')
    ->maxLength('slug', 255)
    ->requirePresence('slug', 'create')
    ->notEmpty('slug');

    return $validator;
  }

  public function buildRules(RulesChecker $rules)
  {
    $rules->add(new \Trois\Utils\Model\Rule\IsUniqueTranslationRule(['slug']));
    $rules->add($rules->isUnique(['slug']));

    return $rules;
  }
}
