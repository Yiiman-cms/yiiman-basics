<?php
/**
 * Created by YiiMan TM.
 * Programmer: gholamreza beheshtian
 * Mobile:09353466620
 * Company Phone:05138846411
 * Site:https://yiiman.ir
 * Date: 03/21/2020
 * Time: 13:07 PM
 */

namespace YiiMan\YiiBasics\modules\rbac\models;


use Composer\Autoload\ClassLoader;
use Composer\Composer;
use phpDocumentor\Reflection\Types\This;
use phpDocumentor\Reflection\Types\True_;
use YiiMan\YiiBasics\lib\Core;
use Yii;
use yii\web\NotFoundHttpException;
use function count;
use function is_array;
use function realpath;
use function str_replace;

class Provider
{
    public static function checkPermissionFile()
    {
        $systemDir = Yii::getAlias('@system');
        if (!realpath($systemDir . '/permissions')) {
            @mkdir($systemDir . '/permissions');
        }

        if (!realpath($systemDir . '/permissions/RBAC.php')) {
            $file = fopen($systemDir . '/permissions/RBAC.php', 'w+');
            fwrite(
                $file,
                "<?php\n
	/**
	* create rules and permissions
	* @link https://www.yiiframework.com/doc/guide/2.0/en/security-authorization
	* @author amintado | amintado@gmail.com | +989353466620 | https://YiiMan.ir
	*/
	return \n      [\n \n      ];"
            );
            fclose($file);
        }
    }

    public static function fileLocation()
    {
        $systemDir = Yii::getAlias('@system');

        return realpath($systemDir . '/permissions/RBAC.php');
    }

    public static function addPermission($name, $description, $rule = null, $module_en = '', $module_fa = '')
    {
        $auth = Yii::$app->authManager;
        try {
            if (empty($auth->getPermission($name))) {
                $createPermission = $auth->createPermission($name);
                $createPermission->description = $description;
                $createPermission->module_en = $module_en;
                $createPermission->module_fa = $module_fa;
                if (!empty($rule)) {
                    $rule = new  $rule;
                    $auth->add($rule);
                    $createPermission->ruleName = $rule->name;
                }
                $auth->add($createPermission);
            }
        } catch (\Exception $e) {
            $createPermission = $auth->createPermission($name);
            $createPermission->description = $description;
            $createPermission->module_en = $module_en;
            $createPermission->module_fa = $module_fa;
            if (!empty($rule)) {
                $rule = new  $rule;
                $auth->add($rule);
                $createPermission->ruleName = $rule->name;
            }
            $auth->add($createPermission);
        }

    }

    public static function AllSystemPermissions()
    {
        self::createSuperAdminRole();
        $controllerDirs = [];

        /* < get Module Controllers > */
        {
            foreach ($modules = Yii::$app->modules as $ModuleName => $item) {
                if (is_array($item)) {

                    $folder = str_replace(['YiiMan\YiiBasics\modules\\', '\Module'], '', $item['class']);
                    if ($folder == $ModuleName) {
                        $controllerDirectory = realpath(
                            Yii::getAlias('@system') . '/modules/' . $folder . '/controllers'
                        );;
                        if ($controllerDirectory) {
                            $controllerDirs[$ModuleName] = $controllerDirectory;
                        }
                    }
                } else {
                    if (!empty($item->controllerNamespace)) {
                        $folder = str_replace(
                            ['YiiMan\YiiBasics\modules\\', '\Module'],
                            '',
                            $item->controllerNamespace
                        );
                        if ($folder == $ModuleName) {
                            $controllerDirectory = realpath(
                                Yii::getAlias('@system') . '/modules/' . $folder . '/controllers'
                            );
                            if ($controllerDirectory) {
                                $controllerDirs[$ModuleName] = $controllerDirectory;
                            }
                        } else {
                            $namespace = explode('\\', $folder);
                            $root = $namespace[0];
                            $slashCount = count($namespace);
                            try {

                                if ($slashCount > 0) {

                                    $classes = include Yii::getAlias('@vendor') . '/autoload.php';
                                    $classes2 = $classes->getPrefixesPsr4();

                                    $namespaceMap = str_replace('\controllers', '', $folder) . '\\';
                                    if (!empty($path = $classes2[$namespaceMap])) {
                                        $controllerDirectory = realpath(
                                            $path[0] . DIRECTORY_SEPARATOR . 'controllers'
                                        );
                                    } else {
                                        throw new NotFoundHttpException('test');
                                    }

                                }
                            } catch (\Exception $e) {
                                $module = Yii::getAlias('@system') . '/modules/' . $root . '/controllers';
                                $folder = str_replace(explode('/', $folder)[0], '', $folder);
                                $controllerDirectory = realpath(
                                    $module . $folder
                                );
                            }

                            if ($controllerDirectory) {
                                $controllerDirs[$ModuleName] = $controllerDirectory;
                            }
                        }
                    }
                }
            }
        }
        /* </ get Module Controllers > */

        /* < get Apps Controllers > */
        {
            $aliases = Yii::$aliases;

            foreach ($aliases as $name => $alias) {
                if (!is_array($alias)) {
                    $controllerDirctory = realpath($alias . '/controllers');
                    if ($controllerDirctory) {
                        $controllerDirs[str_replace('@', '', $name)] = $controllerDirctory;
                    }
                }
            }
        }
        /* </ get Apps Controllers > */

        /* < Get All Actions > */
        {
            $allActions = [];
            foreach ($controllerDirs as $moduleId => $cDir) {
                $allActions[$moduleId] = self::actionGetcontrollersandactions($cDir);


                // < set module access permission >
                {
                    $configFile = Yii::getAlias('@system') . '/modules/' . $moduleId . '/config.php';
                    if (realpath($configFile)) {
                        $configFile = include $configFile;
                        if (!empty($configFile['name_fa'])) {
                            $name_fa = $configFile['name_fa'];
                        } else {
                            $name_fa = '';
                        }
                    } else {
                        $name_fa = '';
                    }
                    self::addPermission(
                        $moduleId,
                        'دسترسی به بخش ' . $moduleId,
                        null,
                        $moduleId,
                        $name_fa
                    );
                    self::assignToSuperadmin($moduleId);

                }
                // </ set module access permission >
            }
        }
        /* </ Get All Actions > */

        /* < Save All Permissions in Database > */
        {
            foreach ($allActions as $moduleName => $controllers) {
                // < scip create permission >
                {
                    $conti = false;
                    switch ($moduleName) {
                        case 'metadata':
                        case 'gallery':
                        case 'filemanager':
                        case 'errors':
                        case 'bf':
                        case 'slug':
                        case 'sms':
                            $conti = true;
                            break;
                        default:
                            break;

                    }


                    if ($conti) {
                        continue;
                    }
                }
                // </ scip create permission >


                if (!empty($controllers)) {
                    $configFile = Yii::getAlias('@system') . '/modules/' . $moduleName . '/config.php';
                    if (realpath($configFile)) {
                        $configFile = include $configFile;
                        if (!empty($configFile['name_fa'])) {
                            $name_fa = $configFile['name_fa'];
                        } else {
                            $name_fa = '';
                        }
                    } else {
                        $name_fa = '';
                    }
                    foreach ($controllers as $controllerName => $actions) {
                        if (!empty($actions)) {
                            foreach ($actions as $actionName) {
                                //echo $name_fa.'  '.$moduleName . '_' . $controllerName . '_' . $actionName;
                                //echo '<br>';
                                //echo $actionName . ' action in ' . $controllerName . ' controller in ' . $moduleName . ' module';
                                //echo '<br>';

                                self::addPermission(
                                    $moduleName . '_' . $controllerName . '_' . $actionName,
                                    $actionName . ' action in ' . $controllerName . ' controller in ' . $moduleName . ' module',
                                    null,
                                    $moduleName,
                                    $name_fa
                                );
                                self::assignToSuperadmin($moduleName . '_' . $controllerName . '_' . $actionName);
                            }
                        }
                    }
                }
            }

            foreach (Core::getPermissions() as $permission) {
                self::addPermission(
                    $permission['name'],
                    $permission['description'],
                    null,
                    $permission['module_en'],
                    $permission['module_fa']
                );
                self::assignToSuperadmin($permission['name']);


            }
        }
        /* </ Save All Permissions in Database > */


        self::assignSuperAdminRole();
    }

