<?php
use Cake\Core\Configure;
$i18n = Configure::read('I18n.languages');
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
        <h2><?= __('Add Category') ?></h2>
      </div>
      <div class="card-body">
        <?= $this->Form->create($category) ?>


        <!-- No i18n -->
        <?php if(empty($i18n)): ?>
          <div class="col-md-12">
            <?= $this->Form->input('name', ['class' => 'form-control']) ?>
            <?= $this->Form->input('slug', ['class' => 'form-control']) ?>
            <?= $this->Form->input('meta', ['class' => 'form-control']) ?>
          </div>
        <?php else: ?>
          <div class="col-12">
            <?= $this->element('locale',['fields' => ['name','slug','meta']]) ?>
          </div>
        <?php endif;  ?>


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
