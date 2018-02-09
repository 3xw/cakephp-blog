<?php
namespace Trois\Blog\Model\Entity;

use Cake\ORM\Entity;

class Tag extends Entity
{
  protected $_accessible = [
    '*' => true,
    'id' => false,
  ];
}
