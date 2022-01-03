<?php


namespace YiiMan\YiiBasics\modules\posttypes\models;


use yii\helpers\ArrayHelper;

class Search extends Posttypes
{

    /**
     * بررسی میکند آیا کلید مورد نظر برای جست و جو ارسال شده است یا خیر، و اگر ارسال شده بود، مقدار آن را بازگردانی میکند
     * @param $val
     * @param string $id
     * @return mixed|string
     */
    public static function getVal($val, $id = '')
    {
        $id = (string)$id;
        if (!empty($_GET[$val])) {
            if (!empty($id) && is_array($_GET[$val])) {
                if (!is_bool(array_search((string)$id, $_GET[$val]))) {
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

    public static function searchWithGet($posttype, $params = [], $checkGetParams = true,$limit=null)
    {
        $conditions = [];
        $query = <<<MYSQL
select module_posttypes.id               as id,
       module_posttypes.title            as title,
       module_posttypes.language         as language,
       module_posttypes.language_parent  as language_parent,
       module_posttypes.postType         as posttype,
       module_posttypes.status           as status,
       module_posttypes.created_at       as created_at,
       module_posttypes.updated_at       as updated_at,
       module_posttypes.content          as content,
       module_posttypes_fields.fieldName as field_name,
       module_posttypes_fields.content   as field_ontent

from module_posttypes
         left join module_posttypes_fields on module_posttypes.id = module_posttypes_fields.posttype
         left join module_posttypes_fk on module_posttypes.id = module_posttypes_fk.posttype_from
         left join module_posttypes_multiples on module_posttypes.id = module_posttypes_multiples.posttype_id
         left join module_posttypes_multiples_fields on module_posttypes_multiples.id = module_posttypes_multiples_fields.multiple_field_id

where module_posttypes.postType ='{$posttype}' and module_posttypes.status=1

MYSQL;


        if (!empty($params)) {
            $conditions = array_merge_recursive($conditions, self::calculateConditions($posttype, $params));
        }
        if ($checkGetParams) {
            $conditions = array_merge_recursive($conditions, self::calculateConditions($posttype, $_GET));
        }


        if (!empty($conditions)) {
            $conditions = ' and ' . implode(' and ', $conditions);
        } else {
            $conditions = '';
        }

        $out = $query . $conditions . ' group by module_posttypes.id';
        if (!empty($limit)){
            $out .=' limit '.$limit;
        }
        $out = \Yii::$app->db->createCommand($out)->queryAll();
        if (!empty($out)) {
            $out = ArrayHelper::getColumn($out, 'id');
            return self::getPosts($posttype, null, $out);
        }
    }


    private static function calculateConditions($posttype, $params = [])
    {
        $configs = Posttypes::getConfigs(true);
        $multiples = [];
        $multipleFields = [];
        $fields = [];
        $posttype_conditions = [];
        $fk_first = [];
        $fk = [];
        $posttype_titles = [];

        foreach ($params as $key => $val) {
            if (empty($val)) {
                continue;
            }
            if (!empty($configs[$posttype][$key])) {
                switch ($configs[$posttype][$key]['type']) {
                    case Posttypes::INPUT_TEXT :
                    case Posttypes::INPUT_TEXTAREA :
                    case Posttypes::INPUT_DATE :
                    case Posttypes::INPUT_FROALA :
                    case Posttypes::INPUT_REDACTOR :
                    case Posttypes::INPUT_MASKED_TEXT:
                    case Posttypes::INPUT_NUMBER :
                    case Posttypes::INPUT_FONTAWESOME_ICON :
                    case Posttypes::INPUT_SELECT :
                        if (!empty((int)$val)) {

                            $fields[] = <<<SQL
exists
    (
    select id 
    from module_posttypes_fields 
    where module_posttypes_fk.posttype_from=module_posttypes.id 
    and module_posttypes_fields.fieldName='{$key}' 
    and 
        (
        module_posttypes_fields.content='{$val}' 
        or module_posttypes_fields.content like '%{$val}' 
        or module_posttypes_fields.content like '{$val}%' 
        or module_posttypes_fields.content like '%{$val}%' 
        )
    )

SQL;
                        } else {
                            $words = explode(' ', $val);
                            foreach ($words as $word) {

                                $posttype_titles[] = <<<MYSQL

         module_posttypes.title like '%{$word}' or
         module_posttypes.title like '{$word}%' or
         module_posttypes.title like '%{$word}%' 

MYSQL;
                            }

                        }
                        break;
                    case Posttypes::INPUT_CHECKBOX :
                    case Posttypes::INPUT_RADIO :
                    case Posttypes::INPUT_MULTI_SELECT:
                        if (!empty($val) && is_array($val)) {
                            foreach ($val as $item) {
                                $fields[] =
                                    <<<MYSQL

exists
(
    select id 
    from module_posttypes_fields 
    where module_posttypes_fields.postType=module_posttypes.id and
     module_posttypes_fields.fieldName='{$key}' 
     and 
        (
            module_posttypes_fields.content='{$item}' or
             module_posttypes_fields.content like '%{$item}' or
              module_posttypes_fields.content like '{$item}%' or
               module_posttypes_fields.content like '%{$item}%'
        ) 
)

MYSQL;

                            }
                        }

                        break;
                    case Posttypes::INPUT_MULTIPLE :


                        break;
                    case Posttypes::INPUT_RELATION_SINGLE :
                        if (!empty((int)$val)) {
                            $fk[] = <<<MYSQL

exists(select id from module_posttypes_fk where module_posttypes_fk.posttype_from=module_posttypes.id and module_posttypes_fk.posttype_to={$val})
MYSQL;
                        }
                        break;
                }
            }


            // < Posttype Title >
            {
                if ($key == 'title') {
                    $words = explode(' ', $val);
                    foreach ($words as $word) {

                        $posttype_titles[] = <<<MYSQL

         module_posttypes.title like '%{$word}' or
         module_posttypes.title like '{$word}%' or
         module_posttypes.title like '%{$word}%' 

MYSQL;
                    }

                }


            }
            // </ Posttype Title >


            // <Posttype created_at >
            {
                if ($key == 'created_at') {
                    $posttype_conditions[] = <<<MYSQL

module_posttypes.created_at ='$val'
MYSQL;

                }
            }
            // </Posttype created_at >



            // <Posttype hash >
            {
                if ($key == 'hash') {
                    $posttype_conditions[] = <<<MYSQL

module_posttypes.hash ='$val'
MYSQL;

                }
            }
            // </Posttype hash >





            // <Posttype updated_at >
            {
                if ($key == 'updated_at') {
                    $posttype_conditions[] = <<<MYSQL

module_posttypes.updated_at ='$val'
MYSQL;

                }
            }
            // </Posttype updated_at >

        }

        // < calculate Titles >
        {
            if (!empty($posttype_titles)) {
                $posttype_conditions[] = '(' . implode(' or ', $posttype_titles) . ') ';
            }
        }
        // </ calculate Titles >

        $out = array_merge_recursive($multiples, $multipleFields, $fields, $posttype_conditions, $fk);
        return $out;
    }


}
