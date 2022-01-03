<?php


namespace YiiMan\YiiBasics\modules\posttypes\models;


use YiiMan\YiiBasics\lib\functions;
use YiiMan\YiiBasics\modules\medicard\models\frontend\StoreLegadeForm;
use YiiMan\YiiBasics\modules\posttypes\models\Posttypes;
use YiiMan\YiiBasics\modules\posttypes\models\PosttypesFields;
use YiiMan\YiiBasics\modules\posttypes\models\PosttypesFk;
use YiiMan\YiiBasics\modules\posttypes\models\PosttypesMultiple;
use YiiMan\YiiBasics\modules\posttypes\models\PosttypesMultipleFields;
use YiiMan\YiiBasics\modules\posttypes\models\Search;
use YiiMan\YiiBasics\widgets\multiRowInput\MultipleInputColumn;
use yii\helpers\ArrayHelper;
use Yii;

class FormModel extends Search
{
    //functions


    public function fieldList()
    {
        return [];
    }

    /**
     * @param $this Posttypes
     */
    public function saveFields()
    {

        // < Calculate Fields >
        {
            foreach ($this->fields as $name => $field) {
                if (!array_search($name, $this->fieldList())) {
                    continue;
                }
                $config = $this::getConfigs(true);
                $config = $config[$this->postType][$name];
                switch ($config['type']) {
                    case Posttypes::INPUT_CHECKBOX:
                    case Posttypes::INPUT_MULTI_SELECT:
                    case Posttypes::INPUT_RADIO:
                        if (!empty($field)) {
                            foreach ($field as $f) {
                                $fieldModel = PosttypesFields::findOne(['fieldName' => $name, 'posttype' => $this->id, 'content' => $f]);
                                if (empty($fieldModel)) {
                                    $fieldModel = new PosttypesFields();
                                    $fieldModel->posttype = $this->id;
                                    $fieldModel->content = $f;
                                    $fieldModel->fieldName = $name;
                                    if (!$fieldModel->save()) {
                                        if (!empty($fieldModel->errors)) {

                                            foreach ($fieldModel->getErrorSummary(true) as $keyError => $valError) {
                                                Yii::$app->session->addFlash('warning', $keyError . ':' . $valError);
                                            }
                                        }
                                    }
                                } else {
                                    $fieldModel->content = $f;
                                    if (!$fieldModel->save()) {
                                        if (!empty($fieldModel->errors)) {

                                            foreach ($fieldModel->getErrorSummary(true) as $keyError => $valError) {
                                                Yii::$app->session->addFlash('warning', $keyError . ':' . $valError);
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        break;
                    case Posttypes::INPUT_NUMBER:
                    case Posttypes::INPUT_FONTAWESOME_ICON:
                    case Posttypes::INPUT_TEXT:
                    case Posttypes::INPUT_FROALA:
                    case Posttypes::INPUT_TEXTAREA:
                    case Posttypes::INPUT_MASKED_TEXT:
                    case Posttypes::INPUT_SELECT:
                    case Posttypes::INPUT_DATE:
                        $fieldModel = PosttypesFields::findOne(['posttype' => $this->id, 'fieldName' => $name]);
                        if (empty($fieldModel)) {
                            $fieldModel = new PosttypesFields();
                        }

                        $fieldModel->posttype = $this->id;
                        $fieldModel->content = (string)$field;
                        $fieldModel->fieldName = $name;
                        if (!$fieldModel->save()) {
                            if (!empty($fieldModel->errors)) {

                                foreach ($fieldModel->getErrorSummary(true) as $keyError => $valError) {
                                    Yii::$app->session->addFlash('warning', $keyError . ':' . $valError);
                                }
                            }
                        }
                        break;
                    case Posttypes::INPUT_RELATION_SINGLE:
                        if (!empty($field)) {
                            $relatedModel = $this->getRelatedModel($name, true);
//                            $relatedModel = PosttypesFields::findOne(['fieldName' => $name, 'posttype' => $this->id]);
                            if (empty($relatedModel)) {
                                $this->addRelation($field, $name);
                            } else {
                                $relatedModel->posttype_to = (int)$field;
                                if (!$relatedModel->save()) {
                                    if (!empty($relatedModel->errors)) {
                                        foreach ($relatedModel->getErrorSummary(true) as $keyError => $valError) {
                                            Yii::$app->session->addFlash('warning', $keyError . ':' . $valError);
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    case Posttypes::INPUT_MULTIPLE:
                        if (!empty($field)) {
                            $fieldModel2 = PosttypesMultiple::find()->where(['posttype_id' => $this->id, 'fieldName' => $name])->all();
                            if (!empty($fieldModel2)) {
                                foreach ($fieldModel2 as $i) {
                                    $deleted = $i->delete();
                                    $error = $i->errors;
                                }
                            }

                            foreach ($field as $index => $row) {
                                foreach ($row as $key => $val) {
                                    $fieldModel2 = new PosttypesMultiple();
                                    $fieldModel2->key = (string)$key;
                                    $fieldModel2->posttype_id = (int)$this->id;
                                    $fieldModel2->posttype = (string)$this->postType;
                                    $fieldModel2->fieldName = (string)$name;
                                    $fieldModel2->type = (string)$config['fields'][$key]['type'];
                                    $fieldModel2->index = (int)$index;


                                    if (is_array($val)) {
                                        $fieldModel2->save();
                                        foreach ($val as $valKey => $valval) {
                                            $mfModel = new PosttypesMultipleFields();
                                            $mfModel->key = (string)$valKey;
                                            $mfModel->value = !empty($valval) ? (string)$valval : '';
                                            $mfModel->posttype_id = (int)$this->id;
                                            $mfModel->posttype = (string)$this->postType;
                                            $mfModel->posttype_field_name = (string)$name;
                                            $mfModel->multiple_field_name = (string)$key;
                                            $mfModel->multiple_field_id = $fieldModel2->id;
                                            $mfModel->save();
                                        }
                                    } else {
                                        $fieldModel2->value = !empty($val) ? (string)$val : '';
                                        $fieldModel2->save();
                                    }
                                }
                            }

                        }
                        break;
                }
            }
        }
        // </ Calculate Fields >


        // < check Unchecked Fields >
        {
            foreach ($this::getConfigs(true)[$this->postType] as $name => $field) {
                switch ($field['type']) {
                    case Posttypes::INPUT_CHECKBOX:
                    case Posttypes::INPUT_MULTI_SELECT:
                    case Posttypes::INPUT_RADIO:
                        if (empty($this->fields[$name])) {
                            $savedOnDb = PosttypesFields::find()->where(['posttype' => $this->id, 'fieldName' => $name])->all();
                            if (!empty($savedOnDb)) {
                                foreach ($savedOnDb as $dbModel) {
                                    if (empty($value)) {
                                        $dbModel->delete();
                                    }
                                }
                            }
                        } else {
                            $savedOnDb = PosttypesFields::find()->where(['posttype' => $this->id, 'fieldName' => $name])->all();
                            if (!empty($savedOnDb)) {
                                $vals = array_flip($this->fields[$name]);
                                foreach ($savedOnDb as $dbV) {
                                    if (!isset($vals[$dbV->content])) {
                                        $dbV->delete();
                                    }
                                }
                            }

                        }
                        break;
                }
            }
        }
        // </ check Unchecked Fields >
        return true;
    }

    /**
     * @param array $params
     * @return Posttypes|null
     */
    public static function loadFormData(array $params = [])
    {
        $model = self::searchWithGet('store', $params, false);


        if (!empty($model)) {
            $model[0]->loadData();
            return $model[0];
        } else {
            return null;
        }
    }

    /**
     * @return $this
     */
    public function loadData()
    {

        // < Load Fields >
        {
            $fields = PosttypesFields::find()->select(['fieldName', 'content'])->where(['posttype' => $this->id])->all();

            // < Load relations >
            {
                $relations = PosttypesFk::find()->select(['posttype_to', 'posttype_type_to'])->where(['posttype_from' => $this->id])->asArray()->all();
                if (!empty($relations)) {
                    $relations = ArrayHelper::index($relations, 'posttype_type_to');
                    foreach ($relations as $relName => $rel) {
                        if (!empty($rel['posttype_to'])) {


                            $this->fields[$relName] = $rel['posttype_to'];
                        }
                    }
                }
            }
            // </ Load relations >


            // < load multiple fields >
            {

                $multiples = PosttypesMultiple::find()->where(['posttype_id' => $this->id])->all();
                if (!empty($multiples)) {
                    $outItem = [];
                    $multiplesfields = ArrayHelper::index($multiples, null, 'fieldName');
                    foreach ($multiplesfields as $fieldName => $rows) {


//                        $row=ArrayHelper::index($rows,null,'index');
                        foreach ($rows as $rowIndex => $item) {
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
                                    $outItem[$item->fieldName][$item->index][$item->key] = $item->value;
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
                                    $outItem[$item->fieldName][$item->index][$item->key] = $item->value;
                            }

                        }

                        $this->fields[$fieldName] = $outItem[$fieldName];

                    }

                }
            }
            // </ load multiple fields >

            if (!empty($fields)) {
                $fields = ArrayHelper::index($fields, null, 'fieldName');
                foreach ($fields as $fieldName => $field) {


                    $config = $this::getConfigs(true)[$this->postType];
                    // < اگر نام پارامتر هایی که برای آنها در بانک داده دیتا ثبت شده است تغییر کرده بود، آن پارامتر ها پاک میشوند >
                    {

                        if (!empty($config[$fieldName])) {
                            $config = $config[$fieldName];
                        } else {

                            continue;
                        }
                    }
                    // </ اگر نام پارامتر هایی که برای آنها در بانک داده دیتا ثبت شده است تغییر کرده بود، آن پارامتر ها پاک میشوند >

                    switch ($config['type']) {
                        case Posttypes::INPUT_CHECKBOX:
                        case Posttypes::INPUT_MULTI_SELECT:
                            $this->fields[$fieldName] = ArrayHelper::getColumn($field, 'content');
                            break;
                        case Posttypes::INPUT_SELECT:
                        case Posttypes::INPUT_RADIO:
                        case Posttypes::INPUT_FONTAWESOME_ICON:
                        case Posttypes::INPUT_NUMBER:
                        case Posttypes::INPUT_TEXT:
                        case Posttypes::INPUT_MASKED_TEXT:
                        case Posttypes::INPUT_TEXTAREA:
                        case Posttypes::INPUT_FROALA:
                            $this->fields[$fieldName] = $field[0]->content;
                            break;

                        case Posttypes::INPUT_RELATION_SINGLE:
                            if (!empty($relations[$fieldName])) {
                                $this->fields[$fieldName] = $relations[$fieldName]['posttype_to'];
                            } else {
                                $this->fields[$fieldName] = '';
                            }
                    }
                }
            }

        }
        // </ Load Fields >
        return $this;
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $save = parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
        if ($save) {
            $save= $this->saveFields();
        }

        return $save;
    }

    public function load($data, $formName = null)
    {
        $dataOut = $data;
        if (empty($formName)) {
            $formName = $this->formName();
        }
        if (!empty($formName) && !empty($data[$formName]) && !empty($data[$formName]['fields'])) {

            foreach ($data[$formName]['fields'] as $fieldName => $val) {
                if (!array_search($fieldName, $this->fieldList())) {
                    $dataOut[$formName]['fields'][$fieldName]=$this->{$fieldName};
                }
            }
        }

        return parent::load($dataOut, $formName); // TODO: Change the autogenerated stub
    }
}
