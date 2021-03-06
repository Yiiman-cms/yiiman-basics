<?php
/**
 * Copyright (c) 2008-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib;

use CURLFile;
use kartik\file\FileInput;
use kartik\select2\Select2;
use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use YiiMan\YiiBasics\modules\gallery\models\GalleryMedias;
use YiiMan\YiiBasics\modules\hint\models\Hint;
use YiiMan\YiiBasics\modules\language\models\Language;
use YiiMan\Setting\module\models\DynamicModel;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use YiiMan\YiiBasics\widgets\TreeSelector\TreeSelectorWidget;
use This;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\behaviors\SluggableBehavior;
use yii\bootstrap\ActiveForm;
use yii\db\ActiveQuery;
use yii\db\Migration;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;
use YiiMan\YiiBasics\lib\i18n\Layout;
use function var_dump;

/**
 * ActiveRecord is the base class for classes representing relational data in terms of objects.
 * Active Record implements the [Active Record design pattern](http://en.wikipedia.org/wiki/Active_record).
 * The premise behind Active Record is that an individual [[ActiveRecord]] object is associated with a specific
 * row in a database table. The object's attributes are mapped to the columns of the corresponding table.
 * Referencing an Active Record attribute is equivalent to accessing the corresponding table column for that
 * record.
 * As an example, say that the `Customer` ActiveRecord class is associated with the `customer` table.
 * This would mean that the class's `name` attribute is automatically mapped to the `name` column in `customer`
 * table. Thanks to Active Record, assuming the variable `$customer` is an object of type `Customer`, to get the
 * value of the `name` column for the table row, you can use the expression `$customer->name`. In this example,
 * Active Record is providing an object-oriented interface for accessing data stored in the database. But Active
 * Record provides much more functionality than this.
 * To declare an ActiveRecord class you need to extend [[\yii\db\ActiveRecord]] and
 * implement the `tableName` method:
 * ```php
 * <?php
 * class Customer extends \yii\db\ActiveRecord
 * {
 *     public static function tableName()
 *     {
 *         return 'customer';
 *     }
 * }
 * ```
 * The `tableName` method only has to return the name of the database table associated with the class.
 * > Tip: You may also use the [Gii code generator](guide:start-gii) to generate ActiveRecord classes from your
 * > database tables.
 * Class instances are obtained in one of two ways:
 * * Using the `new` operator to create a new, empty object
 * * Using a method to fetch an existing record (or records) from the database
 * Below is an example showing some typical usage of ActiveRecord:
 * ```php
 * $user = new User();
 * $user->name = 'Qiang';
 * $user->save();  // a new row is inserted into user table
 * // the following will retrieve the user 'CeBe' from the database
 * $user = User::find()->where(['name' => 'CeBe'])->one();
 * // this will get related records from orders table when relation is defined
 * $orders = $user->orders;
 * ```
 * For more details and usage information on ActiveRecord, see the [guide article on
 * ActiveRecord](guide:db-active-record).
 * @method ActiveQuery hasMany($class, array $link) see [[BaseActiveRecord::hasMany()]] for more info
 * @method ActiveQuery hasOne($class, array $link) see [[BaseActiveRecord::hasOne()]] for more info
 * @author   Qiang Xue <qiang.xue@gmail.com>
 * @author   Carsten Brandt <mail@cebe.cc>
 * @property string $imageForBot curl classified image file
 * @since    2.0
 * @property [] $relations
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    private static $attachments_array = [];
    private static $temp = [];
    public $relations;
    public $hasLanguage = true;
//    public $image;

    /**
     * ?????????? ?????????? ?????? ???????? ???????? ?????? ???????? ?????? ?? ???? ?????????? ?????? ?????? ???? ???????? ?? ?????? ?????????? ?????? ???????? ?????????? ???? ???? ?????????????????? ??????????
     * @param          $val
     * @param  string  $id
     * @return mixed|string
     */
    public static function getVal($val, $id = '')
    {
        $id = (string) $id;
        if (!empty($_GET[$val])) {
            if (!empty($id) && is_array($_GET[$val])) {
                if (!is_bool(array_search((string) $id, $_GET[$val]))) {
                    return $_GET[$val];
                } else {
                    return '';
                }
            } else {
                return $_GET[$val];
            }
        } else {
            return '';
        }
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function saveImage($attr)
    {
        $old = $this->getOldAttributes();
        if (!isset($this->{$attr})) {
            return false;
        }
        $new = $this->{$attr};
        if (!empty($old[$attr]) && $old != $new) {
            $this->{$attr} = $old[$attr];
        }
        $className = (new \ReflectionClass($this))->getShortName();


        if (!empty($_FILES[$className]['tmp_name'][$attr])) {


            $fileName = Yii::$app->UploadManager->save($this, $attr);


            $model = clone $this;
            $model->image = $fileName;

            $model->save();
        }
//			return true;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $isnew = $this->isNewRecord;
        if (!$this->hasAttribute('language')) {

            if ($this->hasLanguage) {
                $mig = new Migration();

                $mig->addColumn($this::tableName(), 'language', $mig->integer());
                $mig->addColumn($this::tableName(), 'language_parent', $mig->integer());

                unset($mig);
            }
        }
        $out = parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
        if ($out) {
            Slug::update_post($this);
            $this->saveUploaded();

            $this->saveRelations();


            // < save language >
            if ($isnew) {
                $language = Language::find()->where(['default' => 1])->one();
                if ($this->hasAttribute('language')) {
                    if (empty($this->language)) {
                        $this->language = $language->id;
                    }
                } else {
                    if ($this->hasLanguage) {
                        $mig = new Migration();

                        $mig->addColumn($this::tableName(), 'language', $mig->integer());
                        $mig->addColumn($this::tableName(), 'language_parent', $mig->integer());
                        $this->language = $language->id;
                        unset($mig);
                    }
                }
                $this->save();
            }
            // </ save language >
            // < hash generator >
            {
                if ($this->hasAttribute('hash') && empty($this->hash)) {
                    $this->hash = hash('crc32', $this->{$this->attributes()[0]}.$this->{$this->attributes()[1]});
                    parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
                }
            }
            // </ hash generator >

        }

        return $out;
    }

    public function saveUploaded()
    {

        $languages = Yii::$app->Language->getLanguages();
        $cookie = Yii::$app->cookie->tmpFiles;
        if (!empty($cookie)) {
            $keys = [];
            foreach (ArrayHelper::toArray($cookie) as $key => $item) {

                if ($item['model'] == self::formName()) {
                    $keys[] = $key;
                    $extension = '';
                    if (!empty($item['fileExtension'])) {
                        $extension = $item['fileExtension'];
                    }
                    $path = Yii::$app->Options->UploadDir.'/tmp/'.Yii::$app->user->id.'/'.$item['model'].'/'.$item['fileName'].$extension;

                    if (is_file($path)) {
                        if (!realpath(Yii::$app->Options->UploadDir.'/dl/'.self::formName().'/')) {
                            mkdir(Yii::$app->Options->UploadDir.'/dl/'.self::formName().'/', 0777, true);
                        }
                        rename($path,
                            Yii::$app->Options->UploadDir.'/dl/'.self::formName().'/'.$item['fileName'].$extension);
                        $defaultLanguage = ArrayHelper::index($languages, 'default')[1];

                        // < Save Default Language Model >
                        {
                            $model = new GalleryMedias();
                            $model->file_name = $item['fileName'];
                            $model->file_size = $item['size'];
                            $model->table = (get_called_class())::tableName();

                            $model->table_id = $this->id;
                            $model->className = $item['model'];
                            $model->fieldName = $item['attr'];
                            $model->default = (ArrayHelper::toArray($cookie) == 1) ? 1 : 0;
                            $model->type = $this->fileTypes($item['fileExtension']);
                            $model->contentType = $item['type'];
                            $model->extension = $item['fileExtension'];
                            $model->language = $defaultLanguage->id;

                            if (!$model->save()) {
                                echo '<pre>';
                                var_dump($model->errors);
                                die();
                            } else {
                                $defaultModelLanguageId = $model->id;
                            }
                        }
                        // </ Save Default Language Model >

                        foreach (ArrayHelper::toArray($languages) as $lng) {
                            if (!empty($lng['default'])) {
                                continue;
                            }
                            $model = new GalleryMedias();
                            $model->file_name = $item['fileName'];
                            $model->file_size = $item['size'];
                            $model->className = $item['model'];
                            $model->fieldName = $item['attr'];
                            $model->extension = $item['fileExtension'];
                            $model->table = (get_called_class())::tableName();
                            $model->table_id = $this->id;
                            $model->type = $this->fileTypes($item['fileExtension']);
                            $model->contentType = $item['type'];
                            $model->language_parent = $defaultModelLanguageId;
                            $model->language = $lng['id'];
                            if (!$model->save()) {
                                echo '<pre>';
                                var_dump($model->errors);
                                die();
                            }

                        }
                    };

                }
            }


            $outArray = ArrayHelper::toArray($cookie);
            foreach ($keys as $item) {
                unset($outArray[$item]);
            }
            Yii::$app->cookie->tmpFiles = $outArray;
        }
        return true;
    }

    private function fileTypes($extension)
    {
        $extension = strtolower($extension);
        $type = json_decode(file_get_contents(__DIR__.'/mime.json'), true)[str_replace('.', '', $extension)];
        $type = explode('/', $type);
        return $type[0];
    }

    private function saveRelations()
    {
        if (empty(self::$temp['id'])) {
            self::$temp['id'] = $this->id;

        }
        $id = self::$temp['id'];
        // < Relations >
        {
            // < MetaData >
            {
                $relations = Yii::$app->cookie->relations;
                if (!empty($relations)) {
                    foreach ($relations as $key => $item) {
                        $table = $this::tableName();
                        if ($key == $table) {
                            foreach ($item as $attr => $val) {
                                /**
                                 *  [
                                 *   'attr' => $attribute,
                                 *   'model' => $targetDataModel::className(),
                                 *   'RelationModel' => $targetRelationModel,
                                 *   'multiple' => $multiple,
                                 *   'fk' => $targetRelationFK
                                 *  ]
                                 */
                                $model = $val['model'];
                                $RelationModel = $val['RelationModel'];
                                $fk = $val['fk'];
                                /**
                                 * @var [] $fk
                                 * @var ActiveRecord $model
                                 * @var ActiveRecord $RelationModel
                                 * @var string       $attr
                                 */
                                if ($val['multiple']) {
                                    $k = array_keys($fk)[0];
                                    $condition = [$k => $id];
                                    $dataRelation = $RelationModel::find()->where($condition)->all();
                                    if (!empty($dataRelation)) {
                                        foreach ($dataRelation as $r) {
                                            $r->delete();
                                        }
                                    }


                                    // < Save Relation Data >
                                    {
                                        if (!empty($_POST[$this::formName()]['relations'])) {
                                            foreach ($_POST[$this::formName()]['relations'][$val['attr']] as $q => $p) {

                                                foreach ((array) $p as $relVal) {
                                                    $dataRelation = new $RelationModel();
                                                    $dataRelation->{$k} = $this->id;
                                                    $dataRelation->{$fk[$k]} = $relVal;
                                                    $dataRelation->save();

                                                }

                                            }
                                        }
                                    }
                                    // </ Save Relation Data >


                                }
                            }
                        }
                    }
                }
            }
            // </ MetaData >
        }
        // </ Relations >
    }

    public function __get($name)
    {
        if ($name == 'hint') {
            return Hint::getHint($this::tableName(), $this->id);
        }
        return parent::__get($name); // TODO: Change the autogenerated stub
    }

    public function saveVideo($attr)
    {
        $old = $this->getOldAttributes();
        $new = $this->{$attr};
        if (!empty($old[$attr]) && $old != $new) {
            $this->{$attr} = $old[$attr];
        }
        $className = (new \ReflectionClass($this))->getShortName();


        if (!empty($_FILES[$className]['tmp_name'][$attr])) {


            $fileName = Yii::$app->UploadManager->save($this, $attr);


            $model = clone $this;
            $model->video = $fileName;

            $model->save();
        }
//			return true;
    }

    /**
     * ???? ?????????? ???? ???????? ?????????? ???? ???????? ?????????? ???????????? ???????? ???? ???????????? ???????????? ?? ???? ?????? ?????????? ???? ?????????????? ???? ???????? ?????????????? ???? ?????????? ?????????? ???? ?????? ???????? ???????? ?????????? ???????? ???????? ???? ?????????????? ????????
     * @param $attribute
     */
    public function saveAttachments($attribute, $maxUploadLimit = 10, $modelClassSave = null)
    {
        if (!empty($_FILES)) {
            $imageCount = $this->defaultImageCount($attribute);
            $i = 1;

            $modelClass = $this->formName();
            if (empty($modelClassSave)) {
                $modelClassSave = $modelClass;
            }
            $languages = \Yii::$app->Language->getLanguages();
            $defaultLanguage = ArrayHelper::index($languages, 'default')[1];
            if (is_array($_FILES[$modelClass]['name'][$attribute])) {
                for ($index = 1; $index + $imageCount <= $maxUploadLimit; $index++) {
                    if (empty($_FILES[$modelClass]['name'][$attribute][($index - 1)])) {
                        break;
                    }
                    $fileExtension = explode('.', $_FILES[$modelClass]['name'][$attribute][($index - 1)]);
                    if (empty($fileExtension)) {
                        $fileExtension = '';
                    } else {
                        $fileExtension = '.'.$fileExtension[count($fileExtension) - 1];
                    }
                    $fileName = uniqid();
                    $path = \Yii::$app->Options->UploadDir.'/dl/'.$modelClassSave;

                    if (!realpath($path)) {
                        @mkdir($path, 0777, true);
                    }

                    move_uploaded_file($_FILES[$modelClass]['tmp_name'][$attribute][($index - 1)],
                        $path.'/'.$fileName.$fileExtension);


                    // < Save Default Language Model >
                    {
                        $gModel = new GalleryMedias();
                        $gModel->file_name = $fileName;
                        $gModel->file_size = $_FILES[$modelClass]['size'][$attribute][($index - 1)];
                        $gModel->table = $this::tableName();

                        $gModel->table_id = $this->id;
                        $gModel->className = $modelClassSave;
                        $gModel->fieldName = $attribute;
                        $gModel->default = 0;
                        $gModel->type = $this->fileTypes($fileExtension);
                        $gModel->contentType = $_FILES[$modelClass]['type'][$attribute][($index - 1)];
                        $gModel->extension = $fileExtension;
                        $gModel->language = $defaultLanguage->id;

                        if (!$gModel->save()) {
                            echo '<pre>';
                            var_dump($gModel->errors);
                            die();
                        }
                    }
                    // </ Save Default Language Model >
                }
            }

        }
    }

    /**
     * @param  ActiveRecord|string  $class  ?????? ???????????????? ??????????
     * @return null|GalleryMedias
     */
    public function defaultImageCount($fieldName = 'image', $class = null)
    {
        if (empty($class)) {
            $class = get_called_class();
        }
        if (!empty(self::$attachments_array['defaultImageCount'][$class][$this->id][$fieldName])) {
            return self::$attachments_array['defaultImageCount'][$class][$this->id][$fieldName];
        } else {

            self::$attachments_array['defaultImageCount'][$class][$this->id][$fieldName] = GalleryMedias::find()->where([
                'type'      => 'image',
                'language'  => Yii::$app->Language->currentID(),
                'table'     => ($class)::tableName(),
                'table_id'  => $this->id,
                'default'   => 1,
                'fieldName' => $fieldName
            ])->count();
            if (empty(self::$attachments_array['defaultImageCount'][$class][$this->id][$fieldName])) {
                self::$attachments_array['defaultImageCount'] [$class][$this->id][$fieldName] = GalleryMedias::find()->where([
                    'type'      => 'image',
                    'language'  => Yii::$app->Language->currentID(),
                    'table'     => ($class)::tableName(),
                    'table_id'  => $this->id,
                    'fieldName' => $fieldName
                ])->count();
            }

            return self::$attachments_array['defaultImageCount'][$class][$this->id][$fieldName];
        }
    }

    public function image_input_widget
    (
        $form,
        $card_caption,
        $ajax = false,
        $fileType = [
            'image',
            'video'
        ],
        $allowedFileExtensions = [],
        $fieldName = 'image',
        $maxCount = 1
    ) {

        ?>

        <div class="row" style="margin-top: 20px">
            <div class="card card-nav-tabs pic-card">
                <div class="card-body ">
                    <h4 class="text-center"><?= $card_caption ?></h4>

                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <?php
                            if (empty($allowedFileExtensions)) {
                                $allowedFileExtensions = Yii::$app->UploadManager->mimeToExtensions($fileType);
                            }

                            // < Dynamic Model  >
                            {
                                $dmodel = new DynamicModel();
                                $dmodel->defineAttribute($fieldName);
                                $dmodel->defineAttribute('id');
                                $dmodel->id = $this->id;
                                $dmodel->formName = $this->formName();
                                $dmodel->formName();
                                $dmodel::$tableName = $this::tableName();

                            }
                            // </ Dynamic Model  >


                            $fileType = implode('/*,', $fileType).'/*';

                            echo MediaViewWidget::widget([
                                'model'     => $dmodel,
                                'attribute' => $fieldName
                            ]);
                            echo $form->field($dmodel, $fieldName)->widget(
                                \YiiMan\YiiBasics\modules\gallery\widgets\FileInput::className(),
                                [
                                    'sortThumbs'    => true,
                                    'purifyHtml'    => true,
                                    'options'       => [
                                        'accept'   => $fileType,
                                        'multiple' => $maxCount > 1,
                                    ],
                                    'language'      => strtolower(Yii::$app->Language->currentLanguageObject()->shortCode),
                                    'pluginOptions' =>
                                        [
                                            'uploadUrl'             => '//'.$_SERVER['HTTP_HOST'].'/'.YII_ADMIN_FOLDER.'/gallery/gallery-medias/upload?maxcount='.$maxCount.'&id='.(!empty($this->id) ? $this->id : 0),
                                            'previewFileType'       => 'image',
                                            'allowedFileExtensions' => $allowedFileExtensions,
                                            'showUpload'            => $ajax,
                                            'overwriteInitial'      => true,
                                            'showCaption'           => false,
                                            'maxFileCount'          => $maxCount,
                                            'showRemove'            => true,
                                            'showPreview'           => true,
                                            'browseLabel'           => ' ',
                                            'removeLabel'           => ' ',
                                            'elCaptionText'         => '#caption-photo1',
                                        ],
                                ]
                            )->label(false);

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function video_input_widget($form, $card_caption)
    {

        ?>

        <div class="row" style="margin-top: 20px">
            <div class="card card-nav-tabs">
                <div class="card-body ">
                    <h4 class="text-center"><?= $card_caption ?></h4>

                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <?php


                            if (!empty($this->video)) {
                                echo MediaViewWidget::widget([
                                    'model'     => $this,
                                    'attribute' => 'video'
                                ])
                                ?>

                                <?php
                            }

                            echo $form->field($this, 'video')->widget(
                                FileInput::className(),
                                [
                                    'options'       => [
                                        'accept'   => 'video/*',
                                        'multiple' => false,
                                    ],
                                    'pluginOptions' =>
                                        [
//													'uploadUrl'             => 'http://bot.' . $_SERVER['HTTP_HOST'] . '/admin123456adminadmin/easychap/front/default/upload' ,
                                            'previewFileType'       => 'video',
                                            'allowedFileExtensions' =>
                                                [
                                                    'avi',
                                                    'mpeg',
                                                    'mpeg4',
                                                    '3gp',
                                                    '3gpp',
                                                    'mp4'
                                                ],
                                            'showUpload'            => false,
                                            'overwriteInitial'      => true,
                                            'showCaption'           => false,
                                            'showRemove'            => true,
                                            'showPreview'           => true,
                                            'browseLabel'           => ' ',
                                            'removeLabel'           => ' ',
                                            'elCaptionText'         => '#caption-video1',
                                        ],
                                ]
                            );

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * @param  int  $mode  1 => all days , 2 => this day
     * @return int
     */
    public function getHintCount($mode = 1)
    {
        if (class_exists('YiiMan\YiiBasics\modules\hint\models\hint')) {

            $conditions = [];
            $conditions['table'] = $this::tableName();
            $conditions['table_id'] = $this->id;
            switch ($mode) {
                case 2:
                    $conditions['date'] = date('Y-m-d');
                    break;
            }
            return Hint::find()->where($conditions)->count();
        } else {
            return 0;
        }

    }

    public function delete()
    {

        $media = GalleryMedias::find()->where([
            'table_id' => $this->id,
            'table'    => (get_called_class())::tableName()
        ])->all();
        if (!empty($media)) {
            foreach ($media as $item) {
                /**
                 * @var $item GalleryMedias
                 */
                @unlink(Yii::$app->Options->UploadDir.'/dl/'.self::formName().'/'.$item->file_name.$item->extension);
            }
        }

        Slug::deleteSlug($this);

        $languages = self::find()->where(['language_parent' => $this->id])->all();
        if (!empty($languages)) {
            foreach ($languages as $language) {
                $language->delete();
            }
        }
        return parent::delete(); // TODO: Change the autogenerated stub
    }

    public function getImageForBot($cls = null)
    {
        if (!empty($this->image)) {
            $className = (new \ReflectionClass($this))->getShortName();
            $uploadFolder = realpath(realpath(YII_PUBLIC_HTML_DIR)).'/upload/'.$className.'/'.$this->id;

            if (empty($uploadFolder)) {
                @mkdir($uploadFolder);
                $uploadFolder = realpath(
                        realpath(YII_PUBLIC_HTML_DIR)
                    ).'/upload/'.$className.'/'.$this->id;
            }
            $file = realpath($uploadFolder.'/'.$this->image);

            if ($file) {
                return new CURLFile($file);
            }
        }

        return null;
    }

    /**
     * ?????? ?? ???????? ?????? ?????? ?????? ???? ???????? ?????????? ?????? ???? ????????????????????
     * @param $type
     * @param $classname ActiveRecord
     * @return null|GalleryMedias[]
     */
    public function loadAttachments($type, $fieldName = 'image', $classname = '')
    {
        if (!empty($classname)) {
            $classname = $classname::className();
        } else {
            $classname = get_called_class();
        }
        if (!empty(self::$attachments_array[$type][$classname][$this->id][$fieldName])) {
            return self::$attachments_array[$type][$classname][$this->id][$fieldName];
        } else {

            self::$attachments_array[$type][$classname] [$this->id][$fieldName] = GalleryMedias::find()->where([
                'type'      => $type,
                'language'  => Yii::$app->Language->currentID(),
                'table'     => ($classname)::tableName(),
                'table_id'  => $this->id,
                'fieldName' => $fieldName
            ])->all();
            return self::$attachments_array[$type][$classname][$this->id][$fieldName];
        }
    }

    public function getdefaultImageLink($size = '')
    {
        if (!empty($size)) {
            return
                !empty
                (
                $this->loadDefaultImage()
                ) ?
                    Yii::$app->UploadManager->getFit
                    ('dl/'.$this->formName(),
                        $this->loadDefaultImage()->file_name.$this->loadDefaultImage()->extension,
                        $size
                    ) :
                    Yii::$app->UploadManager->getFit
                    ('dl/'.$this->formName(),
                        'defaultImage.jpg',
                        $size
                    );
        } else {
            if (!empty($this->loadDefaultImage())) {
                return Yii::$app->Options->UploadUrl.'/dl/'.$this->formName().'/'.$this->loadDefaultImage()->file_name.$this->loadDefaultImage()->extension;
            } else {
                return '';
            }
        }

    }

    /**
     * @return null|GalleryMedias
     */
    public function loadDefaultImage($fieldName = 'image')
    {

        if (!empty(self::$attachments_array['defaultImage'][get_called_class()][$this->id][$fieldName])) {
            return self::$attachments_array['defaultImage'][get_called_class()][$this->id][$fieldName];
        } else {

            self::$attachments_array['defaultImage'][get_called_class()][$this->id][$fieldName] = GalleryMedias::find()->where([
                'type'      => 'image',
                'language'  => Yii::$app->Language->currentID(),
                'table'     => (get_called_class())::tableName(),
                'table_id'  => $this->id,
                'default'   => 1,
                'fieldName' => $fieldName
            ])->one();
            if (empty(self::$attachments_array['defaultImage'][get_called_class()][$this->id][$fieldName])) {
                self::$attachments_array['defaultImage'] [get_called_class()][$this->id][$fieldName] = GalleryMedias::find()->where([
                    'type'      => 'image',
                    'language'  => Yii::$app->Language->currentID(),
                    'table'     => (get_called_class())::tableName(),
                    'table_id'  => $this->id,
                    'fieldName' => $fieldName
                ])->one();
            }

            return self::$attachments_array['defaultImage'][get_called_class()][$this->id][$fieldName];
        }
    }

    public function getdefaultImageLinks($size = '', $attribute = 'image', $class = null)
    {

        $out = [];
        if (!empty($size)) {
            if (!empty($this->loadDefaultImages($attribute, $class = null))) {
                foreach ($this->loadDefaultImages($attribute, $class = null) as $img) {
                    if (empty($class)) {
                        $class = get_called_class();
                    }
                    $className = (new $class)->formName();
                    $out[] = Yii::$app->UploadManager->getFit
                    ('dl/'.$className,
                        $img->file_name.$img->extension,
                        $size
                    );
                }
            }
        } else {
            if (!empty($this->loadDefaultImages())) {
                foreach ($this->loadDefaultImages() as $img) {
                    $out[] = Yii::$app->Options->UploadUrl.'/dl/'.$this->formName().'/'.$img->file_name.$img->extension;
                }
            }
        }
        return $out;
    }

    /**
     * @param  ActiveRecord|null  $classname  ?????? ???????? ?? ???????? ???????????????? ??????????
     * @param  string             $fieldName  ?????? ???????? ???????????????? ????????????
     * @return null|GalleryMedias
     */
    public function loadDefaultImages($fieldName = 'image', $classname = null)
    {
        if (!empty($classname)) {
            $class = $classname;
        } else {
            $class = get_called_class();
        }
        if (!empty(self::$attachments_array['defaultImages'][$class][$this->id][$fieldName])) {
            return self::$attachments_array['defaultImages'][$class][$this->id][$fieldName];
        } else {

            self::$attachments_array['defaultImages'][$class][$this->id][$fieldName] = GalleryMedias::find()->where([
                'type'      => 'image',
                'language'  => Yii::$app->Language->currentID(),
                'table'     => ($class)::tableName(),
                'table_id'  => $this->id,
                'default'   => 1,
                'fieldName' => $fieldName
            ])->all();
            if (empty(self::$attachments_array['defaultImages'][$class][$this->id][$fieldName])) {
                self::$attachments_array['defaultImages'] [$class][$this->id][$fieldName] = GalleryMedias::find()->where([
                    'type'      => 'image',
                    'language'  => Yii::$app->Language->currentID(),
                    'table'     => ($class)::tableName(),
                    'table_id'  => $this->id,
                    'fieldName' => $fieldName
                ])->all();
            }

            return self::$attachments_array['defaultImages'][$class][$this->id][$fieldName];
        }
    }

    /**
     * ???? ???????? ???? ?????? ???????? ???????? ?????????? ???????????? ???? ???? ???????? ?????????? ?????????????? ???? ??????????????
     * @param $form
     * @param $attribute
     * @param $targetModel
     * @throws \Exception
     */
    public function relationField(
        $form,
        $attribute,
        $targetDataModel,
        $targetRelationModel = '',
        $targetRelationFK = '',
        $label = '',
        $multiple = false
    ) {
        $config = [];
        /**
         * @var $form            ActiveForm
         * @var $targetDataModel ActiveRecord
         * @var $modelc          ActiveRecord
         * @var $model           ActiveRecord
         */
        $modelc = new $targetDataModel();
        if ($modelc->hasAttribute('status')) {
            $model = $targetDataModel::find()->where(['status' => 1])->all();
        } else {
            $model = $targetDataModel::find()->all();
        }

        if (empty($model)) {
            $model = [];
        }

        // < Options >
        {
            if ($multiple) {
                $config['options'] =
                    [
                        'multiple'    => true,
                        'dir'         => Layout::run(),
                        'placeholder' => Yii::t('app', '???????????? ????????')
                    ];
                $config['pluginOptions'] =
                    [
                        'allowClear' => true
                    ];
            } else {
                $config['options'] =
                    [
                        'dir'         => Layout::run(),
                        'placeholder' => Yii::t('app', '???????????? ????????')
                    ];
            }
        }


        // </ Options >
        switch (true) {
            case $modelc->hasAttribute('title'):
                $config['data'] = ArrayHelper::map($model, 'id', 'title');
                break;
            case $modelc->hasAttribute('name'):
                $config['data'] = ArrayHelper::map($model, 'id', 'name');
                break;
        }

        if (empty($config['data'])) {
            $config['data'] = [];
        }

        // < relations in cookie >
        {
            $relations = Yii::$app->cookie->relations;
            $rel =
                [
                    'attr'          => $attribute,
                    'model'         => $targetDataModel::className(),
                    'RelationModel' => $targetRelationModel ? $targetRelationModel::className() : $targetRelationModel,
                    'multiple'      => $multiple,
                    'fk'            => $targetRelationFK
                ];

            // < MetaData >
            {
                Yii::$app->MetaLib->set('relation['.hash('crc32', $this::className()).']['.$attribute.']', $rel, 1,
                    true);
            }
            // </ MetaData >
            if (!empty($relations)) {
                $relations[$this::tableName()][$attribute] = $rel;
            } else {
                $relations = [];
                $relations[$this::tableName()][$attribute] = $rel;
            }

            Yii::$app->cookie->relations = $relations;
        }
        // </ relations in cookie >

        if (!empty($config['data'])) {

            // < Load Data >
            {
                /**
                 * @var ActiveRecord $targetRelationModel
                 */
                if ($multiple) {
                    $key = array_keys($targetRelationFK)[0];
                    $dataModel = $targetRelationModel::find()
                        ->select([$targetRelationFK[$key]])
                        ->where([$key => $this->id])
                        ->asArray()
                        ->all();
                    if (!empty($dataModel)) {
                        $dataModel = ArrayHelper::getColumn($dataModel, $targetRelationFK[$key]);
                        $this->relations[$attribute] = $dataModel;
                    }
                } else {

                    $data = $targetDataModel::find()
                        ->where(['id' => $this->{$attribute}])
                        ->asArray()
                        ->one();
//                    if (!empty($data)){
//                        $data=ArrayHelper::getColumn($data,'id');
//
//                    }

                }
            }
            // </ Load Data >


            if ($multiple) {
                $formAttribute = 'relations['.$attribute.']';
            } else {
                $formAttribute = $attribute;
            }

            echo $form
                ->field($this, $formAttribute)
                ->widget(Select2::className(), $config)->label($label);
        } else {
            echo '<p>???????? ?????? '.$this::className().' ???? ???? ?????????????? ???? ????????</p>';
        }


    }

    public function init()
    {

        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * ???? ???????? ???? ?????? ???? ???????? ?????? ?????????? ?????????? ???????? ???????? ?????? ???????????? ?????????? ???????????? ???? ???? ???????? ?????????? ?????????????? ???? ??????????????
     * @param                $form
     * @param  string        $attribute
     * @param  ActiveRecord  $targetModel
     * @param  ActiveRecord  $targetDataModel
     * @param  ActiveRecord  $targetRelationFKModel
     * @param  ActiveRecord  $targetRelationModel
     * @param  array         $targetRelationFK
     * @param  bool          $multiple
     * @param  string        $label
     * @throws \Exception
     */
    public function relationFieldTreeCheckBox(
        $form,
        string $attribute,
        string $targetDataModel,
        string $targetRelationFKModel = null,
        array $targetRelationFK = [],
        string $label = "",
        bool $multiple = false
    ) {
        $config = [];
        /**
         * @var $form            ActiveForm
         * @var $targetDataModel ActiveRecord
         * @var $modelc          ActiveRecord
         * @var $model           ActiveRecord
         */
        $modelc = new $targetDataModel();
        if ($modelc->hasAttribute('status')) {
            $model = $targetDataModel::find()->asArray()->where(['status' => 1])->all();
        } else {
            $model = $targetDataModel::find()->asArray()->all();
        }

        if (empty($model)) {
            $model = [];
        }

        // < Options >
        {
            if ($multiple) {
                $config['options'] =
                    [
                        'multiple'    => true,
                        'dir'         => Layout::run(),
                        'placeholder' => Yii::t('app', '???????????? ????????')
                    ];
                $config['pluginOptions'] =
                    [
                        'allowClear' => true
                    ];
            } else {
                $config['options'] =
                    [
                        'dir'         => Layout::run(),
                        'placeholder' => Yii::t('app', '???????????? ????????')
                    ];
            }
        }

        if ($modelc->hasAttribute('title')) {
            $config['titleAttribute'] = 'title';
        }
        if ($modelc->hasAttribute('name')) {
            $config['titleAttribute'] = 'name';
        }


        // </ Options >
        $config['data'] = $model;


        if (empty($config['data'])) {
            $config['data'] = [];
        }

        // < relations in cookie >
        {
            $relations = Yii::$app->cookie->relations;
            $rel =
                [
                    'attr'          => $attribute,
                    'model'         => $targetDataModel::className(),
                    'RelationModel' => $targetRelationFKModel ? $targetRelationFKModel::className() : $targetRelationFKModel,
                    'multiple'      => $multiple,
                    'fk'            => $targetRelationFK
                ];

            // < MetaData >
            {
                Yii::$app->MetaLib->set('relation['.hash('crc32', $this::className()).']['.$attribute.']', $rel, 1,
                    true);

            }
            // </ MetaData >


            if (!empty($relations)) {
                $relations[$this::tableName()][$attribute] = $rel;
            } else {
                $relations = [];
                $relations[$this::tableName()][$attribute] = $rel;
            }


            Yii::$app->cookie->relations = $relations;

        }
        // </ relations in cookie >

        if (!empty($config['data'])) {

            // < Load Data >
            {
                /**
                 * @var ActiveRecord $targetRelationFKModel
                 */
                if ($multiple) {
                    $key = array_keys($targetRelationFK)[0];
                    $dataModel = $targetRelationFKModel::find()
                        ->select([$targetRelationFK[$key]])
                        ->where([$key => $this->id])
                        ->asArray()
                        ->all();
                    if (!empty($dataModel)) {
                        $dataModel = ArrayHelper::getColumn($dataModel, $targetRelationFK[$key]);
                        $this->relations[$attribute] = $dataModel;
                    }
                } else {

                    $data = $targetDataModel::find()
                        ->where(['id' => $this->{$attribute}])
                        ->asArray()
                        ->one();
//                    if (!empty($data)){
//                        $data=ArrayHelper::getColumn($data,'id');
//
//                    }

                }
            }
            // </ Load Data >


            if ($multiple) {
                $formAttribute = 'relations['.$attribute.']';
            } else {
                $formAttribute = $attribute;
            }

            echo $form
                ->field($this, $formAttribute)
                ->widget(TreeSelectorWidget::className(), $config)->label($label);
        } else {
            echo '<p>???????? ?????? '.$this::className().' ???? ???? ?????????????? ???? ????????</p>';
        }


    }

    /**
     * ???? ?????????? ???? ???????? ???????????? ?????? ???? ???????? ???????? ???????? ?????????? ?????????? ?????????? ???????? ???? ?????? ???????? ???????? ???????????? ?????????? ???? ???????? ?????? ?????????????? ????????
     * @param [] $classes [FKModel,ArticleModel]  ?????? ???????????? ???? ?????? ??????
     * @param [] $fk [category=>article] ???????? ?????? ?????? ???? ???????? ?????? ???? ?????? ??????
     * @return null|ActiveRecord[]
     */
    public function relationCustomFKMany($classes, $fk)
    {
        $fkModel = array_keys($classes)[0]::find()
            ->select([array_values($fk)[0]])
            ->where([array_keys($fk)[0] => $this->id])
            ->all();
        if (!empty($fkModel)) {
            $fkModel = ArrayHelper::getColumn($fkModel, array_values($fk)[0]);
            return array_values($classes)[0]::find()
                ->where(['id' => $fkModel])
                ->all();
        }
    }

    /**
     * ???? ?????????? ???? ???????? ???????????? ?????? ???? ???????? ???????? ???????? ?????????? ?????????? ?????????? ???????? ???? ?????? ???????? ???????? ???????????? ?????????? ???? ???????? ?????? ?????????????? ????????
     * @param [] $classes [FKModel,ArticleModel]  ?????? ???????????? ???? ?????? ??????
     * @param [] $fk [category=>article] ???????? ?????? ?????? ???? ???????? ?????? ???? ?????? ??????
     * @return null|ActiveRecord
     */
    public function relationCustomFKOne($classes, $fk)
    {
        $fkModel = array_keys($classes)[0]::find()
            ->select([array_values($fk)[0]])
            ->where([array_keys($fk)[0] => $this->id])
            ->one();
        if (!empty($fkModel)) {

            return array_values($classes)[0]::find()
                ->where(['id' => $fkModel->{array_values($fk)[0]}])
                ->one();
        }
    }

    /**
     * ?????????????? ???????????????? ???????? ???? ?????? ?????? ???? ??????????????????????
     * @param  string  $attribute  ?????? ?????????? ??????????
     * @return ActiveRecord[]|ActiveRecord ???? ?????? ???? ???????????? ??????
     */
    public function relations($attribute)
    {
        // < Load Data >
        {
            $rModel = Yii::$app->MetaLib->get('relation['.hash('crc32', $this::className()).']['.$attribute.']', 1);
            if (empty($rModel)) {
                return [];
            }
            $rModel = $rModel->content;


            /**
             *   [
             *     'attr' => $attribute,
             *     'model' => $targetDataModel::className(),
             *     'RelationModel' => $targetRelationModel::className(),
             *     'multiple' => $multiple,
             *     'fk' => $targetRelationFK
             *   ];
             */
            if ($rModel->multiple) {
                $fk = (array) $rModel->fk;
                $key = array_keys($fk)[0];
                $keys = $rModel->RelationModel::find()
                    ->select([$fk[$key]])
                    ->where([$key => $this->id])
                    ->asArray()
                    ->all();
                $dataModel = ArrayHelper::getColumn($keys, $fk[$key]);
                return $rModel->model::find()
                    ->where(['id' => $dataModel])
                    ->all();
            } else {
                return $rModel->RelationModel::find()
                    ->where(['id' => $this->{$rModel->attr}])
                    ->one();
            }
        }
        // </ Load Data >
    }

}
