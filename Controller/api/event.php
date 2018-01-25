<?php

// Nous commencons par
// verifier si une action
// existe, sinon nous
// en indicons une par defaut
use Magenda\Model\Event;
use Magenda\Model\User;

if(strlen($action) <= 0){
    $action = "selectAll";
}

if($userConnected instanceof User){
    switch ($action){
        case "addEvent":
            $result = ["success" => false];
            if(
                array_key_exists("idcompany", $_POST) && !empty($_POST["idcompany"]) && is_numeric($_POST["idcompany"]) &&
                array_key_exists("start", $_POST) && !empty($_POST["start"]) &&
                array_key_exists("end", $_POST) && !empty($_POST["end"])
            ) {
                Event::insert([
                    "startdatetime" => $_POST["start"],
                    "enddatetime" => $_POST["end"],
                    "company_id" => $_POST["idcompany"]
                ]);
                $result = ["success" => true];
            }
            echo json_encode($result);
            break;
        case "selectAll":
            $whereTable = [];
            if(array_key_exists("idcompany", $_POST) && !empty($_POST["idcompany"]) && is_numeric($_POST["idcompany"])){
                $idcompany = intval($_POST["idcompany"]);
                $whereTable = [
                    "company_id" => $idcompany
                ];
            }else if( array_key_exists("iduser", $_POST)){
                $iduser = intval($_POST["iduser"]);
                $whereTable = [
                    "user_id" => $iduser
                ];
            }
            $allEventsOfCompany = Event::selectWhere($whereTable);
            $result = [];
            /** @var Event $event */
            foreach ($allEventsOfCompany AS $event){
                $currentArray = [];
                $currentArray = $event->toArray();
                $currentArray["start"] = $event->getStartdatetimeString();
                $currentArray["end"] = $event->getEnddatetimeString();
                $currentArray["editable"] = false;
                if($event->getUserId() > 0){
                    $currentArray["title"] = "Réservé";
                    $currentArray["backgroundColor"] = "#CCC";
                    if($userConnected->getCompanyId() == $idcompany){
                        $currentArray["editable"] = true;
                        $currentArray["title"] = $event->getUser()->getFirstname()." ".$event->getUser()->getLastname();
                    }else if($event->getUserId() == $userConnected->getId()){
                        $currentArray["backgroundColor"] = "green";
                        $currentArray["title"] .= " par vous";
                    }

                    if($iduser > 0){
                        $currentArray["title"] = $event->getCompany()->getName();
                    }
                }else{
                    if($userConnected->getCompanyId() == $idcompany){
                        $currentArray["editable"] = true;
                    }
                    $currentArray["title"] = "Disponible";
                }
                $result[] = $currentArray;
            }
            echo json_encode($result);
            break;
        case "updateStartDate":
            $result = ["success" => false];
            if(
                array_key_exists("idevent", $_POST) && !empty($_POST["idevent"]) && is_numeric($_POST["idevent"]) &&
                array_key_exists("minutes", $_POST) && !empty($_POST["minutes"]) && is_numeric($_POST["minutes"])
            ){
                $idEvent = intval($_POST["idevent"]);
                $minutes = intval($_POST["minutes"]);
                $event = Event::select($idEvent);
                if($event instanceof Event){
                    if($minutes > 0){
                        $newStartDate = $event->getStartdatetimeDateTime()->add(new DateInterval("PT".$minutes."M"));
                    }else{
                        $newStartDate = $event->getStartdatetimeDateTime()->sub(new DateInterval("PT".($minutes*-1)."M"));
                    }
                    $event->update(["startdatetime" => $newStartDate->format("Y-m-d H:i:s")]);
                    $result["success"] = true;
                }
            }
            echo json_encode($result);
            break;
        case "updateEndDate":
            $result = ["success" => false];
            if(
                array_key_exists("idevent", $_POST) && !empty($_POST["idevent"]) && is_numeric($_POST["idevent"]) &&
                array_key_exists("minutes", $_POST) && !empty($_POST["minutes"]) && is_numeric($_POST["minutes"])
            ){
                $idEvent = intval($_POST["idevent"]);
                $minutes = intval($_POST["minutes"]);
                $event = Event::select($idEvent);
                if($event instanceof Event){
                    if($minutes > 0){
                        $newStartDate = $event->getEnddatetimeDateTime()->add(new DateInterval("PT".$minutes."M"));
                    }else{
                        $newStartDate = $event->getEnddatetimeDateTime()->sub(new DateInterval("PT".($minutes*-1)."M"));
                    }
                    $event->update(["enddatetime" => $newStartDate->format("Y-m-d H:i:s")]);
                    $result["success"] = true;
                }
            }
            echo json_encode($result);
            break;
        case "setMeOn":
            $result = ["success" => false];
            if(
                array_key_exists("idevent", $_POST) && !empty($_POST["idevent"]) && is_numeric($_POST["idevent"])
            ){
                $idEvent = intval($_POST["idevent"]);
                $event = Event::select($idEvent);
                if($event instanceof Event){
                    $userID = $userConnected->getId();
                    $event->update(["user_id" => $userID]);
                    $result["success"] = true;
                    $result["user_id"] = $userID;
                }
            }
            echo json_encode($result);
            break;
        case "setNotMeOn":
            $result = ["success" => false];
            if(
                array_key_exists("idevent", $_POST) && !empty($_POST["idevent"]) && is_numeric($_POST["idevent"])
            ){
                $idEvent = intval($_POST["idevent"]);
                $event = Event::select($idEvent);
                if($event instanceof Event){
                    $userID = $userConnected->getId();
                    $event->update(["user_id" => null]);
                    $result["success"] = true;
                    $result["user_id"] = $userID;
                }
            }
            echo json_encode($result);
            break;
    }
}
