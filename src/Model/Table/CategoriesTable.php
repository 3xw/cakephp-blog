<?php
namespace Trois\Blog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Inflector;
use Cake\Core\Configure;

/**
* Categories Model
*
* @property \Trois\Blog\Model\Table\PostsTable|\Cake\ORM\Association\HasMany $Posts
*
* @method \Trois\Blog\Model\Entity\Category get($primaryKey, $options = [])
* @method \Trois\Blog\Model\Entity\Category newEntity($data = null, array $options = [])
* @method \Trois\Blog\Model\Entity\Category[] newEntities(array $data, array $options = [])
* @method \Trois\Blog\Model\Entity\Category|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
* @method \Trois\Blog\Model\Entity\Category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
* @method \Trois\Blog\Model\Entity\Category[] patchEntities($entities, array $data, array $options = [])
* @method \Trois\Blog\Model\Entity\Category findOrCreate($search, callable $callback = null, $options = [])
*/
class CategoriesTable extends Table
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

    $this->setTable('categories');
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
    $this->hasMany('Posts', [
      'foreignKey' => 'category_id',
      'className' => 'Trois/Blog.Posts'
    ]);

    // custom
    $i18n = Configure::read('I18n.languages');
    $translate = (empty($i18n))? false: true;
    $this->addBehavior('Trois/Blog.Sluggable', ['field' => 'name','translate' => $translate]);
    if($translate)
    {
      $this->addBehavior('Translate', ['fields' => ['name','slug','meta']]);
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

    $validator
    ->scalar('meta')
    ->maxLength('meta', 255)
    ->allowEmpty('meta');

    return $validator;
  }
}
