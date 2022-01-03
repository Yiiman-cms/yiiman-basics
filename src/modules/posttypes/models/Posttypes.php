<?php

namespace YiiMan\YiiBasics\modules\posttypes\models;

use kartik\select2\Select2;
use phpDocumentor\Reflection\Types\This;
use YiiMan\YiiBasics\widgets\fontAwesomePicker\FontAwesomeFontPickerWidget;
use YiiMan\YiiBasics\widgets\multiRowInput\MultipleInput;
use YiiMan\YiiBasics\widgets\multiRowInput\MultipleInputColumn;
use Yii;
use \YiiMan\YiiBasics\modules\posttypesfields\models\PosttypesFields;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use function GuzzleHttp\Promise\all;
use function GuzzleHttp\Promise\queue;

/**
 * This is the model class for table "{{%module_posttypes}}".
 *
 * @property int $id
 * @property string $title
 * @property int $language
 * @property int $language_parent
 * @property string $postType
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $hash
 * @property string $content
 * @property array $fields
 * @property PosttypesFk $posttype0
 * @property PosttypesFk $posttypes0
 *
 * @property \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields[] $posttypesFields
 */
class Posttypes extends \YiiMan\YiiBasics\lib\ActiveRecord
{
    public $fields = [];

    private static $Configs = [];
    private static $ConfigsCalculated = [];
    const STATUS_ACTIVE = 1;
    const STATUS_DE_ACTIVE = 0;


