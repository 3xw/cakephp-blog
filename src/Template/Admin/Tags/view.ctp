<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $tag
 */
?>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <?= $this->Html->link('<i class="material-icons">list</i> '.__('List'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">mode_edit</i> '.__('Edit'),['action'=>'edit', $tag->id], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">delete</i> '.__('Delete'),['action'=>'delete',$tag->id], ['class' => '','escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">

    <div class="card">
      <div class="card-header">
          <h2><?= h($tag->name) ?></h2>
      </div>
      <!-- CONTENT -->
      <div class="card-body">
        <figure class="figure figure--table">

        <table class="table">
          <tbody>
                                                <tr>
                <th scope="row"><?= __('Name') ?></th>
                <td><?= h($tag->name) ?></td>
            </tr>
                                                <tr>
                <th scope="row"><?= __('Slug') ?></th>
                <td><?= h($tag->slug) ?></td>
            </tr>
                                                                                            <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($tag->id) ?></td>
                    </tr>
                                                                </table>
      </figure>

            </div>
    </div>
  </div>
</div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
                    <?php if (!empty($tag->posts)): ?>
      <div class="card  mt-4">
        <div class="card-body">
          <h4 class="card-title"><?= __('Related <%= $otherPluralHumanName %>') ?></h4>
          <figure class="figure figure--table">
            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead>
                <tr>
                                <th scope="col"><?= __('Id') ?></th>
                              <th scope="col"><?= __('Title') ?></th>
                              <th scope="col"><?= __('Slug') ?></th>
                              <th scope="col"><?= __('Created') ?></th>
                              <th scope="col"><?= __('Modified') ?></th>
                              <th scope="col"><?= __('Is Published') ?></th>
                              <th scope="col"><?= __('Publish Date') ?></th>
                              <th scope="col"><?= __('Meta') ?></th>
                              <th scope="col"><?= __('Header') ?></th>
                              <th scope="col"><?= __('Body') ?></th>
                              <th scope="col"><?= __('Enable Comment') ?></th>
                              <th scope="col"><?= __('Category Id') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($tag->posts as $posts): ?>
                    <tr>
                                        <td><?= h($posts->id) ?></td>
                                        <td><?= h($posts->title) ?></td>
                                        <td><?= h($posts->slug) ?></td>
                                        <td><?= h($posts->created) ?></td>
                                        <td><?= h($posts->modified) ?></td>
                                        <td><?= h($posts->is_published) ?></td>
                                        <td><?= h($posts->publish_date) ?></td>
                                        <td><?= h($posts->meta) ?></td>
                                        <td><?= h($posts->header) ?></td>
                                        <td><?= h($posts->body) ?></td>
                                        <td><?= h($posts->enable_comment) ?></td>
                                        <td><?= h($posts->category_id) ?></td>
                                                            <td data-title="actions" class="actions" class="text-right">
                      <div class="btn-group">
                        <?= $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>
                      </td>
                    </div>
                  </tr >

                <?php endforeach; ?>
              </tbody>
            </table>
          </figure>
        </div>
      </div>
    <?php endif; ?>
    </div>
</div>
<div class="utils--spacer-default"></div>
