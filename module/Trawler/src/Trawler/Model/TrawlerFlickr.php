<?php

/* 
    TrawlerFlickr class main purpose is getting results from flickr using means of Flickr class (provided as Zend Service)
    Ideally it should be moved outside the model, but for business logic separation I placed it here
*/

namespace Trawler\Model;

use ZendService\Flickr\Exception\ExceptionInterface as FlickrException;
use ZendService\Flickr\Flickr;

class TrawlerFlickr
{
    protected $photoPool;

    public function flickrTrawling($searchQuery) 
    {
        // Create new instance of Flickr, provide an API key
        $flickr = new Flickr('');
        $this->photoPool = $flickr->tagSearch($searchQuery);
        return $this->photoPool->photos->photo;
    }
}