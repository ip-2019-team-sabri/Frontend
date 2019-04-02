<?php
/*
  Plugin Name: Integration Project - API plugin
  Plugin URI: https://github.com/ip-2019-team-sabri/Frontend
  Description: API for Integration Project 2Ba Dig-X. Team: Sabri/Frontend - Bram De Plekker, Charles White and Jetse Smeyers.
  Version: 1.0
  Author: Jetse Smeyers
  License: GPLv2+
  Text Domain: integration_project
*/

function connectToDB() {
    require_once('/var/www/html/wordpress/wp-config.php');

    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    return $db;
}

class integration_project {

    function __construct() {

        add_action('rest_api_init', function () {
           register_rest_route('ip', '/test', array(
               'methods' => 'GET',
               'callback' => __CLASS__ . '::test',
           ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('ip', '/testDB', array(
                'methods' => 'GET',
                'callback' => __CLASS__ . '::testDB',
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('ip', '/organisatie', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakOrganisatie',
                'args' => array(
                    'organisatieUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'eventUUID' => array(
                        'type' => 'string'
                    ),
                    'verantwoordelijke' => array(
                        'type' => 'string'
                    ),
                    'telefoonnummer' => array(
                        'type' => 'string'
                    ),
                    'email' => array(
                        'type' => 'string'
                    ),
                    'adres' => array(
                        'type' => 'string'
                    ),
                    'btwnummer' => array(
                        'type' => 'string'
                    ),
                    'bankrekeningnummer' => array(
                        'type' => 'string'
                    ),
                    'website' => array(
                        'type' => 'string'
                    ),
                    'isActief' => array(
                        'type' => 'boolean',
                        'required' => true
                    ),
                    'versienummer' => array(
                        'type' => 'integer',
                        'required' => true
                    )
                ),
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('ip', '/event', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakEvent',
                'args' => array(
                    'eventUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'naam' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'organisatieUUID' => array(
                        'type' => 'string'
                    ),
                    'omschrijving' => array(
                        'type' => 'string'
                    ),
                    'startDatum' => array(
                        'type' => 'string'
                    ),
                    'eindDatum' => array(
                        'type' => 'string'
                    ),
                    'adres' => array(
                        'type' => 'string'
                    ),
                    'beschikbarePlaatsen' => array(
                        'type' => 'integer'
                    ),
                    'isActief' => array(
                        'type' => 'boolean',
                        'required' => true
                    ),
                    'versienummer' => array(
                        'type' => 'integer',
                        'required' => true
                    )
                ),
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('ip', '/sessie', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakSessie',
                'args' => array(
                    'sessieUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'naam' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'omschrijving' => array(
                        'type' => 'string'
                    ),
                    'organisatieUUID' => array(
                        'type' => 'string'
                    ),
                    'gastspreker' => array(
                        'type' => 'string'
                    ),
                    'startDatum' => array(
                        'type' => 'string'
                    ),
                    'eindDatum' => array(
                        'type' => 'string'
                    ),
                    'plaats' => array(
                        'type' => 'string'
                    ),
                    'kostprijsSessie' => array(
                        'type' => 'number'
                    ),
                    'beschikbarePlaatsen' => array(
                        'type' => 'integer'
                    ),
                    'benodigdheden' => array(
                        'type' => 'string'
                    ),
                    'isReserverend' => array(
                        'type' => 'boolean'
                    ),
                    'isActief' => array(
                        'type' => 'boolean',
                        'required' => true
                    ),
                    'versienummer' => array(
                        'type' => 'integer',
                        'required' => true
                    )
                ),
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('ip', '/werknemer', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakWerknemer',
                'args' => array(
                    'werknemerUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'badgeUUID' => array(
                        'type' => 'string'
                    ),
                    'achternaam' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'voornaam' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'email' => array(
                        'type' => 'string'
                    ),
                    'adres' => array(
                        'type' => 'string'
                    ),
                    'btwnummer' => array(
                        'type' => 'string'
                    ),
                    'bankrekeningnummer' => array(
                        'type' => 'string'
                    ),
                    'typeWerknemer' => array(
                        'type' => 'string'
                    ),
                    'isAanwezig' => array(
                        'type' => 'boolean'
                    ),
                    'isGeblokkeerd' => array(
                        'type' => 'boolean'
                    ),
                    'isActief' => array(
                        'type' => 'boolean',
                        'required' => true
                    ),
                    'versienummer' => array(
                        'type' => 'integer',
                        'required' => true
                    )
                ),
            ));
        });

        add_action('rest_api_init', function () {
            register_rest_route('ip', '/bezoeker', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakBezoeker',
                'args' => array(
                    'bezoekerUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'badgeUUID' => array(
                        'type' => 'string'
                    ),
                    'achternaam' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'voornaam' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'email' => array(
                        'type' => 'string'
                    ),
                    'adres' => array(
                        'type' => 'string'
                    ),
                    'btwnummer' => array(
                        'type' => 'string'
                    ),
                    'bankrekeningnummer' => array(
                        'type' => 'string'
                    ),
                    'isAanwezig' => array(
                        'type' => 'boolean'
                    ),
                    'isGeblokkeerd' => array(
                        'type' => 'boolean'
                    ),
                    'isActief' => array(
                        'type' => 'boolean',
                        'required' => true
                    ),
                    'versienummer' => array(
                        'type' => 'integer',
                        'required' => true
                    )
                ),
            ));
        });

    }