    private static function actionGetcontrollersandactions($controllerDir)
    {
        $controllerlist = [];
        /* < Get All Yii Controller Files > */
        {
            if ($handle = opendir($controllerDir)) {
                while (false !== ($file = readdir($handle))) {

                    preg_match('/(.*)Controller.php/', $file, $display);
                    if (!empty($display)) {
                        $controllerlist[] = $file;
                    }

                }
                closedir($handle);
            }
            asort($controllerlist);
        }
        /* </ Get All Yii Controller Files > */

        /* < Get All Actions In Controller Files > */
        {
            $fulllist = [];
            foreach ($controllerlist as $controller):
                $handle = fopen($controllerDir . '/' . $controller, "r");
                if ($handle) {
                    while (($line = fgets($handle)) !== false) {


                        if (preg_match('/public function action(.*?)\(/', $line, $display)):
                            if (strlen($display[1]) > 2):
                                $fulllist[substr($controller, 0, -14)][] = strtolower($display[1]);
                            endif;
                        endif;
                    }
                }
                fclose($handle);
            endforeach;
        }

        /* </ Get All Actions In Controller Files > */

        return $fulllist;
    }

    private static function createSuperAdminRole()
    {
        $superAdminRole = ModuleRbacAuthItem::findOne(['name' => 'superadmin', 'type' => ModuleRbacAuthItem::TYPE_ROLE]);
        if (empty($superAdminRole)) {
            $superAdminRole = new ModuleRbacAuthItem();
            $superAdminRole->type = $superAdminRole::TYPE_ROLE;
            $superAdminRole->description = \Yii::t('rbac', 'Can access to all of the system modules');
            $superAdminRole->name = 'superadmin';
            $superAdminRole->created_at = time();
            $superAdminRole->updated_at = time();
            $superAdminRole->save();
        }
    }

    private static function assignToSuperadmin($permissionName)
    {


        // < add item to role >
        {
            $roleItem = ModuleRbacAuthItemChild::findOne(['parent' => 'superadmin', 'child' => $permissionName]);
            if (empty($roleItem)) {
                $roleItem = new ModuleRbacAuthItemChild;
                $roleItem->parent = 'superadmin';
                $roleItem->child = $permissionName;
                $roleItem->save();
            }
        }
        // </ add item to role >

    }

    private static function assignSuperAdminRole()
    {
        $assignment = ModuleRbacAuthAssignment::findOne(['user_id' => 1, 'item_name' => 'superadmin']);
        if (empty($assignment)) {
            $assignment = new ModuleRbacAuthAssignment;
            $assignment->item_name = 'superadmin';
            $assignment->user_id = "1";
            $assignment->created_at = date('Y-m-d H:i:s');
            $assignment->save();
        }
    }
}
