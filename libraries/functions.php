<?php

function transDays($day){
    switch($day){
        case 1:
            $day = "lundi";
            break;
        case 2:
            $day = "mardi";
            break;
        case 3:
            $day = "mercredi";
            break;
        case 4:
            $day = "jeudi";
            break;
        case 5:
            $day = "vendredi";
            break;
        case 6:
            $day = "samedi";
            break;
        case 7:
            $day = "dimanche";
            break;
    }
    return $day;
}

function transMonths($month){
    switch($month){
        case "January":
            $month = "janvier";
            break;
        case "February":
            $month = "février";
            break;
        case "March":
            $month = "mars";
            break;
        case "April":
            $month = "avril";
            break;
        case "May":
            $month = "mai";
            break;
        case "June":
            $month = "juin";
            break;
        case "July":
            $month = "juillet";
            break;
        case "August":
            $month = "août";
            break;
        case "September":
            $month = "septembre";
            break;
        case "October":
            $month = "octobre";
            break;
        case "November":
            $month = "novembre";
            break;
        case "December":
            $month = "décembre";
            break;
    }
    return $month;
}

?>