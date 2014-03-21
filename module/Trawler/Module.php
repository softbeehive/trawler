<?php

namespace Trawler;

 use Trawler\Model\Trawler;
 use Trawler\Model\TrawlerTable;
 use Trawler\Model\KeywordsTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;


class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Trawler\Model\TrawlerTable' =>  function($sm) {
                    $tableGateway = $sm->get('TrawlerTableGateway');
                    $table = new TrawlerTable($tableGateway);
                    return $table;
                },
                'TrawlerTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new TableGateway('trawler', $dbAdapter, null, null);
                },
                'Trawler\Model\KeywordsTable' =>  function($sm) {
                    $tableGateway = $sm->get('KeywordsTableGateway');
                    $table = new KeywordsTable($tableGateway);
                    return $table;
                },
                'KeywordsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new TableGateway('keywords', $dbAdapter, null, null);
                },
            ),
        );
    }
}