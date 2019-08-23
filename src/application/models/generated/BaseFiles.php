<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Files', 'dbh');

/**
 * BaseFiles
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $creator_id
 * @property timestamp $created_at
 * @property string $model_name
 * @property integer $item_id
 * @property integer $type
 * @property string $title
 * @property string $title_original
 * @property integer $size
 * @property string $hash
 * @property string $ext
 * @property string $path
 * @property Editors $Creator
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFiles extends AbstractRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('files');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('creator_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => false,
             'length' => '4',
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => false,
             'length' => '25',
             ));
        $this->hasColumn('model_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('item_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('type', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => true,
             'default' => '0',
             'notnull' => true,
             'length' => '1',
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('title_original', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '',
             ));
        $this->hasColumn('size', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => false,
             'length' => '4',
             ));
        $this->hasColumn('hash', 'string', 45, array(
             'type' => 'string',
             'notnull' => false,
             'length' => '45',
             ));
        $this->hasColumn('ext', 'string', 8, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('path', 'string', 512, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '512',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Editors as Creator', array(
             'local' => 'creator_id',
             'foreign' => 'id'));
    }
}