    const  INPUT_TEXT = 'textInput';
    const  INPUT_MASKED_TEXT = 'maskedText';
    const  INPUT_TEXTAREA = 'textarea';
    const  INPUT_SELECT = 'dropDownList';
    const  INPUT_MULTI_SELECT = 3;
    const  INPUT_CHECKBOX = 'checkboxList';
    const  INPUT_RADIO = 'radioList';
    const  INPUT_DATE = 'date';
    const  INPUT_FROALA = 'froala';
    const  INPUT_REDACTOR = 'redactor';
    const  INPUT_IMAGE_SINGLE = 'images';
    const  INPUT_MULTIPLE = 6;
    const  INPUT_NUMBER = 'number';
    const  INPUT_FONTAWESOME_ICON = 'iconFA';
    const  INPUT_RELATION_SINGLE = 'relationS';
    const  INPUT_CARD = 'card';
    const  INPUT_H = 'h';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_posttypes}}';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'postType', 'status', 'created_at', 'created_by'], 'required'],
            [['language', 'language_parent', 'status'], 'integer'],
            [['created_at', 'updated_at', 'hash'], 'safe'],
            [['content'], 'string'],
            ['fields', 'safe'],
            [['title', 'postType', 'created_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $configs = self::getConfigs(true);
        $labels = [];
        if (!empty($configs[$_GET['posttype']])) {
            foreach ($configs[$_GET['posttype']] as $name => $config) {
                if (!empty($config['label'])) {
                    $labels['fields[' . $name . ']'] = $config['label'];
                }
            }

        }
        $out = [
            'id' => Yii::t('posttypes', 'ID'),
            'title' => self::getConfigs()['items'][$_GET['posttype']]['labels']['title'],
            'language' => Yii::t('posttypes', 'Language'),
            'language_parent' => Yii::t('posttypes', 'Language Parent'),
            'postType' => Yii::t('posttypes', 'Post Type'),
            'status' => Yii::t('posttypes', 'وضعیت انتشار'),
            'created_at' => Yii::t('posttypes', 'Created At'),
            'updated_at' => Yii::t('posttypes', 'Updated At'),
            'created_by' => Yii::t('posttypes', 'Created By'),
            'content' => Yii::t('posttypes', 'Content'),
        ];
        $out = array_merge($out, $labels);
        return $out;
    }

    /**
     * فیلد های ثبت شده برای یک پست خاص را برمیگرداند
     * @return array
     */
    public function getPosttypesFields($force = false)
    {
        if (
            empty(self::$data_loaded[$this->id]['fields']) ||
            (
                !empty(self::$data_loaded[$this->id]['fields']) && self::$data_loaded[$this->id]['mode'] == 'one' && self::$data_loaded[$this->id]['model']['id'] != $this->id
            ) ||
            $force
        ) {
            $data = \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields::find()
                ->select(['fieldName', 'content'])
                ->where(['posttype' => $this->id])
                ->asArray()
                ->all();
            if (!empty($data)) {
                self::$data_loaded[$this->id]['fields'] = $data;
                self::$data_loaded[$this->id]['fields'] = ArrayHelper::index(self::$data_loaded[$this->id]['fields'], null, 'fieldName');
            }
        }


        return self::$data_loaded[$this->id]['fields'];
    }


    /**
     * اتصالات ثبت شده برای یک پست را بازگردانی میکند
     * @param bool $force
     * @return array
     */
    public function getPosttypesRelations($force = false)
    {
        // < load Relations >
        {
            $id = $this->id;
            if (!empty(self::$data_loaded[$this->id]['relations']) && $force == false) {
                return self::$data_loaded[$this->id]['relations'];
            } else {
                self::$data_loaded[$this->id]['relations'] = [];

                $relations = PosttypesFk::find()->select(['posttype_to', 'posttype_type_to'])->where(['posttype_from' => $this->id])->asArray()->all();
                if (!empty($relations)) {
                    $relations = ArrayHelper::index($relations, null, 'posttype_type_to');
                    self::$data_loaded[$this->id]['relations'] = $relations;
                }
                return self::$data_loaded[$this->id]['relations'];
            }
        }
        // </ load Relations >
    }

    /**
     * اتصالات ثبت شده برای یک پست را بازگردانی میکند
     * @param bool $force
     * @return array
     */
    public function getPosttypesFieldsMultiple($force = false)
    {
        // < load Relations >
        {
            if (!empty(self::$data_loaded[$this->id]['multiple']) && $force == false) {
                return self::$data_loaded[$this->id]['multiple'];
            } else {
                self::$data_loaded[$this->id]['multiple'] = [];


                $outItem = [];
                $fieldModel = PosttypesMultiple::find()->where(['posttype_id' => $this->id])->all();
                if (!empty($fieldModel)) {
                    $configs = self::getConfigs(true);
                    $posttype = $this->postType;
                    foreach ($fieldModel as $item) {
                        /**
                         * @var $item PosttypesMultiple
                         */

                        switch ($item->type) {
                            case MultipleInputColumn::TYPE_HIDDEN_INPUT:
                            case MultipleInputColumn::TYPE_NUMBER_INPUT:
                            case MultipleInputColumn::TYPE_STATIC:
                            case MultipleInputColumn::TYPE_TEXT_INPUT:
                            case MultipleInputColumn::TYPE_CHECKBOX:
                            case MultipleInputColumn::TYPE_DROPDOWN:
                                if (!empty($configs[$posttype][$item->fieldName]['fields'][$item->key]['toModel'])) {
                                    $model = $configs[$posttype][$item->fieldName]['fields'][$item->key]['toModel'];
                                    if ($model == 'YiiMan\YiiBasics\modules\posttypes\models\Posttypes') {
                                        $outItem[$item->fieldName][$item->index][$item->key] = self::getPost('', $item->value);
                                    } else {
                                        $outItem[$item->fieldName][$item->index][$item->key] = $model::findOne($item->value);
                                    }
                                } else {
                                    $outItem[$item->fieldName][$item->index][$item->key] = $item->value;
                                }
                                break;
                            case MultipleInputColumn::TYPE_CHECKBOX_LIST:
                            case MultipleInputColumn::TYPE_RADIO_LIST:
                                $outItem[$item->fieldName][$item->index][$item->key] = [];
                                $fieldModelFields = PosttypesMultipleFields::find()->select(['key', 'value'])->where(['multiple_field_id' => $item->id])->asArray()->all();
                                if (!empty($fieldModelFields)) {
                                    $ar = [];
                                    foreach ($fieldModelFields as $fk => $fv) {
                                        $ar[$fk] = $fv;
                                    }
                                    $outItem[$item->fieldName][$item->index][$item->key] = $ar;
                                }
                                break;
                            default:
                                if (!empty($configs[$posttype][$item->fieldName]['fields'][$item->key]['toModel'])) {
                                    $model = $configs[$posttype][$item->fieldName]['fields'][$item->key]['toModel'];
                                    if ($model == 'YiiMan\YiiBasics\modules\posttypes\models\Posttypes') {
                                        $outItem[$item->fieldName][$item->index][$item->key] = self::getPost('', $item->value);
                                    } else {
                                        $outItem[$item->fieldName][$item->index][$item->key] = $model::findOne($item->value);
                                    }
                                } else {
                                    $outItem[$item->fieldName][$item->index][$item->key] = $item->value;
                                }

                        }
                        self::$data_loaded[$this->id]['multiple'][$item->fieldName] = $outItem;
                    }
                }
                $out = self::$data_loaded[$this->id]['multiple'];
                return $out;
            }
        }
        // </ load Relations >
    }


    /**
     * همه ی کانفیگ های مربوط به پست تایپ ها را بازگشت میدهد.
     * @param bool $calculated چنانچه مثبت باشد، فیلدهای عمیق مانند فیلدهایی که داخل کارت ها هستند را به صورت مسطح بازگردانی میکند.
     * @return array
     */
    public static function getConfigs($calculated = false)
    {
        if (!$calculated) {
            return self::$Configs;
        } else {
            if (!empty(self::$ConfigsCalculated)) {
                return self::$ConfigsCalculated;
            } else {
                foreach (self::$Configs['items'] as $pKey => $posttype) {
                    if (empty($posttype['fields'])){
                        self::$ConfigsCalculated[$pKey] = [];//YiiMan updated زمانی که پست تایپ هیچ فیلدی ندارد، این آپشن باید باشد تا هنگام برزرسانی خطا ایجاد نشود

                    }
                    foreach ($posttype['fields'] as $key => $config) {
                        if (
                            (
                                strstr($key, 'card-') && $config['type'] == Posttypes::INPUT_CARD
                            ) ||
                            (
                                strstr($key, 'sideCard-') && $config['type'] == Posttypes::INPUT_CARD
                            )

                        ) {
                            $card = [];
                            $items = '';
                            foreach ($config as $n => $c) {
                                if ($n == 'label') {
                                    continue;
                                }
                                if ($n == 'type') {
                                    continue;
                                }
                                if ($n == 'col') {
                                    continue;
                                }
                                if (strstr($n, 'h-')) {
                                    continue;
                                }
                                self::$ConfigsCalculated[$pKey][$n] = $c;
                            }

                        } else {
                            self::$ConfigsCalculated[$pKey][$key] = $config;
                        }
                    }
                }
                return self::$ConfigsCalculated;
            }
        }
    }

    /**
     * افزودن یک فیلد به پست تایپ
     * @param $fieldName
     * @param $content
     * @return bool
     */
    public function addField($fieldName, $content)
    {
        $model = new \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields();
        $model->posttype = $this->id;
        $model->fieldName = (string)$fieldName;
        $model->content = (string)$content;
        return $model->save();
    }

    /**
     * @param $array
     */
    public static function addConfigs($array)
    {
        self::$Configs = $array;
    }

    private static $data_loaded = [];

    /**
     * به صورت فورس اطلاعات را از بانک داده بازخوانی میکند و پارامتر مورد نظر را برمیگرداند
     * @param $name
     * @return array|string|Posttypes|Posttypes[]|PosttypesFk|null
     */
    public function get($name)
    {
        if (!empty($this->id)) {
            self::$data_loaded[$this->id]['model'] = $this;
            self::$data_loaded[$this->id]['mode'] = 'one';
            self::$data_loaded[$this->id]['fields'] = null;
            self::$data_loaded[$this->id]['model']->getPosttypesFields(true);
            self::$data_loaded[$this->id]['model']->getPosttypesRelations(true);
            self::$data_loaded[$this->id]['model']->getPosttypesFieldsMultiple(true);
        }
        return $this->{$name};
    }

    /**
     * @param string $name
     * @param bool $force
     * @return array|Posttypes|null|string
     */
    public function __get($name)
    {
        try {
            return parent::__get($name);
        } catch (\Exception $e) {
            $id = $this->id;


            if (empty(self::$data_loaded[$this->id])) {
                if (!empty($this->id)) {
                    self::$data_loaded[$this->id]['model'] = $this;
                    self::$data_loaded[$this->id]['mode'] = 'one';
                    self::$data_loaded[$this->id]['fields'] = null;
                    self::$data_loaded[$this->id]['model']->getPosttypesFields();
                    self::$data_loaded[$this->id]['model']->getPosttypesRelations();
                    self::$data_loaded[$this->id]['model']->getPosttypesFieldsMultiple();
//                    if (!empty(self::$data_loaded[$this->id]['model'])) {
//                        return self::$data_loaded[$this->id]['model'];
//                    }
                } else {
                    return '';
                }
            }


            // < related With Model >
            {
                $modelNamePos = strpos($name, '0');
                $len = strlen($name);
                if ($modelNamePos && $modelNamePos == ($len - 1)) {
                    $name = substr($name, 0, $len - 1);

                    if (!empty(self::$data_loaded[$this->id]['fields'][$name])) {
                        $config = self::getConfigs(true)[$this->postType][$name];
                        switch ($config['type']) {
                            case Posttypes::INPUT_CHECKBOX:
                            case Posttypes::INPUT_MULTI_SELECT:
                                $ids = ArrayHelper::getColumn(self::$data_loaded[$this->id]['fields'][$name], 'content');
                                return self::getPosts($name, null, $ids);
                                break;
                        }
                    }
                }
            }
            // </ related With Model >

            if (!empty(self::$data_loaded[$this->id]['fields'][$name])) {
                $config = self::getConfigs(true)[$this->postType][$name];
                switch ($config['type']) {
                    case Posttypes::INPUT_CHECKBOX:
                    case Posttypes::INPUT_MULTI_SELECT:
                        return ArrayHelper::getColumn(self::$data_loaded[$this->id]['fields'][$name], 'content');
                        break;
                    case Posttypes::INPUT_SELECT:
                    case Posttypes::INPUT_RADIO:
                    case Posttypes::INPUT_NUMBER:
                    case Posttypes::INPUT_FONTAWESOME_ICON:
                    case Posttypes::INPUT_TEXT:
                    case Posttypes::INPUT_FROALA:
                    case Posttypes::INPUT_MASKED_TEXT:
                    case Posttypes::INPUT_TEXTAREA:
                        return self::$data_loaded[$this->id]['fields'][$name][0]['content'];
                        break;
                    case Posttypes::INPUT_RELATION_SINGLE:
                        $out = $this->getRelatedModel($name);
                        if (!empty($out)) {
                            return $out;
                        }
                        break;
                }
            }

            if (!empty(self::$data_loaded[$this->id]['relations'][$name])) {
                $config = self::getConfigs(true)[$this->postType][$name];
                if ($config['type'] == Posttypes::INPUT_RELATION_SINGLE) {
                    $out = $this->getRelatedModel($name);
                    return $out;
                }
            }

            if (!empty(self::$data_loaded[$this->id]['multiple'][$name])) {
                return self::$data_loaded[$this->id]['multiple'][$name][$name];
            }


        }
    }

    /**
     * دریافت مدل متصل
     * @param string $relationName_to
     * @param bool $justFK
     * @return null|Posttypes | PosttypesFk
     */
    public
    function getRelatedModel($relationName_to, $justFK = false)
    {
        $out = PosttypesFk::findOne(['posttype_type_from' => $this->postType, 'posttype_type_to' => $relationName_to, 'posttype_from' => $this->id]);
        if (!empty($out) && $justFK) {
            return $out;
        }

        if (!empty($out) && !empty($out->posttype_to0)) {

            return $out->posttype_to0;
        } else {
            if (!empty($out) && !empty($out->posttype_from0)) {

                return $out->posttype_from0;
            }
        }
    }

    /**
     * دریافت مدل های متصل
     * @param $relationName_to
     * @param bool $justFK
     * @param bool $invert اتصال را به صورت معکوس برررسی میکند
     * @return null|Posttypes[] | PosttypesFk[]
     */
    public
    function getRelatedModels($relationName_to, $justFK = false, $invert = false, $limit = null)
    {
        if ($invert) {
            $out = PosttypesFk::find()->where(['posttype_type_to' => $this->postType, 'posttype_type_from' => $relationName_to, 'posttype_to' => $this->id]);
        } else {
            $out = PosttypesFk::find()->where(['posttype_type_from' => $this->postType, 'posttype_type_to' => $relationName_to, 'posttype_from' => $this->id]);
        }

        if (!empty($limit)) {
            $out = $out->limit($limit);
        }
        $out = $out->all();


        if (!empty($out) && $justFK) {
            return $out;
        }
        if (!empty($out)) {
            $array = [];
            foreach ($out as $item) {
                /**
                 * @var $item PosttypesFk
                 */
                if ($invert) {

                    $array[] = $item->posttype_from0;
                } else {

                    $array[] = $item->posttype_to0;
                }
            }
            return $array;
        } else {
            if (!empty($out) && !empty($out->posttypes1)) {
                return $out->posttypes1;
            }
        }
    }

    /**
     * یک اتصال بین پست تایپی ایجاد میکند
     * @param $related_id
     * @param $related_posttype_type
     */
    public
    function addRelation($related_id, $related_posttype_type)
    {
        $fk = new PosttypesFk();

        $fk->posttype_from = $this->id;
        $fk->posttype_type_from = $this->postType;

        $fk->posttype_to = $related_id;
        $fk->posttype_type_to = $related_posttype_type;
        $fk->save();
    }

    /**
     * @param string $posttype
     * @param string $id
     * @return Posttypes|null
     */
    public static function getPost($posttype = '', $id = '')
    {
//        if
//        (
//            empty(self::$data_loaded[$this->id]['model']) ||
//            (
//                !empty(self::$data_loaded[$this->id]['model']) && !empty(self::$data_loaded[$this->id]['model']['id']) && self::$data_loaded[$this->id]['model']['id']!= $id
//            )
//        ) {
        $query = <<<SQL
select 
module_posttypes.id as id,
module_posttypes.title as title,
module_posttypes.language as language,
module_posttypes.language_parent as language_parent,
module_posttypes.postType as posttype,
module_posttypes.status as status,
module_posttypes.created_at as created_at,
module_posttypes.updated_at as updated_at,
module_posttypes.content as content,
module_posttypes_fields.fieldName as field_name,
module_posttypes_fields.content as field_ontent

from 
module_posttypes
 left join module_posttypes_fields on module_posttypes.id = module_posttypes_fields.posttype
 where module_posttypes.id={$id}
SQL;
//        $model = new Posttypes();
//        $data = Yii::$app->db->createCommand($query)->queryAll();


        self::$data_loaded[$id]['model'] = Posttypes::findOne(['id' => $id]);
        self::$data_loaded[$id]['mode'] = 'one';
        self::$data_loaded[$id]['fields'] = null;
        self::$data_loaded[$id]['model']->getPosttypesFields();
        self::$data_loaded[$id]['model']->getPosttypesRelations();
        self::$data_loaded[$id]['model']->getPosttypesFieldsMultiple();
        if (!empty(self::$data_loaded[$id]['model'])) {
            return self::$data_loaded[$id]['model'];
        }
//        }
    }

    /**
     * پست تایپ هایی را برمیگرداند که فیلد مشخص شده را دارا باشند
     *
     *
     * برای مثال زیرمجموعه ی یک دسته بندی
     *
     * @param string | int|array $posttype
     * @param $fieldName
     * @param string $fieldContent
     * @return array
     */
    public
    static function getPostTypeWithCheckedFields($posttype, $fieldName, $fieldContent = '',$justActived=false)
    {
        $postArray = [];
        if (!(is_int($posttype) || is_integer($posttype) || is_array($posttype))) {
            if ($justActived){
                $postConvertedIds = Posttypes::find()->select(['id'])->where(['postType' => $posttype])->asArray()->all();
            }else{
                $postConvertedIds = Posttypes::find()->select(['id'])->where(['postType' => $posttype,'status'=>Posttypes::STATUS_ACTIVE])->asArray()->all();
            }
            $postConvertedIds = ArrayHelper::getColumn($postConvertedIds, 'id');
        } else {
            $postConvertedIds = $posttype;
        }

        if (empty($fieldContent)) {
            $postModels = \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields::find()->select(['posttype'])->where(['fieldName' => $fieldName, 'posttype' => $postConvertedIds])->asArray()->all();
        } else {
            $postModels = \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields::find()->select(['posttype'])->where(['fieldName' => $fieldName, 'content' => $fieldContent, 'posttype' => $postConvertedIds])->asArray()->all();
        }
        $postIds = ArrayHelper::getColumn(ArrayHelper::index($postModels, 'posttype'), 'posttype');

        foreach ($postIds as $postId) {
            $postArray[] = Posttypes::getPost($posttype, $postId);
        }
        return $postArray;
    }

    /**
     * دریافت پست ها به صورت آرایه ی ایندکس شده ی دوبعدی برای سلکت باکس ها
     * @param $posttype
     * @param string $attr1
     * @param string $attr2
     * @return array
     */
    public
    static function getMappedPosts($posttype, $attr1 = 'id', $attr2 = 'title')
    {
        $posts = Posttypes::getPosts($posttype);
        if (!empty($posts)) {
            return ArrayHelper::map(ArrayHelper::toArray($posts), $attr1, $attr2);
        } else {
            return [];
        }
    }


    /**
     * @param $posttype
     * @param null $limit
     * @param array|object|null $ids
     * @return null|Posttypes[]
     */
    public
    static function getPosts($posttype = '', $limit = null, $ids = [])
    {
        if (empty($posttype) && empty($ids)) {
            return [];
        }
        if (empty($ids)) {
            $model = self::find()->where(['postType' => $posttype]);
        } else {

            if (empty($posttype)) {
                $model = self::find()->where(['id' => $ids]);
            } else {
                $model = self::find()->where(['postType' => $posttype, 'id' => $ids]);
            }
        }

        if (!empty($limit)) {
            $model = $model->limit($limit);
        }
        $model = $model->all();
        if (!empty($model)) {
            return $model;
        }
    }


    /**
     * @param $posttype
     * @param null $limit
     * @param array|object|null $ids
     * @return null|Posttypes[]
     */
    public
    static function getActivePosts($posttype = '', $limit = null, $ids = [])
    {
        if (empty($posttype) && empty($ids)) {
            return [];
        }
        if (empty($ids)) {
            $model = self::find()->where(['postType' => $posttype,'status'=>Posttypes::STATUS_ACTIVE]);
        } else {

            if (empty($posttype)) {
                $model = self::find()->where(['id' => $ids]);
            } else {
                $model = self::find()->where(['postType' => $posttype, 'id' => $ids]);
            }
        }

        if (!empty($limit)) {
            $model = $model->limit($limit);
        }
        $model = $model->all();
        if (!empty($model)) {
            return $model;
        }
    }




    /**
     * پست هایی را برمیگرداند که پست های متصل به خود داشته باشند
     *
     * برای مثال ، یک دسته بندی را اعلام کنید، این تابع فقط دسته هایی را برمیگرداند، که برای آنها داده ثبت شده باشد(پست هایی ثبت شده باشد که متثل به این دسته باشند)
     *
     *
     * @param $posttype
     * @return array|Posttypes[]|null
     */
    public
    static function get_posts_has_related_target_data($posttype)
    {
        $fields = \YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields::find()->select('content')->where(['fieldName' => $posttype])->all();
        if (!empty($fields)) {
            $posts = ArrayHelper::getColumn($fields, 'content');
            return self::getPosts($posttype, null, $posts);
        } else {
            return [];
        }
    }

    public
    static function render($model, $name, $column, $form, $type, &$multiples, &$cards, &$sideCard)
    {
        $out = '';
        /**
         * @var $model Posttypes
         * @var $form ActiveForm
         */
        // < card >
        {
            if (strstr($name, 'card-') && $type == Posttypes::INPUT_CARD) {
                $card = [];
                $items = '';
                foreach ($column as $n => $c) {
                    if ($n == 'label') {
                        if (!empty($c)) {
                            $card['label'] = $c;
                        }
                        continue;
                    }
                    if ($n == 'type') {
                        continue;
                    }
                    if ($n == 'col') {
                        if (!empty($c)) {
                            $card['col'] = $c;
                        }
                        continue;
                    }
                    if (strstr($n, 'h-')) {
                        $items .= '<div class="col-md-12">' . $c . '</div>';
                        continue;
                    }
                    $items .= self::render($model, $n, $c, $form, $c['type'], $multiples, $card, $sideCard);
                }
                $card['items'] = $items;
                $cards[] = $card;
                return;
            }

        }
        // </ card >

        // < Side Card >
        {
            if (strstr($name, 'sideCard-') && $type == Posttypes::INPUT_CARD) {
                $card = [];
                $items = '';
                foreach ($column as $n => $c) {
                    if ($n == 'label') {
                        $card['label'] = $c;
                        continue;
                    }
                    if ($n == 'type') {
                        continue;
                    }
                    if ($n == 'col') {
                        $card['col'] = $c;
                        continue;
                    }
                    if (strstr($n, 'h-')) {
                        $items .= '<div class="col-md-12">' . $c . '</div>';
                        continue;
                    }
                    $items .= self::render($model, $n, $c, $form, $c['type'], $multiples, $card, $sideCard);
                }
                $card['items'] = $items;
                $sideCard[] = $card;
                return;
            }
        }
        // </ Side Card >


        switch ($type) {
            case Posttypes::INPUT_CHECKBOX:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->checkboxList(is_callable($column['data']) ? $column['data']($model) : $column['data'])
                    ->label($column['label']);
                $out .= '</div>';

                break;
            case Posttypes::INPUT_FROALA:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->widget(\YiiMan\YiiBasics\widgets\floara\FroalaEditorWidget::className())
                    ->label($column['label']);
                $out .= '</div>';
                break;

            case Posttypes::INPUT_REDACTOR:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->widget(\YiiMan\YiiBasics\widgets\redactor\widgets\Redactor::className())
                    ->label($column['label']);

                $out .= '</div>';
                break;
            case Posttypes::INPUT_IMAGE_SINGLE:
                $out .= '<div class="col-md-' . $column['col'] . '">';

                $out .= $model->image_input_widget($form, $column['label'], true, ['image'], [], 'fields[' . $name . ']', 1, false);
                $out .= '</div>';
                break;


            case Posttypes::INPUT_MULTI_SELECT:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $options =
                    [
                        'multiple' => true,
                        'tag' => true,
                        'dir' => \YiiMan\YiiBasics\lib\i18n\Layout::run()
                    ];
                if (!empty($column['options'])) {
                    $options = ArrayHelper::merge($column['options'], $options);
                }
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->widget(Select2::className(),
                        [
                            'data' => is_callable($column['data']) ? $column['data']($model) : $column['data'],
                            'options' => $options
                        ]
                    )
                    ->label($column['label']);
                $out .= '</div>';
                break;
            case Posttypes::INPUT_MULTIPLE:
                $cellulars = [];

                foreach ($column['fields'] as $cellName => $cellData) {
                    $cellArray =
                        [
                            'name' => $cellName,
                            'type' => $cellData['type'],
                            'title' => $cellData['label'],
//                                                                'defaultValue' => 1,
                    ];
                    if (!empty($cellData['data'])) {
                        $cellArray['items'] = is_callable($cellData['data']) ? $cellData['data']($model) : $cellData['data'];
                    }

                    if (!empty($cellData['value'])) {
                        $cellArray['value'] = $cellData['value'];
                    }

                    if (!empty($cellData['enableError'])) {
                        $cellArray['enableError'] = $cellData['enableError'];
                    }

                    if (!empty($cellData['defaultValue'])) {
                        $cellArray['defaultValue'] = $cellData['defaultValue'];
                    }


                    if (is_object($cellData['type']) && get_class($cellData['type'])) {
                        foreach ($cellData as $n => $v) {
                            if (
                                $n == 'type' ||
                                $n == 'label' ||
                                $n == 'enableError' ||
                                $n == 'value' ||
                                $n == 'defaultValue'
                            ) {
                                continue;
                            }
                            $cellArray['options']['pluginOptions'][$n] = $v;
                        }
                    }
                    $cellulars[] = $cellArray;
                }

                $multipleArray = [];
                $fields = !empty($model->fields[$name]) ? $model->fields[$name] : [];
                $multipleArray['label'] = $column['label'];
                $multipleArray['field'] = $form->field($model, 'fields[' . $name . ']')->widget(
                    \YiiMan\YiiBasics\widgets\multiRowInput\MultipleInput::className(),
                    [
                        'max' => !empty($column['max']) ? $column['max'] : 10,
                        'min' => !empty($column['min']) ? $column['min'] : 1,
                        'sortable' => true,
                        'iconSource' => MultipleInput::ICONS_SOURCE_FONTAWESOME,
                        'data' => $fields,
                        'enableError' => true,
                        'cloneButton' => true,
                        'showGeneralError' => true,
                        'addButtonOptions' => [
                            'class' => 'btn btn-success add-btn',
                        ],
                        'removeButtonOptions' => [
                            'class' => 'btn btn-danger remove-btn',

                        ],
                        'columns' => $cellulars
                    ]
                )
                    ->label(false);
                $multiples[] = $multipleArray;
                break;
            case Posttypes::INPUT_FONTAWESOME_ICON:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->widget(FontAwesomeFontPickerWidget::className())
                    ->label($column['label']);

                $out .= '</div>';

                break;

            case Posttypes::INPUT_TEXT:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->input('text')
                    ->label($column['label']);
                $out .= '</div>';
                break;
            case Posttypes::INPUT_NUMBER:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->input('number')
                    ->label($column['label']);

                $out .= '</div>';

                break;

            case Posttypes::INPUT_MASKED_TEXT:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->widget(MaskedInput::className(), ['mask' => $column['mask'], 'options' => ['dir' => 'ltr']])
                    ->label($column['label']);
                $out .= '</div>';
                break;

            case Posttypes::INPUT_TEXTAREA:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->textarea(['rows' => 10])
                    ->label($column['label']);
                $out .= '</div>';
                break;
            case Posttypes::INPUT_RADIO:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->radioList($column['data'])
                    ->label($column['label']);

                $out .= '</div>';
                break;
            case Posttypes::INPUT_SELECT:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->widget(Select2::className(),
                        [
                            'data' => is_callable($column['data']) ? $column['data']($model) : $column['data'],
                            'options' =>
                                [
                                    'dir' => \YiiMan\YiiBasics\lib\i18n\Layout::run(),
                                    'allowClear' => true,
                                    'placeholder' => \Yii::t('site', 'انتخاب کنید')
                                ]
                        ]
                    )
                    ->label($column['label']);
                $out .= '</div>';
                break;
            case Posttypes::INPUT_RELATION_SINGLE:
                $out .= '<div class="col-md-' . $column['col'] . '">';
                $out .= $form
                    ->field($model, 'fields[' . $name . ']')
                    ->widget(Select2::className(),
                        [
                            'data' =>
                                !empty($model::getPosts($name)) ? ArrayHelper::map($model::getPosts($name), 'id', 'title') : [],
                            'options' =>
                                [
                                    'dir' => \YiiMan\YiiBasics\lib\i18n\Layout::run(),
                                    'allowClear' => true,
                                    'placeholder' => \Yii::t('site', 'انتخاب کنید')
                                ]
                        ]
                    )
                    ->label($column['label']);
                $out .= '</div>';

                break;

            case Posttypes::INPUT_H:
                $out .= '<div class="col-md-12"><h3>' . $column['label'] . '</h3></div>';

        }
        return $out;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public
    function getPosttype0()
    {
        return $this->hasOne(PosttypesFk::className(), ['id' => 'posttype']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public
    function getPosttypes0()
    {
        return $this->hasMany(PosttypesFk::className(), ['id' => 'posttype']);
    }

    public
    static function renderView($model, $name, $column, $type, &$multiples, &$cards, &$sideCard)
    {
        $fields = $model->fields;
        $out = '';
        /**
         * @var $model Posttypes
         * @var $form ActiveForm
         */
        // < card >
        {
            if (strstr($name, 'card-') && $type == Posttypes::INPUT_CARD) {
                $card = [];
                $items = '';
                foreach ($column as $n => $c) {
                    if ($n == 'label') {
                        if (!empty($c)) {
                            $card['label'] = $c;
                        }
                        continue;
                    }
                    if ($n == 'type') {
                        continue;
                    }
                    if ($n == 'col') {
                        if (!empty($c)) {
                            $card['col'] = $c;
                        }
                        continue;
                    }
                    if (strstr($n, 'h-')) {
                        $items .= '<div class="col-md-12">' . $c . '</div>';
                        continue;
                    }
                    $items .= self::renderView($model, $n, $c, $c['type'], $multiples, $card, $sideCard);
                }
                $card['items'] = $items;
                $cards[] = $card;
                return;
            }

        }
        // </ card >

        // < Side Card >
        {
            if (strstr($name, 'sideCard-') && $type == Posttypes::INPUT_CARD) {
                $card = [];
                $items = '';
                foreach ($column as $n => $c) {
                    if ($n == 'label') {
                        $card['label'] = $c;
                        continue;
                    }
                    if ($n == 'type') {
                        continue;
                    }
                    if ($n == 'col') {
                        $card['col'] = $c;
                        continue;
                    }
                    if (strstr($n, 'h-')) {
                        $items .= '<div class="col-md-12">' . $c . '</div>';
                        continue;
                    }
                    $items .= self::renderView($model, $n, $c, $c['type'], $multiples, $card, $sideCard);
                }
                $card['items'] = $items;
                $sideCard[] = $card;
                return;
            }
        }
        // </ Side Card >


        switch ($type) {
            case Posttypes::INPUT_CHECKBOX:
            case Posttypes::INPUT_SELECT:
            case Posttypes::INPUT_RADIO:
                if (!empty($fields[$name])) {
                    $out .= '<li class="view-li">';
                    $out .= $column['label'] . ' : <span style="color: green">فعال</span>';
                    $out .= '</li>';
                } else {
                    $out .= '<li class="view-li">';
                    $out .= $column['label'] . ' : <span style="color: red">غیر فعال</span>';
                    $out .= '</li>';
                }
                break;
            case Posttypes::INPUT_MASKED_TEXT:
            case Posttypes::INPUT_TEXT:
            case Posttypes::INPUT_NUMBER:
                $out .= '<li class="view-li">';
                $out .= $column['label'] . ' : ';
                $out .= empty($fields[$name]) ? '' : $fields[$name];
                $out .= '</li>';
                break;
            case Posttypes::INPUT_TEXTAREA:
            case Posttypes::INPUT_FROALA:
            case Posttypes::INPUT_REDACTOR:
                $out .= '<li class="view-li">';
                $out .= $column['label'] . ' : <br><div class="text-area>';
                $out .= empty($fields[$name]) ? '' : $fields[$name];
                $out .= '</div></li>';
                break;
//            case Posttypes::INPUT_IMAGE_SINGLE:
//
//                break;
            case Posttypes::INPUT_H:
                $out .= '<h4 class="navbar bg-dark">';
                $out .= empty($fields[$name]) ? '' : $fields[$name];
                $out .= '</h4>';
                break;
            case Posttypes::INPUT_MULTI_SELECT:
                $data = is_callable($column['data']) ? $column['data']($model) : $column['data'];
                if (!empty($fields[$name]) && is_array($fields[$name])) {
                    $vals = $fields[$name];
                    $out .= '<li class="view-li">';
                    $out .= $column['label'] . ' : ';
                    foreach ($vals as $val) {
                        $out .= '<span class="badge badge-success">' . $data[$val] . '</span>';
                    }

                    $out .= '</li>';
                } else {
                    $out .= '<li class="view-li">';
                    $out .= $column['label'] . ' : ';
                    $out .= $data[$fields[$name]];
                    $out .= '</li>';
                }

                break;
//            case Posttypes::INPUT_MULTIPLE:
//
//                break;

            case Posttypes::INPUT_FONTAWESOME_ICON:
                $out .= '<li class="view-li"><i class="fa ' . empty($fields[$name]) ? '' : $fields[$name] . '">';
                $out .= '</i></li>';
                break;
            case Posttypes::INPUT_RELATION_SINGLE:
                $data = !empty($model::getPosts($name)) ? ArrayHelper::map($model::getPosts($name), 'id', 'title') : [];
                if (!empty($data) && !empty($fields[$name])) {
                    $out .= '<li class="view-li">';
                    $out .= $column['label'] . ' : ';
                    $out .= '<span class="badge badge-success">' . $data[$fields[$name]] . '</span>';
                    $out .= '</li>';
                }
                break;
        }
        return $out;
    }

}
