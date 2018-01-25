<?php
/**
 * Permet de remplir l'ensemble de la base de données
 * avec des données généré automatiquement
 */

use Magenda\Model\Company;
use Magenda\Model\CompanyHasProfession;
use Magenda\Model\User;

include __DIR__ . "/../autoload.php";


/***
 * Insertions de l'ensemble des professions
 */
$professions =  [
    "Arboriste",
    "Boy (domestique)",
    "Coiffeur",
    "Concierge",
    "Détective",
    "Domesticité",
    "Femme de ménage",
    "Garde du corps",
    "Homme à tout faire",
    "Médecin",
    "Infirmier",
    "Sage-femme",
    "Chirurgien-dentiste",
    "Dentiste",
];
$professionsModel = [];
foreach ($professions AS $profession){
    $professionsModel[] = \Magenda\Model\Profession::insert(["name" => $profession]);
}
/***
 * Insertion des 50 entreprises
 */
$companies = [];
$jsonData = json_decode(file_get_contents("https://randomapi.com/api/b2uzhnqj?key=9451-JF6K-R2DE-5CJP"))->results[0]->people;
foreach ($jsonData AS $data){
    $compData = [
        "name" => $data->name,
        "description" => $data->description,
        "phonenumber" => $data->phonenumber,
    ];
    $companies[] = Company::insert($compData);
}

/***
 * Lien entre les entreprises et les professions
 */
/** @var Company $company */
foreach ($companies AS $company){
    CompanyHasProfession::insert(
        [
            "company_id" => $company->getId(),
            "profession_id" => $professionsModel[rand(0, count($professionsModel) - 1)]->getId()
        ]
    );
}

/**
 * Ajout de 500 clients
 * Ajout de 200 personnes dans les entreprises (4 par entreprises)
 */
$clientsList = json_decode(file_get_contents("https://randomuser.me/api/?results=500&nat=fr"))->results;
$entrepreneurList = json_decode(file_get_contents("https://randomuser.me/api/?results=200&nat=fr"))->results;

$users = [];

foreach ($clientsList AS $client){
    $users[] = \Magenda\Model\User::insert([
        "firstname" => $client->name->first,
        "lastname" => $client->name->last,
        "email" => $client->email,
        "password" => User::hashPassword($client->login->password),
        "phonenumber"=> "+336".rand(10000000, 99999999),
        //"company_id" => $companies[rand(0, count($companies) - 1)]->getId()
    ]);
}
foreach ($entrepreneurList AS $client){
    \Magenda\Model\User::insert([
        "firstname" => $client->name->first,
        "lastname" => $client->name->last,
        "email" => $client->email,
        "password" => User::hashPassword($client->login->password),
        "phonenumber"=> "+336".rand(10000000, 99999999),
        "company_id" => $companies[rand(0, count($companies) - 1)]->getId()
    ]);
}

/**
 * Insertion des 'events'
 * 1 event toutes les 1h ou 30minutes par entreprises
 * pendant 2 semaines entre 10h et 17h
 */
foreach($companies AS $company){
    $initDate = new DateTime('2018-01-01 10:00:00');
    $endDate = new DateTime('2018-01-20 10:00:00');
    $currentDate = new DateTime($initDate->format("Y-m-d H:i:s"));
    do{
        \Magenda\Model\Event::insert([
            "startdatetime" => $currentDate->format("Y-m-d H:i:s"),
            "enddatetime" => $currentDate->add(new DateInterval('PT'.[30,60][rand(0,1)].'M'))->format("Y-m-d H:i:s"),
            "company_id" => $company->getId(),
            "price" => rand(10,500),
            "user_id" => (rand(0,100)%2 == 0)?null:$users[rand(0, count($users) -1)]->getId(),
        ]);

        if(intval($currentDate->format("H")) > 17){
            $currentDate = new DateTime(
                $currentDate->format("Y-m-d")." 10:00:00"
            );
            $currentDate->add(new DateInterval('PT1440M'));
        }
    }while($currentDate < $endDate);
}