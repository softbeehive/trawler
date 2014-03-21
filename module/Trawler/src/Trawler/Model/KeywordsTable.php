<?php

/* KeywordsTable class cares about manipulations on 'keywords' table */

namespace Trawler\Model;

use Zend\Db\TableGateway\TableGateway;

class KeywordsTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getAllKeywords()
    {
        $keywords = $this->tableGateway->select();
        return $keywords;
    }

    /* Get keyword id by keyword */
    public function getKeywordId($keyword)
    {
        if (!empty($keyword)) {
            $keywordId = $this->tableGateway->select(array('keyword' => $keyword));
            return $keywordId->current()->id;
        }
    }

    /* Get keyword by id */
    public function getKeyword($id)
    {
        if (!empty($id)) {
            $keyword = $this->tableGateway->select(array('id' => $id));
            return $keyword;
        }
    }

    /* Save keyword to database */
    public function saveKeyword(Trawler $keyword)
    {
        $data = array(
            'keyword'  => $keyword->keyword,
        );

        $id = (int) $keyword->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } 
    }

    public function deleteKeyword()
    {
        // coming soon...
    }
}