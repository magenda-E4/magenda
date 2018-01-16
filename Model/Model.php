<?php
namespace Magenda\Model;
require_once "autoload.php";
use Magenda\Config\Config;
use PDO;
use PDOException;


abstract class Model{

    /***********************************************
     *                                             *
     *          Déclaration des variables          *
     *          communes à toutes les class        *
     *          incluant la class @see Model       *
     *                                             *
     ***********************************************/
    /**
     * Représente une connexion entre PHP
     * et le serveur de base de données.
     *
     * Elle est initialisé automatiquement
     * grâce à la fonction
     * @see Model::intializeDatabase()
     *
     * @var PDO
     */
    protected static $PDO;
    /**
     * Variable static correspondant au
     * nom de la table en base de données
     * @var string
     */
    protected static $TABLE;

    /**
     * Variable correspondant à l'identifiant
     * d'un objet en base de données
     *
     * @var int */
    protected $id;

    /**
     * Initialisation de la variable
     * de session @see Model::$PDO
     *
     * Elle permet de faire le lien
     * entre PHP et la base de données
     *
     * Elle est appelé automatiquement
     * (voir fin de la classe)
     *
     * Utilise les constantes de configuration
     * de la base de données présentent dans
     * la class @see Config
     *
     * @return null
     */
    public static function intializeDatabase(){
        try {
            $pdoDriver = "mysql:host=".Config::DB_HOSTNAME.";dbname=".Config::DB_DATABASE;
            self::$PDO = new PDO(
                $pdoDriver, Config::DB_USER, Config::DB_PASSWORD,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            self::$PDO->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            return true;
        } catch (PDOException $e) {
            if (Config::DEV) {
                echo "Erreur lors de la connexion à la BDD";
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreure est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    /**
     * Permet de selectionner l'ensemble
     * d'une table dans la base de données
     *
     * Méthode static, ne pouvant être appelé
     *  directement par la class Model
     *  mais doit être appelé par une class fille
     * Exemple : Company::selectAll()        OU
     *           User::selectAll()
     *
     * @return array Un tableau avec l'ensemble
     *              des tuples de la table correspondant
     *              @see Model::$TABLE
     *              Sous forme d'objet
     *        Exemple : User::selectAll() retourne un tableau
     *                  d'objets de type "User"
     */
    public static function selectAll() {
        $sql = "SELECT * from " . static::$TABLE;
        try {
            /** @var \PDOStatement $rep */
            $rep = Model::$PDO->query($sql);
            $rep->setFetchMode(PDO::FETCH_CLASS, static::class);
            return $rep->fetchAll();
        } catch (PDOException $e) {
            if (Config::DEV) {
                echo "Erreur lors de la requête";
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
    public static function selectWhere($data, $ordered = null, $groupby = null) {
        $sql = "SELECT * from " . static::$TABLE . " WHERE ";
        $value = array();
        foreach($data AS $clef => $valeur){
            $sql .= "`" . $clef . "` ";
            if(!is_null($valeur)) {
                $sql .= "= :" . $clef;
                $value[$clef] = $valeur;
            }else{
                $sql .= "is null";
            }
            $sql .=  " AND ";
        }$sql = substr($sql, 0, -5);
        if(!is_null($ordered)){
            $sql .= " ORDER BY ".$ordered;
        }
        if(!is_null($groupby)){
            $sql .= " GROUP BY ".$groupby;
        }
        try {
            $req_prep = static::$PDO->prepare($sql);
            $req_prep->execute($value);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, static::class);
            return $req_prep->fetchAll();
        } catch (PDOException $e) {
            if (Config::DEV) {
                echo "Erreur lros du selectWhere ".$sql;
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    /**
     * Permet de selectionner en base de données un tuple
     * et retourne un objet correspondant;
     *
     * <code>
     * <?php
     *  // Nous selectionons l'utilisateur
     *  // ayant pour identifiant : "1"
     *  $utilisateur = User::select(1);
     * ?>
     * </code>
     *
     * @param $id string | int Identifiant en base de données
     * @return Model | null Retourne un objet correspondant
     *                      au tuple en base de données ayant
     *                      pour "id" (primary_key) la valeur
     *                      passé en paramètre et comme table :
     *                          @see Model::$TABLE
     */
    public static function select($id){
        if(count($requestWhere = static::selectWhere(["id" => $id])) > 0){
            return $requestWhere[0];
        }
        return null;
    }

    /**
     * Permet de supprimer l'objet courant
     * de la base de données
     *
     * Le tuple correspondant sera perdu
     * et il ne sera pas possible de faire
     * marche arrière après appel de cette
     * method.
     *
     * Exemple : <code>
     * <?php
     *  $utilisateur = User::select(1);
     *  $utilisateur->delete();
     *  // L'utilisateur 1 en base de données n'existe plus
     * ?>
     * </code>
     */
    public function delete(){
        $sql = "DELETE FROM `".static::$TABLE."` WHERE `id` = :id;";
        try {
            $req_prep = Model::$PDO->prepare($sql);
            $values = array(
                "id" => $this->getId()
            );
            $req_prep->execute($values);
            return true;
        } catch (PDOException $e) {
            if (Config::DEV){
                echo "Erreur lors de la supression" . $sql;
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    /**
     * Permet de modifier l'objet courant
     *
     * $utilisateur->update([
     *          "nomDeLaColonneAModifier" => "nouvelleValeur"
     *          "nomDeLaColonne2AModifier" => "nouvelleValeur2"
     *          ...
    *  ]);
     * @param $data array Doit être un tableau de
     *      la forme : [
     *          "nomDeLaColonneAModifier" => "nouvelleValeur"
     *          "nomDeLaColonne2AModifier" => "nouvelleValeur2"
     *          ...
     *      ]
     */
    public function update($data){
        /** Generation de la requete **/
        $sql = "UPDATE `".static::$TABLE."` SET ";
        foreach($data AS $clef =>$val){
            $sql .= "`".$clef."` = :".$clef." , ";
        }
        $sql  = substr($sql, 0,-3);
        $sql .= " WHERE `id`='".$this->getId()."'";
        try {
            $req_prep = Model::$PDO->prepare($sql);
            $req_prep->execute($data);
            $this->reload();
        } catch (PDOException $e) {
            if (Config::DEV) {
                echo "Erreur lors de la mise à jour : " . $sql;
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
    /**
     * Permet de recharger les données
     * de l'objet courant en faisant un appel
     * à la base de données.
     *
     * @return Model $this Retourne l'objet courant
     */
    protected function reload(){
        $sameOne = static::select($this->getId());
        foreach (get_object_vars($sameOne) AS $property => $value){
            if(!is_null($value)){
                $this->$property = $value;
            }
        }
        return $this;
    }

    /**
     * Permet de récuperer la valeur
     * de l'identifiant en base de données
     * de l'objet courant.
     *
     * @return int Identifiant de l'objet
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Insertion en base de données
     *
     * Cette méthode est appelé pour inserer ("insert"),
     * les données passées en paramètre dans la variable $data
     * dans la table indiqué static::$TABLE directement
     * dans la class qui appel cette methode.
     * Cette methode ne doit pas être appelé directement depuis
     * "Model", mais depuis une de ses classes filles
     *
     * @param array $data Indique les données à inserer dans la table
     * sous forme de tableau tel que :
     *      [
     *          "clefDeLaTable" => "valeur pour le tuple"
     *          "clefDeLaTable2" => "valeur2 pour le tuple"
     *          "clefDeLaTable3" => "valeur3 pour le tuple"
     *      ]
     *
     * @return Model|null On retourne l'objet créer
     */
    public static function insert($data) {
        $into = $value = "";

        foreach($data AS $clef =>$val){
            $into .= "`".$clef."` , ";
            $value .= ":".$clef." , ";
        }

        $into = substr($into, 0, -3);
        $value = substr($value, 0,-3);

        $sql = "INSERT INTO `".static::$TABLE."` (".$into.") VALUES (".$value.")";

        try {

            $req_prep = Model::$PDO->prepare($sql);
            $req_prep->execute($data);
            return static::select(Model::$PDO->lastInsertId());

        } catch (PDOException $e) {
            if (Config::DEV) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
}
Model::intializeDatabase();
