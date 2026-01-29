<?php

Class BoutiqueManager {
    private $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    // CREATE
    public function add(Tache $tache){
        $request = "INSERT INTO taches (content) VALUES (:content)";
        $param = [
            "content" => $tache->getContent()
        ];
        $stmt = $this->db->prepare($request);
        $stmt->execute($param);
    }

    // AFFICHER
    public function getAll(){
        $tacheAll = [];
        $request = "SELECT * FROM taches ORDER BY id DESC";
        $stmt = $this->db->query($request);
        $dataAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dataAll as $dataOne) {
            $tache = new Tache();
            $tache->setId($dataOne['id']);
            $tache->setContent($dataOne['content']);
            $tache->setCreatedAt($dataOne['createdAt']);
            $tacheAll[] = $tache;
        }

        return $tacheAll;
    }
}