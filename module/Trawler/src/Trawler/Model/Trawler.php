<?php

namespace Trawler\Model;

class Trawler
{
    public $id;
    public $img_id;
    public $keyword_id;
    public $keyword;
    public $owner;
    public $owner_name;
    public $title;
    public $width;
    public $height;
    public $farm;
    public $server;
    public $secret;
    public $url;

    public function exchangeArray($data)
    {
        $this->img_id       = (!empty($data->id)) ? (int)$data->id : null;
        $this->keyword_id   = (!empty($data->keyword_id)) ? $data->keyword_id : null;
        $this->owner        = (!empty($data->owner)) ? $data->owner : null;
        $this->owner_name   = (!empty($data->ownername)) ? $data->ownername : null;
        $this->title        = (!empty($data->title)) ? $data->title : null;
        $this->width        = (!empty($data->width_o)) ? $data->width_o : null;
        $this->height       = (!empty($data->height_o)) ? $data->height_o : null;
        $this->farm         = (!empty($data->farm)) ? $data->farm : null;
        $this->server       = (!empty($data->server)) ? $data->server : null;
        $this->secret       = (!empty($data->secret)) ? $data->secret : null;
        $this->url          = (!empty($data->url_o)) ? $data->url_o : null;
    }

    public function exchangeKeyword($keyword)
    {
        $this->keyword = (!empty($keyword)) ? $keyword : null;
    }
}