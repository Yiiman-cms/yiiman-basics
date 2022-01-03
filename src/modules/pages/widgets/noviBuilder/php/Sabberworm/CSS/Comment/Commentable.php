<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace Sabberworm\CSS\Comment;

interface Commentable
{

    /**
     * @param  array  $aComments  Array of comments.
     */
    public function addComments(array $aComments);

    /**
     * @return array
     */
    public function getComments();

    /**
     * @param  array  $aComments  Array containing Comment objects.
     */
    public function setComments(array $aComments);


}
