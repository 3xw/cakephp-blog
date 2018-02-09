<?php
namespace Trois\Blog\Model\Entity;

use Cake\ORM\Entity;

/**
* Post Entity
*
* @property int $id
* @property string $title
* @property string $slug
* @property \Cake\I18n\FrozenTime $created
* @property \Cake\I18n\FrozenTime $modified
* @property bool $is_published
* @property \Cake\I18n\FrozenTime $publish_date
* @property string $meta
* @property string $header
* @property string $body
* @property bool $enable_comment
* @property int $category_id
*
* @property \Trois\Blog\Model\Entity\Category $category
* @property \Trois\Blog\Model\Entity\Attachment[] $attachments
* @property \Trois\Blog\Model\Entity\Issue[] $issues
* @property \Trois\Blog\Model\Entity\Member[] $members
* @property \Trois\Blog\Model\Entity\Tag[] $tags
*/
class Post extends Entity
{

  protected $_accessible = [
    '*' => true,
    'id' => false,
  ];
}
