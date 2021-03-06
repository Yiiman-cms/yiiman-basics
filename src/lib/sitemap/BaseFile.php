<?php
/**
 * Copyright (c) 2015-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\sitemap;

use Yii;
use yii\base\Exception;
use yii\base\BaseObject;
use yii\di\Instance;
use yii\helpers\FileHelper;
use yii\web\UrlManager;

/**
 * BaseFile is a base class for the sitemap XML files.
 * @see    http://www.sitemaps.org/
 * @property int                     $entriesCount          the count of entries written into the file, this property is read-only.
 * @property bool                    $isEntriesLimitReached whether the max entries limit is already reached or not.
 * @property UrlManager|array|string $urlManager            the URL manager object or the application component ID of the URL manager.
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since  1.0
 */
abstract class BaseFile extends BaseObject
{
    const MAX_ENTRIES_COUNT = 40000; // max XML entries count.
    const MAX_FILE_SIZE = 10485760; // max allowed file size in bytes = 10 MB

    /**
     * @var string name of the site map file.
     */
    public $fileName = 'sitemap_YiiMan.xml';
    /**
     * @var int the chmod permission for directories and files,
     * created in the process. Defaults to 0777 (owner rwx, group rwx and others rwx).
     */
    public $filePermissions = 0777;
    /**
     * @var string directory, which should be used to store generated site map file.
     * By default '@app/web/sitemap' will be used.
     */
    public $fileBasePath = YII_APP_BASE_PATH;
    /**
     * @var resource file resource handler.
     */
    private $_fileHandler;
    /**
     * @var int the count of entries written into the file.
     */
    private $_entriesCount = 0;
    /**
     * @var UrlManager|array|string the URL manager object or the application component ID of the URL manager.
     */
    private $_urlManager = 'urlManager';


    /**
     * Destructor.
     * Makes sure the opened file is closed.
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Close the related file if it was opened.
     * @return bool success.
     * @throws Exception if file exceed max allowed size.
     */
    public function close()
    {
        if ($this->_fileHandler) {
            $this->beforeClose();
            fclose($this->_fileHandler);
            $this->_fileHandler = null;
            $this->_entriesCount = 0;
            $fileSize = filesize($this->getFullFileName());
            if ($fileSize > self::MAX_FILE_SIZE) {
                throw new Exception('File "'.$this->getFullFileName().'" has exceed the size limit of "'.self::MAX_FILE_SIZE.'": actual file size: "'.$fileSize.'".');
            }
        }
        return true;
    }

    /**
     * This method is invoked before the file is actually closed.
     * You can override this method to perform some finalization.
     */
    protected function beforeClose()
    {
        // blank
    }

    /**
     * Returns the full file name.
     * @return string full file name.
     */
    public function getFullFileName()
    {
        return Yii::getAlias($this->fileBasePath).DIRECTORY_SEPARATOR.$this->fileName;
    }

    /**
     * @return int the count of entries written into the file.
     */
    public function getEntriesCount()
    {
        return $this->_entriesCount;
    }

    /**
     * @return UrlManager
     */
    public function getUrlManager()
    {
        if (!is_object($this->_urlManager)) {
            $this->_urlManager = Instance::ensure($this->_urlManager, UrlManager::className());
        }
        return $this->_urlManager;
    }

    /**
     * @param  UrlManager|array|string  $urlManager
     */
    public function setUrlManager($urlManager)
    {
        $this->_urlManager = $urlManager;
    }

    /**
     * @return bool whether the max entries limit is already reached or not.
     */
    public function getIsEntriesLimitReached()
    {
        return ($this->_entriesCount >= self::MAX_ENTRIES_COUNT);
    }

    /**
     * Writes the given content to the file.
     * @param  string  $content  content to be written.
     * @return int the number of bytes written.
     * @throws Exception on failure.
     */
    public function write($content)
    {
        $this->open();
        $bytesWritten = fwrite($this->_fileHandler, $content);
        if ($bytesWritten === false) {
            throw new Exception('Unable to write file "'.$this->getFullFileName().'".');
        }
        return $bytesWritten;
    }

    /**
     * Opens the related file for writing.
     * @return bool success.
     * @throws Exception on failure.
     */
    public function open()
    {
        if ($this->_fileHandler === null) {
            $this->resolvePath(dirname($this->getFullFileName()));

            $this->_fileHandler = fopen($this->getFullFileName(), 'w+');
            if ($this->_fileHandler === false) {
                throw new Exception('Unable to create/open file "'.$this->getFullFileName().'".');
            }
            $this->afterOpen();
        }
        return true;
    }

    /**
     * Resolves given file path, making sure it exists and writeable.
     * @param  string  $path  file path.
     * @return bool success.
     * @throws Exception on failure.
     */
    protected function resolvePath($path)
    {
        FileHelper::createDirectory($path, $this->filePermissions);
        if (!is_dir($path)) {
            throw new Exception("Unable to resolve path: '{$path}'!");
        } elseif (!is_writable($path)) {
            throw new Exception("Path: '{$path}' should be writeable!");
        }
        return true;
    }

    /**
     * This methods is invoked after the file is actually opened for writing.
     * You can override this method to perform some initialization,
     * in this case do not forget to call the parent implementation.
     */
    protected function afterOpen()
    {
        $this->write('<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="//YiiMan.ir/blog/wp-content/plugins/wordpress-seo-premium/css/main-sitemap.xsl"?>
       
       ');
    }

    /**
     * Increments the internal entries count.
     * @return int new entries count value.
     * @throws Exception if limit exceeded.
     */
    protected function incrementEntriesCount()
    {
        $this->_entriesCount++;
        if ($this->_entriesCount > self::MAX_ENTRIES_COUNT) {
            throw new Exception('Entries count exceeds limit of "'.self::MAX_ENTRIES_COUNT.'".');
        }
        return $this->_entriesCount;
    }
}
