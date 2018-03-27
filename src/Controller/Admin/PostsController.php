<?php
namespace Trois\Blog\Controller\Admin;

use Cake\Core\Configure;
use App\Controller\AppController;

/**
* Posts Controller
*
* @property \Trois\Blog\Model\Table\PostsTable $Posts
*
* @method \Trois\Blog\Model\Entity\Post[] paginate($object = null, array $settings = [])
*/
class PostsController extends AppController
{
  public $paginate = [
    'limit' => 100,
    'order' => [
      'Posts.publish_date' => 'DESC'
    ]
  ];

  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('Search.Prg', [
      'actions' => ['index']
    ]);
  }

  /**
  * Index method
  *
  * @return \Cake\Http\Response|void
  */
  public function index()
  {

    $query = $this->Posts
    ->find('search',['search' => $this->request->query])
    ->contain(['Categories']);
    $posts = $this->paginate($query);

    $this->set(compact('posts'));
    $this->set('_serialize', ['posts']);
  }

  /**
  * View method
  *
  * @param string|null $id Post id.
  * @return \Cake\Http\Response|void
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function view($id = null)
  {
    $post = $this->Posts->get($id, [
      'contain' => ['Categories', 'Attachments', 'Tags']
    ]);

    $this->set('post', $post);
    $this->set('_serialize', ['post']);
  }

  /**
  * Add method
  *
  * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
  */
  public function add()
  {
    $post = $this->Posts->newEntity();
    if ($this->request->is('post')) {
      $post = $this->Posts->patchEntity($post, $this->request->getData());
      if ($this->Posts->save($post)) {
        $this->Flash->success(__('The post has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The post could not be saved. Please, try again.'));
    }
    $categories = $this->Posts->Categories->find('list', ['limit' => 200]);
    $tags = $this->Posts->Tags->find('list', ['limit' => 200]);
    $this->set(compact('post', 'categories', 'tags'));
    $this->set('_serialize', ['post']);
  }

  /**
  * Edit method
  *
  * @param string|null $id Post id.
  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
  * @throws \Cake\Network\Exception\NotFoundException When record not found.
  */
  public function edit($id = null)
  {
    $i18n = Configure::read('I18n.languages');
    $translate = (empty($i18n))? false : true;

    $query = ($translate)? $this->Posts->find('translations') :  $this->Posts->find();

    $post = $query
    ->contain(['Attachments', 'Tags'])
    ->where(['Posts.id' => $id])
    ->first();

    if ($this->request->is(['patch', 'post', 'put'])) {
      $post = $this->Posts->patchEntity($post, $this->request->getData());
      if ($this->Posts->save($post)) {
        $this->Flash->success(__('The post has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The post could not be saved. Please, try again.'));
    }
    $categories = $this->Posts->Categories->find('list', ['limit' => 200]);
    $tags = $this->Posts->Tags->find('list', ['limit' => 200]);
    $this->set(compact('post', 'categories', 'tags'));
    $this->set('_serialize', ['post']);
  }

  /**
  * Delete method
  *
  * @param string|null $id Post id.
  * @return \Cake\Http\Response|null Redirects to index.
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $post = $this->Posts->get($id);
    if ($this->Posts->delete($post)) {
      $this->Flash->success(__('The post has been deleted.'));
    } else {
      $this->Flash->error(__('The post could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
