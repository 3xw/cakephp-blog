<?php
namespace Trois\Blog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Inflector;
use Cake\Core\Configure;

/**
* Posts Model
*
* @property \Trois\Blog\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
* @property \Trois\Blog\Model\Table\AttachmentsTable|\Cake\ORM\Association\BelongsToMany $Attachments
* @property \Trois\Blog\Model\Table\IssuesTable|\Cake\ORM\Association\BelongsToMany $Issues
* @property \Trois\Blog\Model\Table\MembersTable|\Cake\ORM\Association\BelongsToMany $Members
* @property \Trois\Blog\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
*
* @method \Trois\Blog\Model\Entity\Post get($primaryKey, $options = [])
* @method \Trois\Blog\Model\Entity\Post newEntity($data = null, array $options = [])
* @method \Trois\Blog\Model\Entity\Post[] newEntities(array $data, array $options = [])
* @method \Trois\Blog\Model\Entity\Post|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
* @method \Trois\Blog\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
* @method \Trois\Blog\Model\Entity\Post[] patchEntities($entities, array $data, array $options = [])
* @method \Trois\Blog\Model\Entity\Post findOrCreate($search, callable $callback = null, $options = [])
*
* @mixin \Cake\ORM\Behavior\TimestampBehavior
*/
class PostsTable extends Table
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

    $this->setTable('posts');
    $this->setDisplayField('title');
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
      'field' => ['title']
    ]);
    $this->addBehavior('Timestamp');

    $this->belongsTo('Categories', [
      'foreignKey' => 'category_id',
      'joinType' => 'INNER',
      'className' => 'Trois/Blog.Categories'
    ]);
    $this->belongsToMany('Attachments', [
      'foreignKey' => 'post_id',
      'targetForeignKey' => 'attachment_id',
      'joinTable' => 'attachments_posts',
      'className' => 'Attachment.Attachments'
    ]);
    $this->belongsToMany('Tags', [
      'foreignKey' => 'post_id',
      'targetForeignKey' => 'tag_id',
      'joinTable' => 'posts_tags',
      'className' => 'Trois/Blog.Tags'
    ]);

    // custom
    $i18n = Configure::read('I18n.languages');
    $translate = (empty($i18n))? false: true;
    $this->addBehavior('Trois/Blog.Sluggable', ['field' => 'title','translate' => $translate]);
    if($translate)
    {
      $this->addBehavior('Translate', ['fields' => ['title','slug','meta','header','body']]);
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
    ->scalar('title')
    ->maxLength('title', 255)
    ->allowEmpty('title');

    $validator
    ->scalar('slug')
    ->maxLength('slug', 255)
    ->allowEmpty('slug');

    $validator
    ->boolean('is_published')
    ->allowEmpty('is_published');

    $validator
    ->dateTime('publish_date')
    ->allowEmpty('publish_date');

    $validator
    ->scalar('meta')
    ->maxLength('meta', 255)
    ->allowEmpty('meta');

    $validator
    ->scalar('header')
    ->allowEmpty('header');

    $validator
    ->scalar('body')
    ->allowEmpty('body');

    $validator
    ->boolean('enable_comment')
    ->allowEmpty('enable_comment');

    return $validator;
  }

  /**
  * Returns a rules checker object that will be used for validating
  * application integrity.
  *
  * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
  * @return \Cake\ORM\RulesChecker
  */
  public function buildRules(RulesChecker $rules)
  {
    $rules->add($rules->existsIn(['category_id'], 'Categories'));

    return $rules;
  }
}
