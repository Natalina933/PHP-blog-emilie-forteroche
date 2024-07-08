<?php

class MonitoringController
{
    public function showMonitoring()
    {
        $sort = Utils::request('sort', 'date_creation');
        $order = Utils::request('order', 'DESC');

        $monitoringManager = new MonitoringManager();
        $articles = $monitoringManager->getMonitoringData($sort, $order);

        $view = new View('Monitoring');
        $view->render('monitoring', ['articles' => $articles, 'sort' => $sort, 'order' => $order]);
    }
}