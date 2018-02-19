<?php
namespace Trois\Blog\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;

use Cake\Utility\Inflector;
use ArrayObject;
use Cake\Datasource\ConnectionManager; // putain de génie!!!!
use Cake\Datasource\EntityInterface; // je confirme !
use Cake\I18n\I18n;
use Cake\Validation\Validator;

class SluggableBehavior extends Behavior
{

  /**
  * Default config.
  *
  * @var array
  */
  protected $_defaultConfig = [
    'field' => 'title',
    'slug' => 'slug',
    'replacement' => '-',
    'max_length' => 255,
    'connection_name' => 'default',
    'translate' => false,
    'translationTable' => 'i18n',
    'base_locale_not_in_i18n' => 'fr_CH'
  ];

  public function buildValidator(Event $event, Validator $validator, $name)
  {
    $config = $this->config();
    $slug = $config['slug'];
    $validator->requirePresence($slug, false)->allowEmpty($slug);
  }

  public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
  {
    $config = $this->config();
    $slug = $config['slug'];
    $field = $config['field'];

    if(empty($entity->get($slug)))
    {
      $this->slug($event, $entity, $field, $slug);
    }
  }

  public function slug(Event $event, EntityInterface $entity, $field, $slug)
  {
    $config = $this->config();

    if(empty($entity->get($field)))
    {
      $event->stopPropagation();
      $entity->errors($field,['Slug behavior needs a non empty field to create slug']);
    }

    $value = $entity->get($field);
    $id = empty($entity->get('id'))? -1 : $entity->get('id');
    $entity->set($slug, $this->_generate_slug($id, $value));

    if($config['translate'] && !empty($entity->get('_translations')))
    {
      foreach ($entity->get('_translations') as $locale => $fields)
      {
        $value = empty($entity->get('_translations')[$locale]->$field) ?
          $entity->get($field)
          : $entity->get('_translations')[$locale]->$field;

        $entity->get('_translations')[$locale]->set($slug, $this->_generate_slug($id, $value, $locale));
      }
    }
  }

  public function _generate_slug($id, $value, $locale = null )
  {
    $config = $this->config();
    $field = $config['slug'];
    $slug = strtolower(Inflector::slug($value, $config['replacement']));

    if (strlen($slug) > $config['max_length'])
    {
        $slug = substr($slug, 0, $config['max_length']);
    }
    return $this->_deduplicate_slug($id, $slug, $field, $locale);
  }

  private function _deduplicate_slug($id, $slug, $field, $locale = null)
  {
    $config = $this->config();

    $tableName = ( $locale )? $config['translationTable'] : $this->_table->table();
    $f = ($locale)? 'content' : $field;

    if($locale)
    {
      $query = "SELECT $f AS `slug`, CONVERT(REPLACE($f, '$slug-', ''), UNSIGNED INTEGER) AS `dupes` FROM $tableName "
        ."WHERE $f LIKE '$slug%' AND locale = '$locale' AND model = '".$this->_table->alias()."' AND foreign_key != $id AND field = '$field' "
        ."ORDER BY `dupes` DESC LIMIT 1 OFFSET 0";
    }else{
      $query = "SELECT $f AS `slug`, CONVERT(REPLACE($f, '$slug-', ''), UNSIGNED INTEGER) AS `dupes` FROM $tableName "
        ."WHERE $f LIKE '$slug%' AND id != $id "
        ."ORDER BY `dupes` DESC  LIMIT 1 OFFSET 0";
    }

    $conn = ConnectionManager::get($config['connection_name']);
    $result = $conn->execute($query);
    $dupes = $result->fetchAll('assoc');
    //debug(count($dupes));
    if
    (0 === count($dupes)){ return $slug; }
    else
    {
      $last = $dupes[0]['dupes'];
      $number =  (int) $last;
      $number++;

      $dupes = $config['replacement'].$number;
      $new_suffix_length = strlen($dupes);
      $slug_length = strlen($slug);
      $max_length = $config['max_length'];

      if ($new_suffix_length + $slug_length > $max_length) {
          $replace_at = -1 * $new_suffix_length;
      } else {
          $replace_at = $slug_length;
      }

      return substr_replace($slug, $dupes, $replace_at);
    }
  }
}
