<?php
/**
 * Copyright (c) 2015-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\lib\sitemap;

/**
 * File is a helper to create the site map XML files.
 * Example:
 * ```php
 * use yii2tech\sitemap\File;
 * $siteMapFile = new File();
 * $siteMapFile->writeUrl(['site/index']);
 * $siteMapFile->writeUrl(['site/contact'], ['priority' => '0.4']);
 * $siteMapFile->writeUrl('http://mydomain.com/mycontroller/myaction', [
 *     'lastModified' => '2012-06-28',
 *     'changeFrequency' => 'daily',
 *     'priority' => '0.7'
 * ]);
 * ...
 * $siteMapFile->close();
 * ```
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @see    http://www.sitemaps.org/
 * @see    BaseFile
 * @since  1.0
 */
class File extends BaseFile
{
    // Check frequency constants:
    const CHECK_FREQUENCY_ALWAYS = 'always';
    const CHECK_FREQUENCY_HOURLY = 'hourly';
    const CHECK_FREQUENCY_DAILY = 'daily';
    const CHECK_FREQUENCY_WEEKLY = 'weekly';
    const CHECK_FREQUENCY_MONTHLY = 'monthly';
    const CHECK_FREQUENCY_YEARLY = 'yearly';
    const CHECK_FREQUENCY_NEVER = 'never';

    /**
     * @var array default options for [[writeUrl()]].
     */
    public $defaultOptions = [];

    /**
     * Writes the URL block into the file.
     * @param  string|array  $url      page URL or params.
     * @param  array         $options  options list, valid options are:
     *                                 - 'lastModified' - string|int, last modified date in format Y-m-d or timestamp.
     *                                 by default current date will be used.
     *                                 - 'changeFrequency' - string, page change frequency, the following values can be passed:
     *                                 * always
     *                                 * hourly
     *                                 * daily
     *                                 * weekly
     *                                 * monthly
     *                                 * yearly
     *                                 * never
     *                                 by default 'daily' will be used. You may use constants defined in this class here.
     *                                 - 'priority' - string|float URL search priority in range 0..1, by default '0.5' will be used
     * @return int the number of bytes written.
     */
    public function writeUrl($url, array $options = [])
    {
        $this->incrementEntriesCount();

        if (!is_string($url)) {
            $url = $this->getUrlManager()->createAbsoluteUrl($url);
        }

        $xmlCode = '<url>';
        $xmlCode .= "<loc>{$url}</loc>";

        $options = array_merge(
            [
                'lastModified'    => date('Y-m-d'),
                'changeFrequency' => self::CHECK_FREQUENCY_DAILY,
                'priority'        => '0.5',
            ],
            $this->defaultOptions,
            $options
        );
        if (ctype_digit($options['lastModified'])) {
            $options['lastModified'] = date('Y-m-d', $options['lastModified']);
        }


        if (!empty($options['images'])) {
            foreach ($options['images'] as $img) {
                $xmlCode .= <<<XML
    <image:image>
      <image:loc>{$img}</image:loc>
    </image:image>
XML;

            }
        }

        $xmlCode .= "<lastmod>{$options['lastModified']}</lastmod>";
        $xmlCode .= "<changefreq>{$options['changeFrequency']}</changefreq>";
        $xmlCode .= "<priority>{$options['priority']}</priority>";

        $xmlCode .= '</url>';
        return $xmlCode;
    }

    /**
     * {@inheritdoc}
     */
    protected function afterOpen()
    {
        parent::afterOpen();
        $this->write('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeClose()
    {
        $this->write('</urlset>');
        parent::beforeClose();
    }
}
