<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $post
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
        <?= $this->Html->link('<i class="material-icons">mode_edit</i> '.__('Edit'),['action'=>'edit', $post->id], ['class' => '','escape'=>false]) ?>
        <?= $this->Html->link('<i class="material-icons">delete</i> '.__('Delete'),['action'=>'delete',$post->id], ['class' => '','escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">

    <div class="card">
      <div class="card-header">
          <h2><?= h($post->title) ?></h2>
      </div>
      <!-- CONTENT -->
      <div class="card-body">
        <figure class="figure figure--table">

        <table class="table">
          <tbody>
                                                <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($post->title) ?></td>
            </tr>
                                                <tr>
                <th scope="row"><?= __('Slug') ?></th>
                <td><?= h($post->slug) ?></td>
            </tr>
                                                <tr>
                <th scope="row"><?= __('Meta') ?></th>
                <td><?= h($post->meta) ?></td>
            </tr>
                                                            <tr>
                <th scope="row"><?= __('Category') ?></th>
                <td><?= $post->has('category') ? $this->Html->link($post->category->name, ['controller' => 'Categories', 'action' => 'view', $post->category->id]) : '' ?></td>
            </tr>
                                                                                            <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($post->id) ?></td>
                    </tr>
                                                                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($post->created) ?></td>
                    </tr>
                                <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($post->modified) ?></td>
                    </tr>
                                <tr>
                        <th scope="row"><?= __('Publish Date') ?></th>
                        <td><?= h($post->publish_date) ?></td>
                    </tr>
                                                                    <tr>
                        <th scope="row"><?= __('Is Published') ?></th>
                        <td><?= $post->is_published ? __('Yes') : __('No'); ?></td>
                    </tr>
                                <tr>
                        <th scope="row"><?= __('Enable Comment') ?></th>
                        <td><?= $post->enable_comment ? __('Yes') : __('No'); ?></td>
                    </tr>
                                        </table>
      </figure>

                          <?= $post->header; ?>
                    <?= $post->body; ?>
                  </div>
    </div>
  </div>
</div>
<div class="row no-gutters">
  <div class="col-11 mx-auto ">
                    <?php if (!empty($post->attachments)): ?>
      <div class="card  mt-4">
        <div class="card-body">
          <h4 class="card-title"><?= __('Related <%= $otherPluralHumanName %>') ?></h4>
          <figure class="figure figure--table">
            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead>
                <tr>
                                <th scope="col"><?= __('Id') ?></th>
                              <th scope="col"><?= __('Name') ?></th>
                              <th scope="col"><?= __('Created') ?></th>
                              <th scope="col"><?= __('Modified') ?></th>
                              <th scope="col"><?= __('Type') ?></th>
                              <th scope="col"><?= __('Subtype') ?></th>
                              <th scope="col"><?= __('Size') ?></th>
                              <th scope="col"><?= __('Md5') ?></th>
                              <th scope="col"><?= __('Date') ?></th>
                              <th scope="col"><?= __('Title') ?></th>
                              <th scope="col"><?= __('Description') ?></th>
                              <th scope="col"><?= __('Author') ?></th>
                              <th scope="col"><?= __('Copyright') ?></th>
                              <th scope="col"><?= __('Path') ?></th>
                              <th scope="col"><?= __('Embed') ?></th>
                              <th scope="col"><?= __('Profile') ?></th>
                              <th scope="col"><?= __('Width') ?></th>
                              <th scope="col"><?= __('Height') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($post->attachments as $attachments): ?>
                    <tr>
                                        <td><?= h($attachments->id) ?></td>
                                        <td><?= h($attachments->name) ?></td>
                                        <td><?= h($attachments->created) ?></td>
                                        <td><?= h($attachments->modified) ?></td>
                                        <td><?= h($attachments->type) ?></td>
                                        <td><?= h($attachments->subtype) ?></td>
                                        <td><?= h($attachments->size) ?></td>
                                        <td><?= h($attachments->md5) ?></td>
                                        <td><?= h($attachments->date) ?></td>
                                        <td><?= h($attachments->title) ?></td>
                                        <td><?= h($attachments->description) ?></td>
                                        <td><?= h($attachments->author) ?></td>
                                        <td><?= h($attachments->copyright) ?></td>
                                        <td><?= h($attachments->path) ?></td>
                                        <td><?= h($attachments->embed) ?></td>
                                        <td><?= h($attachments->profile) ?></td>
                                        <td><?= h($attachments->width) ?></td>
                                        <td><?= h($attachments->height) ?></td>
                                                            <td data-title="actions" class="actions" class="text-right">
                      <div class="btn-group">
                        <?= $this->Html->link(__('View'), ['controller' => 'Attachments', 'action' => 'view', $attachments->id]) ?>
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
              <?php if (!empty($post->tags)): ?>
      <div class="card  mt-4">
        <div class="card-body">
          <h4 class="card-title"><?= __('Related <%= $otherPluralHumanName %>') ?></h4>
          <figure class="figure figure--table">
            <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead>
                <tr>
                                <th scope="col"><?= __('Id') ?></th>
                              <th scope="col"><?= __('Name') ?></th>
                              <th scope="col"><?= __('Slug') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($post->tags as $tags): ?>
                    <tr>
                                        <td><?= h($tags->id) ?></td>
                                        <td><?= h($tags->name) ?></td>
                                        <td><?= h($tags->slug) ?></td>
                                                            <td data-title="actions" class="actions" class="text-right">
                      <div class="btn-group">
                        <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
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
