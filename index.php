<?php
require_once './settings/db.php';
require_once './classes/Manager.class.php';
require_once './classes/Vehicle.class.php';

$manager = new Manager($db);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eval PHPObjet</title>
    </head>
    <body>

        <!-- Table links -->
        <p style="text-align: center;">Table</p>
        <div style="margin: 0 0 30px 0; text-align: center;">
            <a href="index.php" ><=</a>&emsp;
            <a href="index.php?option=1">Créer</a>&emsp;

            <?php if($manager->existTable()): ?>

            <a href="index.php?option=2">Lire</a>&emsp;
            <a href="index.php?option=3">Vider</a>&emsp;
            <a href="index.php?option=4">Supprimer</a>
        </div>

        <hr />

        <!-- Vehicles links -->
        <p style="text-align: center;">Véhicules</p>
        <div style="margin: 0 0 10px 0; text-align: center;">
            <a href="index.php?option=5">Créer tout</a>&emsp;
            <a href="index.php?option=6">Décrire le 1er</a>&emsp;
            <a href="index.php?option=7">+ 1 km au 1er</a>&emsp;
            <a href="index.php?option=8">Supprimer le 1er</a>&emsp;
        </div>
        
        <div style="margin: 0 0 30px 0; text-align: center;">
            <a href="index.php?option=9">Liste des Renault</a>&emsp;
            <a href="index.php?option=10">Liste ct non valides</a>&emsp;
            <a href="index.php?option=11">Liste véhicules essence</a>&emsp;
            <a href="index.php?option=12">Liste km &#8805; 50 000</a>
        </div>

            <?php else: ?>
        </div>
            <?php endif; ?>

        <hr />

        <?php

        $center = 'style="text-align: center;"';

        $option = (isset($_GET['option'])) ? $_GET['option'] : null ;
        switch($option){
            case 1: // CREATE Table

                echo '<h1 '.$center.'>Créer</h1>';
                // [[[[[[ à compléter ]]]]]]
                $manager->createTable();
                $data=[
                    ['model'=>'KADJAR','builer'=>'Renault','fuel'=>'essence','color'=>'blanc','kilometer'=>0,'immatriculation'=>'KZ-483-AN','technical_control'=>'Valide'],
                    ['model'=>'Renault','builer'=>'TRAFFIC','fuel'=>'Diesel','color'=>'Anthracite','kilometer'=>2723,'immatriculation'=>'JZ-9MA-8D','technical_control'=>'Valide'],
                    ['model'=>'108','builer'=>'Peugeot','fuel'=>'essence','color'=>'Kaki','kilometer'=>59724,'immatriculation'=>'J9-K18-P2','technical_control'=>'invalide'],
                    ['model'=>'TALISMANEstate','builer'=>'Renault','fuel'=>'Diesel','color'=>'Bleu marine','kilometer'=>39808,'immatriculation'=>'FA-491-CZ','technical_control'=>'Valide'],
                    ['model'=>'208','builer'=>'Peugeot','fuel'=>'essence','color'=>'Rouge foncé','kilometer'=>6920,'immatriculation'=>'AS-025-VE','technical_control'=>'Valide'],
                    ['model'=>'ASTRA','builer'=>'Opel','fuel'=>'Diesel','color'=>'Noir','kilometer'=>109047,'immatriculation'=>'CQ-S77-EK','technical_control'=>'invalide'],
                    ['model'=>'YETI','builer'=>'SKODA','fuel'=>'Diesel','color'=>'Rose Crevette','kilometer'=>136896,'immatriculation'=>'DG-356-LY','technical_control'=>'Valide'],
                    ['model'=>'KADJAR','builer'=>'Renault','fuel'=>'essence','color'=>'noir','kilometer'=>48203,'immatriculation'=>'AE-S21-KQ','technical_control'=>'Valide'],
                    ['model'=>'E-class','builer'=>'Mercedes','fuel'=>'Diesel','color'=>'blanc','kilometer'=>78529,'immatriculation'=>'ET-356-LK','technical_control'=>'Valide'],
                    ['model'=>'Ducato','builer'=>'Fiat','fuel'=>'Diesel','color'=>'Noir','kilometer'=>139730,'immatriculation'=>'BY-303-HA','technical_control'=>'Valide'],
                    ['model'=>'hatch','builer'=>'Mini','fuel'=>'essence','color'=>'Jaune','kilometer'=>96294,'immatriculation'=>'DC-632-TR','technical_control'=>'Valide'],
                    ['model'=>'-','builer'=>'Peugeot','fuel'=>'essence','color'=>'orange','kilometer'=>16920,'immatriculation'=>'AE-521-KQ','technical_control'=>'Valide'],
                    ['model'=>'Sandero','builer'=>'-','fuel'=>'essence','color'=>'blanc','kilometer'=>174329,'immatriculation'=>'FF-992-ZZ','technical_control'=>'invalide'],
                    ['model'=>'E-2008','builer'=>'Peugeot','fuel'=>'essence','Bleu'=>'blanc','kilometer'=>8306,'immatriculation'=>'DC-076-CT','technical_control'=>'Valide'],
                    ['model'=>'C3','builer'=>'Citroën','fuel'=>'essence','color'=>'-','kilometer'=>127292,'immatriculation'=>'ET-227-VL','technical_control'=>'invalide'],
                    ['model'=>'ZOé','builer'=>'Renault','fuel'=>'éléctrique','color'=>'Bordeau','kilometer'=>0,'immatriculation'=>'FB-080-SK','technical_control'=>'Valide'],
                    ['model'=>'Prius','builer'=>'Toyota','fuel'=>'hybride','color'=>'Gris Foncé','kilometer'=>203927,'immatriculation'=>'AF-515-AT','technical_control'=>'invalide']

                ];
                $value=0;
                foreach($data AS $value){
                    $vehicle = new vehicle();
                    $vehicle->hydrate($value);
                    $manager->create($vehicle);
                    $value++;

                }
                echo '<p '.$center.'>La table a été créée</p>';

                break;
            case 2: // READ Table

                echo '<h1 '.$center.'>Lire</h1>';
                // [[[[[[ à compléter ]]]]]]
                $manager->readtable();

                break;
            case 3: // TRUNCATE Table

                echo '<h1 '.$center.'>Vider</h1>';
                // [[[[[[ à compléter ]]]]]]
                $manager->truncatetable();
                echo '<p '.$center.'>La table a été vidée</p>';

                break;
            case 4: // DROP Table

                echo '<h1 '.$center.'>Supprimer</h1>';
                // [[[[[[ à compléter ]]]]]]
                $sql=$this->db->prepare('DROP TABLE vehicles');
                $sql->execute();
                echo '<p '.$center.'>La table a été supprimée</p>';

                break;
            case 5: // CREATE all vehicules

                echo '<h1 '.$center.'>Créer tout</h1>';

                // [[[[[[ à compléter ]]]]]]
                

                echo '<p '.$center.'>Tous les véhicules ont été ajoutés</p>';

                break;
            case 6: // Describe first vehicle

                echo '<h1 '.$center.'>Décrire le 1er</h1>';
                $vehicle = $manager->selectFirst();
                $vehicle->describe();

                break;
            case 7: // UPDATE first vehicle (km + 1)

                echo '<h1 '.$center.'>Décrire le 1er</h1>';
                $vehicle = $manager->selectFirst();
                $vehicle->describe();

                echo '<h2 '.$center.'>+ 1 km</h2>';
                // [[[[[[ à compléter ]]]]]]
                $manager->update($vehicle);

                $vehicleUpdated = $manager->selectFirst();
                $vehicleUpdated->describe();

                break;
            case 8: // DELETE first vehicle

                echo '<h1 '.$center.'>Supprimer le 1er</h1>';
                $manager->delete($manager->selectFirst());
                echo '<p '.$center.'>Le véhicule a été supprimé</p>';

                break;
            case 9: // List: Renault

                echo '<h1 '.$center.'>Liste des Renault</h1>';
                $listOfVehicles = $manager->listOfVehiclesByBuilder();

                foreach($listOfVehicles as $vehicle){
                    echo '
                        <p '.$center.'>'.
                            $vehicle->getModel().' ('.$vehicle->getImmatriculation().')
                        </p>
                    ';
                }

                break;
            case 10: // List: invalid vehicles

                echo '<h1 '.$center.'>Liste des ct non valides</h1>';
                $listOfInvalidVehicles = $manager->listOfInvalidVehicles();

                foreach($listOfInvalidVehicles as $vehicle){
                    echo '
                        <p '.$center.'>'.
                            $vehicle->getBuilder().' '.$vehicle->getModel().' ('.$vehicle->getImmatriculation().')
                        </p>
                    ';
                }

                break;
            case 11: // List: gasoline vehicles

                echo '<h1 '.$center.'>Liste des véhicules essence</h1>';
                $listOfGasolineVehicles = $manager->listOfGasolineVehicles();

                foreach($listOfGasolineVehicles as $vehicle){
                    echo '
                        <p '.$center.'>'.
                            $vehicle->getBuilder().' '.$vehicle->getModel().' ('.$vehicle->getImmatriculation().')
                        </p>
                    ';
                }

                break;
            case 12: // List: km > 50000

                echo '<h1 '.$center.'>Liste des véhicules &#8805; 50 000 km</h1>';
                $listOfVehiclesByMoreKm = $manager->listOfVehiclesByMoreKm(50000);

                foreach($listOfVehiclesByMoreKm as $vehicle){
                    echo '
                        <p '.$center.'>'.
                            $vehicle->getBuilder().' '.$vehicle->getModel().' ('.$vehicle->getImmatriculation().') '.$vehicle->getKilometer().' km
                        </p>
                    ';
                }

                break;
            default:
                echo '<h1 '.$center.'>WrommMM!</h1>';
        }

        ?>
    </body>
</html>
