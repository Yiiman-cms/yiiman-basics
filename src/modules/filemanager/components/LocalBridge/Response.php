<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace AngularFilemanager\LocalBridge;

/**
 * Response class
 * HTTP response to requests handled in REST API in callback
 * Chaineable
 * @author Jakub Ďuraš <jakub@duras.me>
 */
class Response
{
    /**
     * @var integer
     */
    private $statusCode = 200;

    /**
     * @var string
     */
    private $status = 'OK';

    /**
     * @var array
     */
    private $additionalHeaders = [];

    /**
     * @var mixed
     */
    private $data = null;

    /**
     * Body which will be used instead of data if set
     * @var string
     */
    private $body = null;

    /**
     * Add additional HTTP header
     * @param  string  $header
     * @return   object  this
     */
    public function addHeaders($header)
    {
        $this->additionalHeaders[] = $header;

        return $this;
    }

    /**
     * @return mixed data which should be later encoded to body
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param  mixed  $data  any data which should be later encoded to body
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed used instead of data if set
     */
    public function getBody()
    {
        if ($this->body !== null) {
            return $this->body;
        }

        if ($this->data === null) {
            return null;
        }

        return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param  mixed  $body  used instead of data if set
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * HTTP Status according to http://tools.ietf.org/html/rfc7231 in form of array
     * @return array associative, e.g. ['code' => 200, 'status' => 'OK']
     */
    public function getStatus()
    {
        return [
            'code'   => $this->statusCode,
            'status' => $this->status
        ];
    }

    /**
     * HTTP Status according to http://tools.ietf.org/html/rfc7231
     * @param  integer  $statusCode
     * @param  string   $status  without status code
     * @return  object              this
     */
    public function setStatus($statusCode, $status)
    {
        $this->statusCode = $statusCode;
        $this->status = $status;

        return $this;
    }

    /**
     * @return array list of all headers including first status line
     */
    public function getHeaders()
    {
        return array_merge(
            [$_SERVER['SERVER_PROTOCOL'].' '.$this->statusCode.' '.$this->status],
            $this->additionalHeaders
        );
    }
}
