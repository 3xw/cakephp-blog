<?php
namespace Trois\Blog\Model\Entity;

use Cake\ORM\Entity;

/**
* Category Entity
*
* @property int $id
* @property string $name
* @property string $slug
* @property string $meta
*
* @property \Trois\Blog\Model\Entity\Post[] $posts
*/
class Category extends Entity
{

  protected $_accessible = [
    '*' => true,
    'id' => false,
  ];
}
