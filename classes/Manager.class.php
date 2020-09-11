<?php

class Manager{

    // attributes
    private $db;

    const TABLE_NAME = 'vehicles';

    // constructor
    public function __construct(PDO $db){
        $this->setDb($db);
    }

    // setters
    public function setDb(PDO $db){
        $this->db = $db;
    }

    // methods
    public function createTable(){
        // [[[[[[ à compléter ]]]]]]
        $sql=$this->db->prepare ('CREATE TABLE IF NOT EXISTS `vehicles` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `model` varchar(80) NOT NULL,
            `builder` varchar(80) NOT NULL,
            `fuel` varchar(80) NOT NULL,
            `color` varchar(80) NOT NULL,
            `kilometer` int(11) NOT NULL,
            `immatriculation` varchar(16) NOT NULL,
            `technical_control` varchar(32) NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `immatriculation` (`immatriculation`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $sql->execute();
       

    }
    /**
     * Vérifie la présense de la table des véhicules dans la base de données
     *
     * @return boolean retourne *false* en cas d'absence
     */
    public function existTable(){

        return $this->db->query('DESCRIBE '.Manager::TABLE_NAME);

    }
    /**
     * Permet d'afficher le contenu de la table des véhicules
     *  - vérifie la présence de la table avec *existTable()*
     *
     * @return void
     */
    public function readTable(){

        if($this->existTable()){
            // [[[[[[ à compléter ]]]]]]
            $sql=$this->db->prepare("SELECT * FROM vehicles ");
            $sql->execute();
            $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetch as $key){ 
            echo'<table><thead>';
            echo'<tr>';
            echo'<th class="text-center">'.$key["model"].' &emsp;</th>
                  <th class="text-center">'.$key["builder"].'&emsp;</th>
                  <th class="text-center">'.$key["fuel"].'&emsp;</th>
                  <th class="text-center">'.$key["color"].'&emsp;</th>
                  <th class="text-center">'.$key["kilometer"].'&emsp;</th>
                  <th class="text-center">'.$key["immatriculation"].'&emsp;</th>
                  <th class="text-center">'.$key["technical_control"].'&emsp;</th>';
            echo'</tr>';
            echo'</thead></table>';
            }
        }
        else
            echo '<p style="text-align: center;">La table "'.Manager::TABLE_NAME.'" n\'existe pas</p>';
    }
    public function truncateTable(){

        // [[[[[[ à compléter ]]]]]]
        $sql=$this->db->prepare('TRUNCATE TABLE vehicles');
        $sql->execute();

    }
    public function dropTable(){

        // [[[[[[ à compléter ]]]]]]
        $sql=$this->db->prepare('DROP TABLE vehicles');
        $sql->execute();
    }
    /**
     * Permet d'ajouter une entrée dans la table des véhicules
     *
     * @param  Vehicle $vehicle un objet véhicule
     * @return void
     */
    public function create(Vehicle $vehicle){
        // [[[[[[ à compléter ]]]]]]
        $vehicle = new vehicle();
            $sql = $this->db->prepare("INSERT INTO $vehicle (model, builder, fuel, color, kilometer, immatriculation, technical_control)
             VALUES (:param1, :param2, :param3, :param4, :param5,:param6, :param7)");
            $sql->bindValue(':param1', $vehicle->getModel(), PDO::PARAM_STR); 
            $sql->bindValue(':param2', $vehicle->getBuilder(), PDO::PARAM_STR);
            $sql->bindValue(':param3', $vehicle->getFuel(), PDO::PARAM_STR);
            $sql->bindValue(':param4', $vehicle->getColor(),PDO::PARAM_STR);
            $sql->bindValue(':param5', $vehicle->getkilometer(), PDO::PARAM_INT);
            $sql->bindValue(':param6', $vehicle->getImmatriculation(),PDO::PARAM_INT);
            $sql->bindValue(':param7', $vehicle->getTechnical_control(), PDO::PARAM_STR);
            $sql->execute();
        return $vehicle;
        
    }
    
    /**
     * Permet de sélectionner la première entrée dans la table des véhicules
     *
     * @return Vehicle retourne un objet véhicule
     */
    public function selectFirst(string $vehicle){
        $sql = $this->db->prepare("SELECT * FROM vehicles WHERE model =:param1 ");
        $sql->bindValue(':param1', $vehicle,PDO::PARAM_STR);
        $sql->execute();
        $fetch = $sql->fetch(PDO::FETCH_ASSOC);
        $vehicle = new Vehicle();      
        $vehicle->hydrate($fetch);
        return $vehicle;
        // [[[[[[ à compléter ]]]]]]

    }

    /**
     * Permet de modifier une entrée dans la table des véhicules
     *
     * @param  Vehicle $vehicle un objet véhicule
     * @return void
     */
    public function update(Vehicle $vehicle){
        // [[[[[[ à compléter ]]]]]]
        $sql =$this->_db->prepare("UPDATE `vehicles`
         SET model =:param1 , builder =:param2 ,  fuel =:param3 , color =:param4 , kilometer =:param5, immatriculation=:param6, technical_control=:param7 
        WHERE `$vehicle`.`id` = :param8");
        $sql->bindValue(':param1', $vehicle->getModel(), PDO::PARAM_STR); 
        $sql->bindValue(':param2', $vehicle->getBuilder(), PDO::PARAM_STR);
        $sql->bindValue(':param3', $vehicle->getFuel(), PDO::PARAM_STR);
        $sql->bindValue(':param4', $vehicle->getColor(),PDO::PARAM_STR);
        $sql->bindValue(':param5', $vehicle->getkilometer(), PDO::PARAM_INT);
        $sql->bindValue(':param6', $vehicle->getImmatriculation(),PDO::PARAM_INT);
        $sql->bindValue(':param7', $vehicle->getTechnical_control(), PDO::PARAM_STR);
        $sql->bindValue(':param8', $vehicle->getId(), PDO::PARAM_STR);
        $sql->execute();
    }

    public function delete(Vehicle $vehicle){
        $sql=$this->db->prepare("DELETE FROM `vehicles` WHERE `vehicles`.`id` = :param6");
        $sql->bindValue(':param6',$vehicle->getId(),PDO::PARAM_INT);
        $sql->execute();

        // [[[[[[ à compléter ]]]]]]

    }

    /**
     * Retourne la liste des véhicules d'un constructeur
     *  - classés par ordre croissant des modèles
     * 
     * @param  string $builder nom du constructeur (*Renault* par défaut)
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfVehiclesByBuilder(string $builder = 'Renault'){
        $sql = $this->db->prepare("SELECT model , builder , fuel , color, kilometer, immatriculation, technical_control
        FROM vehicles
        WHERE model ORDER BY model ASC");
   
        $sql -> execute();
        $fetch = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($fetch as $value){
            echo '<div>';
            echo '<br>'.$value['model'].'&nbsp;'.$value['builder'].'&nbsp;'.$value['fuel'].'&nbsp;'.$value['color'].
            '&nbsp;'.$value['kilometer'].'&nbsp;'.$value['immatriculation'].'&nbsp;'.$value['technical_control'].'<br><br>' ;
            echo '</div>';
        }

        // [[[[[[ à compléter ]]]]]]
        
    }

    /**
     * Retourne la liste des véhicules dont le contrôle technique est invalide
     * 
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfInvalidVehicles(){

        // [[[[[[ à compléter ]]]]]]

    }

    /**
     * Retourne la liste des véhicules essence
     * 
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfGasolineVehicles(){

        // [[[[[[ à compléter ]]]]]]

    }

    /**
     * Retourne la liste des véhicules par km
     *  - classés par ordre croissant des km
     * 
     * @param  int $kilometer nombre de km (0 par défaut)
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfVehiclesByMoreKm(int $kilometer = 0){

        // [[[[[[ à compléter ]]]]]]

    }

}
