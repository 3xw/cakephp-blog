<?php
namespace Trois\Blog\Controller\Admin;

use App\Controller\AppController;

/**
* Tags Controller
*
* @property \Trois\Blog\Model\Table\TagsTable $Tags
*
* @method \Trois\Blog\Model\Entity\Tag[] paginate($object = null, array $settings = [])
*/
class TagsController extends AppController
{
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
    $tags = $this->paginate($this->Tags);

    $this->set(compact('tags'));
    $this->set('_serialize', ['tags']);
  }

  /**
  * View method
  *
  * @param string|null $id Tag id.
  * @return \Cake\Http\Response|void
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function view($id = null)
  {
    $tag = $this->Tags->get($id, [
      'contain' => ['Posts']
    ]);

    $this->set('tag', $tag);
    $this->set('_serialize', ['tag']);
  }

  /**
  * Add method
  *
  * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
  */
  public function add()
  {
    $tag = $this->Tags->newEntity();
    if ($this->request->is('post')) {
      $tag = $this->Tags->patchEntity($tag, $this->request->getData());
      if ($this->Tags->save($tag)) {
        $this->Flash->success(__('The tag has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The tag could not be saved. Please, try again.'));
    }
    $posts = $this->Tags->Posts->find('list', ['limit' => 200]);
    $this->set(compact('tag', 'posts'));
    $this->set('_serialize', ['tag']);
  }

  /**
  * Edit method
  *
  * @param string|null $id Tag id.
  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
  * @throws \Cake\Network\Exception\NotFoundException When record not found.
  */
  public function edit($id = null)
  {
    $tag = $this->Tags->get($id, [
      'contain' => ['Posts']
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $tag = $this->Tags->patchEntity($tag, $this->request->getData());
      if ($this->Tags->save($tag)) {
        $this->Flash->success(__('The tag has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The tag could not be saved. Please, try again.'));
    }
    $posts = $this->Tags->Posts->find('list', ['limit' => 200]);
    $this->set(compact('tag', 'posts'));
    $this->set('_serialize', ['tag']);
  }

  /**
  * Delete method
  *
  * @param string|null $id Tag id.
  * @return \Cake\Http\Response|null Redirects to index.
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $tag = $this->Tags->get($id);
    if ($this->Tags->delete($tag)) {
      $this->Flash->success(__('The tag has been deleted.'));
    } else {
      $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