    function test(WP_REST_Request $request) {

        connectToDB();

        return 'Connection with database is OK. This API is working correctly!';
    }

    function testDB(WP_REST_Request $request) {

        $db = connectToDB();

        $query = "
            INSERT INTO `organisaties` (`organisatieUUID`, `eventUUID`, `verantwoordelijke`, `telefoonnummer`, `email`, `adres`, `btwnummer`, `bankrekeningnummer`, `website`, `isActief`, `versienummer`) 
            VALUES ('test001', 'test_event', 'test_verantwoordelijke', NULL, NULL, NULL, NULL, NULL, NULL, TRUE, '0')
        ;";

        if ($db->query($query) === TRUE) {
            return "Testorganisatie succesvol gecreëerd.";
        }
        else {
            return "Aanmaken testorganisatie niet gelukt: databasefout {$db->error}";
        }
    }

    function maakOrganisatie(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $organisatieUUID = $request->get_param('organisatieUUID');
        $eventUUID = $request->get_param('eventUUID');
        $verantwoordelijke = $request->get_param('verantwoordelijke');
        $telefoonnummer = $request->get_param('telefoonnummer');
        $email = $request->get_param('email');
        $adres = $request->get_param('adres');
        $btwnummer = $request->get_param('btwnummer');
        $bankrekeningnummer = $request->get_param('bankrekeningnummer');
        $website = $request->get_param('website');
        $isActief = $request->get_param('isActief');
        $versienummer = $request->get_param('versienummer');


        //Checken of organisatie al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `organisaties` 
            WHERE `organisatieUUID` = '$organisatieUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //organisatie bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO organisaties (organisatieUUID, eventUUID, verantwoordelijke, telefoonnummer, email, adres, btwnummer, bankrekeningnummer, website, isActief, versienummer)
                VALUES ('$organisatieUUID', '$eventUUID', '$verantwoordelijke', '$telefoonnummer', '$email', '$adres', '$btwnummer', '$bankrekeningnummer', '$website', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return "Organisatie {$organisatieUUID} succesvol gecreëerd.";
            }
            else {
                return "Aanmaken organisatie {$organisatieUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//organisatie bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE organisaties
				    SET eventUUID = '$eventUUID', verantwoordelijke = '$verantwoordelijke', telefoonnummer = '$telefoonnummer', email = '$email', adres = '$adres', btwnummer = '$btwnummer', bankrekeningnummer = '$bankrekeningnummer', website = '$website', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE organisatieUUID = '$organisatieUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return "Organisatie {$organisatieUUID} succesvol geupdate.";
                }
                else {
                    return "Aanmaken organisatie {$organisatieUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return "Organisatie {$organisatieUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakEvent(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $eventUUID = $request->get_param('eventUUID');
        $naam = $request->get_param('naam');
        $organisatieUUID = $request->get_param('organisatieUUID');
        $omschrijving = $request->get_param('omschrijving');
        $startDatum = $request->get_param('startDatum');
        $eindDatum = $request->get_param('eindDatum');
        $adres = $request->get_param('adres');
        $beschikbarePlaatsen = $request->get_param('beschikbarePlaatsen');
        $isActief = $request->get_param('isActief');
        $versienummer = $request->get_param('versienummer');


        //Checken of organisatie al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `events` 
            WHERE `eventUUID` = '$eventUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //event bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `events`(`eventUUID`, `naam`, `organisatieUUID`, `omschrijving`, `startDatum`, `eindDatum`, `adres`, `beschikbarePlaatsen`, `isActief`, `versienummer`)
                VALUES ('$eventUUID', '$naam', '$organisatieUUID', '$omschrijving', '$startDatum', '$eindDatum', '$adres', '$beschikbarePlaatsen', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return "Event {$eventUUID} succesvol gecreëerd.";
            }
            else {
                return "Aanmaken event {$eventUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//event bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE events
				    SET naam = '$naam', organisatieUUID = '$organisatieUUID', omschrijving = '$omschrijving', startDatum = '$startDatum', eindDatum = '$eindDatum', adres = '$adres', beschikbarePlaatsen = '$beschikbarePlaatsen', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE eventUUID = '$eventUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return "Event {$eventUUID} succesvol geupdate.";
                }
                else {
                    return "Aanmaken event {$eventUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return "Event {$eventUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakSessie(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $sessieUUID = $request->get_param('sessieUUID');
        $naam = $request->get_param('naam');
        $omschrijving = $request->get_param('omschrijving');
        $organisatieUUID = $request->get_param('organisatieUUID');
        $gastspreker = $request->get_param('gastspreker');
        $startDatum = $request->get_param('startDatum');
        $eindDatum = $request->get_param('eindDatum');
        $plaats = $request->get_param('plaats');
        $kostprijsSessie = $request->get_param('kostprijsSessie');
        $beschikbarePlaatsen = $request->get_param('beschikbarePlaatsen');
        $benodigdheden = $request->get_param('benodigdheden');
        $isReserverend = $request->get_param('isReserverend');
        $isActief = $request->get_param('isActief');
        $versienummer = $request->get_param('versienummer');


        //Checken of organisatie al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `sessies` 
            WHERE `sessieUUID` = '$sessieUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //organisatie bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `sessies`(`sessieUUID`, `naam`, `omschrijving`, `organisatieUUID`, `gastspreker`, `startDatum`, `eindDatum`, `plaats`, `kostprijsSessie`, `beschikbarePlaatsen`, `benodigdheden`, `isReserverend`, `isActief`, `versienummer`)
                VALUES ('$sessieUUID', '$naam', '$omschrijving', '$organisatieUUID', '$gastspreker', '$startDatum', '$eindDatum', '$plaats', '$kostprijsSessie', '$beschikbarePlaatsen', '$benodigdheden', '$isReserverend', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return "Sessie {$sessieUUID} succesvol gecreëerd.";
            }
            else {
                return "Aanmaken sessie {$sessieUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//sessie bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE sessies
				    SET naam = '$naam', omschrijving = '$omschrijving', organisatieUUID = '$organisatieUUID', gastspreker = '$gastspreker', startDatum = '$startDatum', eindDatum = '$eindDatum', plaats = '$plaats', kostprijsSessie = '$kostprijsSessie', beschikbarePlaatsen = '$beschikbarePlaatsen', benodigdheden = '$benodigdheden', isReserverend = '$isReserverend', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE sessieUUID = '$sessieUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return "Sessie {$sessieUUID} succesvol geupdate.";
                }
                else {
                    return "Aanmaken sessie {$sessieUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return "Sessie {$sessieUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakWerknemer(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $werknemerUUID = $request->get_param('werknemerUUID');
        $badgeUUID = $request->get_param('badgeUUID');
        $achternaam = $request->get_param('achternaam');
        $voornaam = $request->get_param('voornaam');
        $email = $request->get_param('email');
        $adres = $request->get_param('adres');
        $btwnummer = $request->get_param('btwnummer');
        $bankrekeningnummer = $request->get_param('bankrekeningnummer');
        $typeWerknemer = $request->get_param('typeWerknemer');
        $isAanwezig = $request->get_param('isAanwezig');
        $isGeblokkeerd = $request->get_param('isGeblokkeerd');
        $isActief = $request->get_param('isActief');
        $versienummer = $request->get_param('versienummer');


        //Checken of organisatie al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `werknemers` 
            WHERE `werknemerUUID` = '$werknemerUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //werknemer bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `werknemers`(`werknemerUUID`, `badgeUUID`, `achternaam`, `voornaam`, `email`, `adres`, `btwnummer`, `bankrekeningnummer`, `typeWerknemer`, `isAanwezig`, `isGeblokkeerd`, `isActief`, `versienummer`)
                VALUES ('$werknemerUUID', '$badgeUUID', '$achternaam', '$voornaam', '$email', '$adres', '$btwnummer', '$bankrekeningnummer', '$typeWerknemer', '$isAanwezig', '$isGeblokkeerd', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return "Werknemer {$werknemerUUID} succesvol gecreëerd.";
            }
            else {
                return "Aanmaken werknemer {$werknemerUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//werknemer bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE werknemers
				    SET badgeUUID = '$badgeUUID', achternaam = '$achternaam', voornaam = '$voornaam', email = '$email', adres = '$adres', btwnummer = '$btwnummer', bankrekeningnummer = '$bankrekeningnummer', typeWerknemer = '$typeWerknemer', isAanwezig = '$isAanwezig', isGeblokkeerd = '$isGeblokkeerd', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE werknemerUUID = '$werknemerUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return "Werknemer {$werknemerUUID} succesvol geupdate.";
                }
                else {
                    return "Aanmaken werknemer {$werknemerUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return "Werknemer {$werknemerUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakBezoeker(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $bezoekerUUID = $request->get_param('bezoekerUUID');
        $badgeUUID = $request->get_param('badgeUUID');
        $achternaam = $request->get_param('achternaam');
        $voornaam = $request->get_param('voornaam');
        $email = $request->get_param('email');
        $adres = $request->get_param('adres');
        $btwnummer = $request->get_param('btwnummer');
        $bankrekeningnummer = $request->get_param('bankrekeningnummer');
        $isAanwezig = $request->get_param('isAanwezig');
        $isGeblokkeerd = $request->get_param('isGeblokkeerd');
        $isActief = $request->get_param('isActief');
        $versienummer = $request->get_param('versienummer');


        //Checken of organisatie al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `bezoekers` 
            WHERE `bezoekerUUID` = '$bezoekerUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //bezoeker bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `bezoekers`(`bezoekerUUID`, `badgeUUID`, `achternaam`, `voornaam`, `email`, `adres`, `btwnummer`, `bankrekeningnummer`, `isAanwezig`, `isGeblokkeerd`, `isActief`, `versienummer`)
                VALUES ('$bezoekerUUID', '$badgeUUID', '$achternaam', '$voornaam', '$email', '$adres', '$btwnummer', '$bankrekeningnummer', '$isAanwezig', '$isGeblokkeerd', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return "Bezoeker {$bezoekerUUID} succesvol gecreëerd.";
            }
            else {
                return "Aanmaken bezoeker {$bezoekerUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//werknemer bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE bezoekers
				    SET badgeUUID = '$badgeUUID', achternaam = '$achternaam', voornaam = '$voornaam', email = '$email', adres = '$adres', btwnummer = '$btwnummer', bankrekeningnummer = '$bankrekeningnummer', isAanwezig = '$isAanwezig', isGeblokkeerd = '$isGeblokkeerd', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE bezoekerUUID = '$bezoekerUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return "Bezoeker {$bezoekerUUID} succesvol geupdate.";
                }
                else {
                    return "Aanmaken bezoeker {$bezoekerUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return "Bezoeker {$bezoekerUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

}

new integration_project();

?>