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
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-default"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto">
    <div class="card">
      <div class="card-header">
        <h2><?= __('Edit Post') ?></h2>
      </div>
      <div class="card-body">
        <?= $this->Form->create($post) ?>
        <?php
                            echo $this->Form->control('title',['class'=>'form-control']);
                    echo $this->Form->control('slug',['class'=>'form-control']);
                    echo $this->Form->control('is_published',['class'=>'form-control']);
                    echo $this->Form->control('publish_date', ['empty' => true, 'class'=>'form-control']);
                    echo $this->Form->control('meta',['class'=>'form-control']);
                    echo $this->Form->control('header',['class'=>'form-control']);
                    echo $this->Form->control('body',['class'=>'form-control']);
                    echo $this->Form->control('enable_comment',['class'=>'form-control']);
                    echo $this->Form->control('category_id', ['options' => $categories, 'class'=>'form-control']);
                    echo $this->Form->control('attachments._ids', ['options' => $attachments, 'class'=>'form-control']);
                    echo $this->Form->control('tags._ids', ['options' => $tags, 'class'=>'form-control']);
        
      ?>
      <div class="text-right">
        <div class="btn-group">
          <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-danger btn-fill']) ?>
          <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info btn-fill']) ?>
        </div>
      </div>
      <?= $this->Form->end() ?>
      </div>

  </div>
</div>
</div>
<div class="utils--spacer-default"></div>
