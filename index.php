<?php

    require_once './bee.class.php';
    
    session_start();
    
    /// Nombre d'abeille par classe
    define( 'BEE_QWEEN_NB'  , 1);
    define( 'BEE_WORKER_NB' , 5);
    define( 'BEE_DRONE_NB'  , 8);
    
    /// Si il n'y a aucune abeille, on initialise
    if( empty( $_SESSION['bee_s'])){
        init_bees();
    }
    
    /// Si on a recu la commande pour taper, on tape :)
    if( ! empty( $_POST['is_hit'])){
        hit_bee();
    }
    
    /**
     * Initialise le tableau des abeilles
     */
    function init_bees(){        
        $_SESSION['bee_s'] = [];
        /// Création des abeilles reines
        for( $i = 0; $i < BEE_QWEEN_NB; $i++){
            $_SESSION['bee_s'][] = new QweenBee();
        }
        /// Création des abeilles travailleuses
        for( $i = 0; $i < BEE_WORKER_NB; $i++){
            $_SESSION['bee_s'][] = new WorkerBee();
        }
        /// Création des abbeilles drones
        for( $i = 0; $i < BEE_DRONE_NB; $i++){
            $_SESSION['bee_s'][] = new DroneBee();
        }
    }
    
    /**
     * Frappe une abeille
     */
    function hit_bee(){
        $bee_to_be_hit = array_rand( $_SESSION['bee_s']);   // Séléction d'une abeille au hasard dans le tableau
        $_SESSION['bee_s'][$bee_to_be_hit]->attack();       // Attaque de l'abeille en question (retrait des pv)
        /// Si notre abeille est décédée
        if( $_SESSION['bee_s'][$bee_to_be_hit]->is_dead()){
            $name = $_SESSION['bee_s'][$bee_to_be_hit]->get_type();
            // Si il ne s'agissait pas de la reine, on la retire
            if( $name != 'QweenBee'){
                unset( $_SESSION['bee_s'][$bee_to_be_hit]);                
            }
            // Sinon : La reine est morte, c'est gagné !!
            else {
                $_SESSION['bee_s'] = [];
                echo "<h1>The qween is dead</h1>";
            }
        }
        
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bee Game</title>
    </head>
    <body>
        
        <?php foreach($_SESSION['bee_s'] as $bee): ?>
            <div width="100%">
                <b><?= $bee->get_type() ?></b> (<?= $bee->get_life() ?>)
            </div>
        <?php endforeach; ?>
                
        <form action="?" method="POST">
            <input type="hidden" name="is_hit" value="1" />
            <input type="submit" value="Hit a random bee" />
        </form>
            
            
    </body>
</html>


