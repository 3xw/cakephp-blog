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
        <h2><?= __('Add Post') ?></h2>
      </div>
      <div class="card-body">
        <?= $this->Form->create($post) ?>

        <div class="row">
          <div class="col-md-6">

            <!-- No i18n -->
            <?php if(empty($i18n)): ?>
              <?= $this->Form->control('is_published',['class'=>'form-control']) ?>
              <?= $this->Form->control('enable_comment',['class'=>'form-control']) ?>
              <?= $this->Form->input('title', ['class' => 'form-control']) ?>
            <?php else: ?>
              <?= $this->element('locale',[
                'fields' => [
                  'is_published',
                  'enable_comment',
                  'title',
                  'author' =>[
                    'value' => $this->request->session()->read('Auth.User.first_name').' '.$this->request->session()->read('Auth.User.last_name')
                    ]
              ]]) ?>
            <?php endif;  ?>

          </div>
          <div class="col-md-6">
            <?
            echo $this->Form->control('publish_date', ['empty' => true, 'class'=>'form-control']);
            echo $this->Form->control('category_id', ['options' => $categories, 'class'=>'form-control']);
            echo $this->Form->control('tags._ids', ['options' => $tags, 'class'=>'form-control']);
            ?>
          </div>
        </div>

        <!-- No i18n -->
        <?php if(empty($i18n)): ?>
          <?php
          echo $this->Form->control('meta',['class'=>'form-control']);
          echo $this->Form->control('header',['class'=>'form-control']);
          echo $this->element('Trois/Tinymce.tinymce',[
            'field' => 'body',
            'value' => '',
            'init' => [
              'external_plugins' => [
                'attachment' => $this->Url->build('/attachment/js/Plugins/tinymce/plugin.min.js', true),
              ],
              'attachment_settings' => $this->Attachment->jsSetup('body',[
                'types' => [
                  'application/pdf',
                  'application/msword',
                  'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                  'application/vnd.ms-excel',
                  'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                  'image/jpeg',
                  'image/png',
                  'embed/youtube',
                  'embed/vimeo'
                ],
                'atags' => [],
                'restrictions' => [
                  Attachment\View\Helper\AttachmentHelper::TAG_OR_RESTRICTED,
                  Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
                ],
              ])
            ]
          ]);
          ?>
        <?php else: ?>
          <?= $this->element('locale',['fields' => ['meta','header','body' => [
            'Trois/Tinymce.tinymce' => [
              'value' => '',
              'init' => [
                'external_plugins' => [
                  'attachment' => $this->Url->build('/attachment/js/Plugins/tinymce/plugin.min.js', true),
                ],
                'attachment_settings' => [
                  'types' => [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'image/jpeg',
                    'image/png',
                    'embed/youtube',
                    'embed/vimeo'
                  ],
                  'atags' => [],
                  'restrictions' => [
                    Attachment\View\Helper\AttachmentHelper::TAG_OR_RESTRICTED,
                    Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
                  ],
                ]
              ]
            ],
            ]]]) ?>
          <?php endif;  ?>

          <?php
          echo $this->Attachment->input('Attachments', // if Attachments => HABTM else if !Attachments => belongsTo
          ['label' => __('Media'),
          'atags' => [],
          'restrictions' => [
            Attachment\View\Helper\AttachmentHelper::TAG_RESTRICTED,
            Attachment\View\Helper\AttachmentHelper::TYPES_RESTRICTED
          ],
          'attachments' => [] // array of exisiting Attachment entities ( HABTM ) or entity ( belongsTo )
        ]);
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
