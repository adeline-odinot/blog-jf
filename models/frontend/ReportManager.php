<?php

namespace Forteroche\Models;

require_once("models/Manager.php");
require_once("models/Report.php");

class ReportManager extends Manager
{
    // Ajoute un report dans la BDD.

    public function addReport($id_comment)
    {
        $db = $this->dbConnect();
        $report = $db->prepare('INSERT INTO report(id_comment, report_date) VALUES(:id_comment, NOW())');
        $report->bindValue('id_comment', $id_comment->getId_comment(), \PDO::PARAM_INT);
        $report->execute();
        return $report;
    }

    // Récupère dans la BDD le nombre de report.

    public function getNbReport($id_comment)
    {
        $db = $this->dbConnect();
        $nbReport = $db->prepare('SELECT COUNT(*) FROM report WHERE id_comment = :id_comment');
        $nbReport->bindValue('id_comment', $id_comment->getId_comment(), \PDO::PARAM_INT);
        $nbReport->execute();
        return $nbReport->fetchColumn();
    }
}