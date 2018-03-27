<?php
namespace Trois\Blog\Controller\Admin;

use Cake\Core\Configure;
use App\Controller\AppController;

/**
* Categories Controller
*
* @property \Trois\Blog\Model\Table\CategoriesTable $Categories
*
* @method \Trois\Blog\Model\Entity\Category[] paginate($object = null, array $settings = [])
*/
class CategoriesController extends AppController
{
  public $paginate = [
    'limit' => 100,
    'order' => [
      'Categories.name' => 'asc'
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
    $query = $this->Categories
    ->find('search',['search' => $this->request->query]);
    $categories = $this->paginate($query);

    $this->set(compact('categories'));
    $this->set('_serialize', ['categories']);
  }

  /**
  * Add method
  *
  * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
  */
  public function add()
  {
    $category = $this->Categories->newEntity();
    if ($this->request->is('post')) {
      $category = $this->Categories->patchEntity($category, $this->request->getData());
      if ($this->Categories->save($category)) {
        $this->Flash->success(__('The category has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The category could not be saved. Please, try again.'));
    }
    $this->set(compact('category'));
    $this->set('_serialize', ['category']);
  }

  /**
  * Edit method
  *
  * @param string|null $id Category id.
  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
  * @throws \Cake\Network\Exception\NotFoundException When record not found.
  */
  public function edit($id = null)
  {
    $i18n = Configure::read('I18n.languages');
    $translate = (empty($i18n))? false : true;

    $query = ($translate)? $this->Categories->find('translations') :  $this->Categories->find();

    $category = $query
    ->where(['Categories.id' => $id])
    ->first();

    if ($this->request->is(['patch', 'post', 'put'])) {
      $category = $this->Categories->patchEntity($category, $this->request->getData());
      if ($this->Categories->save($category)) {
        $this->Flash->success(__('The category has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The category could not be saved. Please, try again.'));
    }
    $this->set(compact('category'));
    $this->set('_serialize', ['category']);
  }

  /**
  * Delete method
  *
  * @param string|null $id Category id.
  * @return \Cake\Http\Response|null Redirects to index.
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $category = $this->Categories->get($id);
    if ($this->Categories->delete($category)) {
      $this->Flash->success(__('The category has been deleted.'));
    } else {
      $this->Flash->error(__('The category could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
