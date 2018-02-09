<?php
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $posts
*/
?>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">

      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">add</i> '.__('Add'),['action'=>'add'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
    <!-- LIST ELEMENT -->
    <div class="card">

      <div class="card-header">
        <h2 class="card-title">
          <?= __('Posts')?> <small><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></small>
          </h2>
          <?= $this->Form->create('Search', ['novalidate', 'class'=>'', 'role'=>'search']) ?>
          <?= $this->Form->input('q', ['class'=>'form-control', 'placeholder'=>__('Search...'), 'label'=>false]) ?>
          <?= $this->Form->end() ?>
          </div>

          <!-- START CONTEMT -->
          <div class="card-body">

          <figure class="figure figure--table">

          <table id="datatables" class="table table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
          <thead class="thead-default">
          <tr>
                    

          <th scope="col"><?= $this->Paginator->sort('id') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('title') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('slug') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('created') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('modified') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('is_published') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('publish_date') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('meta') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('header') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('body') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('enable_comment') ?></th>

                

          <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>

            <th scope="col" class="actions"><?= __('Actions') ?></th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($posts as $post): ?>
      <tr>
                                    <td><?= $this->Number->format($post->id) ?></td>
                              <td><?= h($post->title) ?></td>
                              <td><?= h($post->slug) ?></td>
                              <td><?= h($post->created) ?></td>
                              <td><?= h($post->modified) ?></td>
                              <td><?= h($post->is_published) ?></td>
                              <td><?= h($post->publish_date) ?></td>
                              <td><?= h($post->meta) ?></td>
                              <td><?= h($post->header) ?></td>
                              <td><?= h($post->body) ?></td>
                              <td><?= h($post->enable_comment) ?></td>
                                <td><?= $post->has('category') ? $this->Html->link($post->category->name, ['controller' => 'Categories', 'action' => 'view', $post->category->id]) : '' ?></td>
        <td data-title="actions" class="actions" class="text-right">
<div class="btn-group">
<?= $this->Html->link('<i class="material-icons">visibility</i>', ['action' => 'view', $post->id],['class' => 'btn btn-xs btn-simple btn-info btn-icon edit','escape' => false]) ?>
<?= $this->Html->link('<i class="material-icons">mode_edit</i>', ['action' => 'edit', $post->id], ['class' => 'btn btn-xs btn-simple btn-warning btn-icon edit','escape' => false]) ?>
<?= $this->Form->postLink('<i class="material-icons">delete</i>', ['action' => 'delete', $post->id], ['class' => 'btn btn-xs btn-simple btn-danger btn-icon remove','escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?',  $post->id)]) ?>
</div>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</figure>
</div>
<!-- END CONTEMT -->
<!-- START FOOTER -->
<div class="card-footer">
<div class="row no-gutters">
<div class="col-6">
<?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?>
</div>
<div class="col-6">
<nav aria-label="pagination">
<ul class="pagination justify-content-end">
<?= $this->Paginator->first('<< ' . __('first'),['class'=>'btn '])?>
<?= $this->Paginator->prev('< ' . __('previous')) ?>
<?= $this->Paginator->numbers() ?>
<?= $this->Paginator->next(__('next') . ' >') ?>
<?= $this->Paginator->last(__('last') . ' >>') ?>
</ul>
</nav>
</div>
</div>
</div>
<!-- END FOOTER -->
</div><!-- end content-->
</div><!-- end card-->
</div><!-- end col-xs-12-->
