<?php

/**
 * Classe modèle pour le monitoring des articles.
 */
class Monitoring 
{
    /**
     * Récupère les données pour le monitoring des articles.
     * @return array : un tableau d'objets contenant les données pour le monitoring.
     */
    public static function getMonitoringData() : array
    {
        $monitoringManager = new MonitoringManager();
        return $monitoringManager->getMonitoringData();
    }
}
?>
