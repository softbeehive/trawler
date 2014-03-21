<?php

/* Small remark. I love thin controllers. Besides actions I put few additional methods here because they are related to control. */

namespace Trawler\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\ViewModel;
use Zend\Http\Request;
use Trawler\Model\Trawler;
use Trawler\Model\TrawlerFlickr;

class TrawlerController extends AbstractRestfulController
{  
    protected $trawlerTable;
    protected $keywordsTable;
    protected $trawlerFlickr;

    /* Entry point */
    public function indexAction()
    {
        // Fetch all operations
        $view = new ViewModel(array('rows' => $this->getKeywordsTable()->getAllKeywords()));
        return $view;
    }

    /* Add trawler */
    public function addAction()
    {
        $request = $this->getRequest();
        $passedQuery = $this->params()->fromPost('query');
        $this->trawlerFlickr = new TrawlerFlickr;
        if (!empty($passedQuery)) {
            $trawler = new Trawler();
            // Detect keyword id
            $trawler->exchangeKeyword($passedQuery);
            $this->getKeywordsTable()->saveKeyword($trawler);
            $keywordId = $this->getKeywordsTable()->getKeywordId($passedQuery);
            // Run flickr trawling
            $trawling = $this->trawlerFlickr->flickrTrawling($passedQuery);
            foreach ($trawling as $yield) {
                // Assosiate operation with resulting data
                $yield->keyword_id = $keywordId;
                // Dealing with model and saving yield to database
                $trawler->exchangeArray($yield);
                $this->getTrawlerTable()->saveTrawled($trawler);
            }
            $view = new ViewModel(array('keyword' => $passedQuery, 'kid' => $keywordId));
        } else { 
            $view = new ViewModel(array('error' => true));
        }
        // Skip layout
        $view->setTerminal(true);
        return $view;
    }

    /* Update trawler */
    public function updateAction()
    {
        // coming soon...
    }

    /* Delete trawler */
    public function deleteAction()
    {
        // coming soon...
    }

    /* Intelligence */
    public function intelAction()
    {
        return $this->universalRequester();
    }

    /* Actual results */
    public function actualAction() 
    {        
        return $this->universalRequester();
    }

    /* Reusable method for intelligence-actual actions */
    public function universalRequester()
    {
        $request = $this->getRequest();
        $query = $this->params()->fromPost('kid');
        if (!empty($query)) {
            $intelSet = $this->getTrawlerTable()->getTrawled($query);
            $keywordRow = $this->getKeywordsTable()->getKeyword($query)->current();
            // Initializing view
            $view = new ViewModel(array('results' => $intelSet, 'keywordRow' => $keywordRow));
        } else {
            $view = new ViewModel(array('error' => true));
        }
        // Exclude layout
        $view->setTerminal(true);
        return $view;
    }

    /* Additional methods */
    public function getTrawlerTable()
    {
        if (!$this->trawlerTable) {
            $sm = $this->getServiceLocator();
            $this->trawlerTable = $sm->get('Trawler\Model\TrawlerTable');
        }
        return $this->trawlerTable;
    }

    public function getKeywordsTable()
    {
        if (!$this->keywordsTable) {
            $sm = $this->getServiceLocator();
            $this->keywordsTable = $sm->get('Trawler\Model\KeywordsTable');
        }
        return $this->keywordsTable;
    }
}