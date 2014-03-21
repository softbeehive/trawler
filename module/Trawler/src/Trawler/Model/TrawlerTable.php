<?php

/* TrawlerTable class is responsible for database interaction with 'trawler' table */

namespace Trawler\Model;

use Zend\Db\TableGateway\TableGateway;

class TrawlerTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /* Load everything we have in 'trawler' */
    public function loadAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /* Get saved results by keyword id */
    public function getTrawled($id)
    {
        $id  = (int) $id;
        $resultSet = $this->tableGateway->select(array('keyword_id' => $id));
        return $resultSet;
    }

    /* Save data */ 
    public function saveTrawled(Trawler $trawler)
    {
        $data = array(
            'img_id' => $trawler->img_id,
            'keyword_id'  => $trawler->keyword_id,
            'owner'  => $trawler->owner,
            'owner_name'  => $trawler->owner_name,
            'title'  => $trawler->title,
            'width' => $trawler->width,
            'height' => $trawler->height,
            'farm' => $trawler->farm,
            'server' => $trawler->server,
            'secret' => $trawler->secret,
            'url' => $trawler->url,
        );

        $id = (int) $trawler->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getTrawler($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Trawler id does not exist');
            }
        }
    }

    /* Delete records assosiated with specified keyword */
    public function deleteTrawled($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}