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
            register_rest_route('ip', '/bezoeker', array(
                'methods' => 'GET',
                'callback' => __CLASS__ . '::geefBezoekers',
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

        add_action('rest_api_init', function () {
            register_rest_route('ip', '/groep', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakGroep',
                'args' => array(
                    'groepUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'groepsnaam' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'adminEmail' => array(
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
            register_rest_route('ip', '/kalender', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakKalender',
                'args' => array(
                    'kalenderUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'link' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'type' => array(
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
            register_rest_route('ip', '/taak', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakTaak',
                'args' => array(
                    'taakUUID' => array(
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
                    'startDatum' => array(
                        'type' => 'string'
                    ),
                    'eindDatum' => array(
                        'type' =>'string'
                    ),
                    'aantalPersonen' => array(
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
            register_rest_route('ip', '/shift', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakShift',
                'args' => array(
                    'shiftUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'werknemerUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'taakUUID' => array(
                        'type' => 'string',
                        'required' => true
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
            register_rest_route('ip', '/reservatie', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakReservatie',
                'args' => array(
                    'reservatieUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'bezoekerUUID' => array(
                        'type' => 'string'
                    ),
                    'sessieUUID' => array(
                        'type' => 'string'
                    ),
                    'groepUUID' => array(
                        'type' => 'string'
                    ),
                    'betaalstatus' => array(
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
            register_rest_route('ip', '/registratie', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakRegistratie',
                'args' => array(
                    'registratieUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'bezoekerUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'betaalstatus' => array(
                        'type' => 'boolean'
                    ),
                    'isAanwezig' => array(
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
            register_rest_route('ip', '/locatie', array(
                'methods' => 'POST',
                'callback' => __CLASS__ . '::maakLocatie',
                'args' => array(
                    'locatieUUID' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'locatie' => array(
                        'type' => 'string',
                        'required' => true
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
    
    function geefBezoekers(WP_REST_Request $request) {

            $db = connectToDB();

            
            $query = "
                SELECT * 
                FROM `bezoekers` 
            ;";

            return $db->query($query);
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
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
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
                return 0; //"Organisatie {$organisatieUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken organisatie {$organisatieUUID} niet gelukt: databasefout {$db->error}";
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
                    return 0; //"Organisatie {$organisatieUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken organisatie {$organisatieUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Organisatie {$organisatieUUID} werd niet geupdate: inhoud verouderd.";
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
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of event al aanwezig is met hoger versienummer.
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
                return 0; //"Event {$eventUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken event {$eventUUID} niet gelukt: databasefout {$db->error}";
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
                    return 0; //"Event {$eventUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken event {$eventUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Event {$eventUUID} werd niet geupdate: inhoud verouderd.";
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
        $isReserverend = ($request->get_param('isReserverend') == true ? 1 : 0);
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of sessie al aanwezig is met hoger versienummer.
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
                return 0; //"Sessie {$sessieUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken sessie {$sessieUUID} niet gelukt: databasefout {$db->error}";
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
                    return 0; //"Sessie {$sessieUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken sessie {$sessieUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Sessie {$sessieUUID} werd niet geupdate: inhoud verouderd.";
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
        $isAanwezig = ($request->get_param('isAanwezig') == true ? 1 : 0);
        $isGeblokkeerd = ($request->get_param('isGeblokkeerd') == true ? 1 : 0);
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of werknemer al aanwezig is met hoger versienummer.
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
                return 0; //"Werknemer {$werknemerUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken werknemer {$werknemerUUID} niet gelukt: databasefout {$db->error}";
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
                    return 0; //"Werknemer {$werknemerUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken werknemer {$werknemerUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Werknemer {$werknemerUUID} werd niet geupdate: inhoud verouderd.";
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
        $isAanwezig = ($request->get_param('isAanwezig') == true ? 1 : 0);
        $isGeblokkeerd = ($request->get_param('isGeblokkeerd') == true ? 1 : 0);
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of bezoeker al aanwezig is met hoger versienummer.
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
                return 0; //"Bezoeker {$bezoekerUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken bezoeker {$bezoekerUUID} niet gelukt: databasefout {$db->error}";
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
                    return 0; //"Bezoeker {$bezoekerUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken bezoeker {$bezoekerUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Bezoeker {$bezoekerUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakGroep(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $groepUUID = $request->get_param('groepUUID');
        $groepsnaam = $request->get_param('groepsnaam');
        $adminEmail = $request->get_param('adminEmail');
        $isAanwezig = ($request->get_param('isAanwezig') == true ? 1 : 0);
        $isGeblokkeerd = ($request->get_param('isGeblokkeerd') == true ? 1 : 0);
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of groep al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `groepen` 
            WHERE `groepUUID` = '$groepUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //groep bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `groepen`(`groepUUID`, `groepsnaam`, `adminEmail`, `isAanwezig`, `isGeblokkeerd`, `isActief`, `versienummer`)
                VALUES ('$groepUUID', '$groepsnaam', '$adminEmail', '$isAanwezig', '$isGeblokkeerd', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return 0; //"Groep {$groepUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken groep {$groepUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//groep bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE groepen
				    SET groepsnaam = '$groepsnaam', adminEmail = '$adminEmail', isAanwezig = '$isAanwezig', isGeblokkeerd = '$isGeblokkeerd', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE groepUUID = '$groepUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return 0; //"Groep {$groepUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken groep {$groepUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Groep {$groepUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakKalender(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $kalenderUUID = $request->get_param('kalenderUUID');
        $link = $request->get_param('link');
        $type = $request->get_param('type');
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of kalender al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `kalenders` 
            WHERE `kalenderUUID` = '$kalenderUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //groep bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `kalenders`(`kalenderUUID`, `link`, `type`, `isActief`, `versienummer`)
                VALUES ('$kalenderUUID', '$link', '$type', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return 0; //"Kalender {$kalenderUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken kalender {$kalenderUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//kalender bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE kalenders
				    SET link = '$link', type = '$type', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE kalenderUUID = '$kalenderUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return 0; //"Kalender {$kalenderUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken kalender {$kalenderUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Kalender {$kalenderUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakTaak(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $taakUUID = $request->get_param('taakUUID');
        $naam = $request->get_param('naam');
        $omschrijving = $request->get_param('omschrijving');
        $startDatum = $request->get_param('startDatum');
        $eindDatum = $request->get_param('eindDatum');
        $aantalPersonen = $request->get_param('aantalPersonen');
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of taak al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `taken` 
            WHERE `taakUUID` = '$taakUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //taak bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `taken`(`taakUUID`, `naam`, `omschrijving`, `startDatum`, `eindDatum`, `aantalPersonen`, `isActief`, `versienummer`)
                VALUES ('$taakUUID', '$naam', '$omschrijving', '$startDatum', '$eindDatum', '$aantalPersonen', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return 0; //"Taak {$taakUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken taak {$taakUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//taak bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE taken
				    SET naam = '$naam', omschrijving = '$omschrijving', startDatum = '$startDatum', eindDatum = '$eindDatum', aantalPersonen = '$aantalPersonen', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE taakUUID = '$taakUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return 0; //"Taak {$taakUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken taak {$taakUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Taak {$taakUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakShift(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $shiftUUID = $request->get_param('shiftUUID');
        $werknemerUUID = $request->get_param('werknemerUUID');
        $taakUUID = $request->get_param('taakUUID');
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of shift al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `shiften` 
            WHERE `shiftUUID` = '$shiftUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //shift bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `shiften`(`shiftUUID`, `werknemerUUID`, `taakUUID`, `isActief`, `versienummer`)
                VALUES ('$shiftUUID', '$werknemerUUID', '$taakUUID', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return 0; //"Shift {$shiftUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken shift {$shiftUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//shift bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE shiften
				    SET werknemerUUID = '$werknemerUUID', taakUUID = '$taakUUID', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE shiftUUID = '$shiftUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return 0; //"Shift {$shiftUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken shift {$shiftUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Shift {$shiftUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakReservatie(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $reservatieUUID = $request->get_param('reservatieUUID');
        $bezoekerUUID = $request->get_param('bezoekerUUID');
        $sessieUUID = $request->get_param('sessieUUID');
        $groepUUID = $request->get_param('groepUUID');
        $betaalstatus = ($request->get_param('betaalstatus') == true ? 1 : 0);
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of reservatie al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `reservaties` 
            WHERE `reservatieUUID` = '$reservatieUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //reservatie bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `reservaties`(`reservatieUUID`, `bezoekerUUID`, `sessieUUID`, `groepUUID`, `betaalstatus`, `isActief`, `versienummer`) 
                VALUES ('$reservatieUUID', '$bezoekerUUID', '$sessieUUID', '$groepUUID', '$betaalstatus', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return 0; //"Reservatie {$reservatieUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken reservatie {$reservatieUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//reservatie bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE reservaties
				    SET bezoekerUUID = '$bezoekerUUID', sessieUUID = '$sessieUUID', groepUUID = '$groepUUID', betaalstatus = '$betaalstatus', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE reservatieUUID = '$reservatieUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return 0; //"Reservatie {$reservatieUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken reservatie {$reservatieUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Reservatie {$reservatieUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakRegistratie(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $registratieUUID = $request->get_param('registratieUUID');
        $bezoekerUUID = $request->get_param('bezoekerUUID');
        $betaalstatus = ($request->get_param('betaalstatus') == true ? 1 : 0);
        $isAanwezig = ($request->get_param('isAanwezig') == true ? 1 : 0);
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of registratie al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `registraties` 
            WHERE `registratieUUID` = '$registratieUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //registratie bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `registraties`(`registratieUUID`, `bezoekerUUID`, `betaalstatus`, `isAanwezig`, `isActief`, `versienummer`)
                VALUES ('$registratieUUID', '$bezoekerUUID', '$betaalstatus', '$isAanwezig', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return 0; //"Registratie {$registratieUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken registratie {$registratieUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//registratie bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE registraties
				    SET bezoekerUUID = '$bezoekerUUID', betaalstatus = '$betaalstatus', isAanwezig = '$isAanwezig', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE registratieUUID = '$registratieUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return 0; //"Registratie {$registratieUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken registratie {$registratieUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Registratie {$registratieUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

    function maakLocatie(WP_REST_Request $request) {

        $db = connectToDB();

        //Sla binnengekregen data op in lokale variabelen
        $locatieUUID = $request->get_param('locatieUUID');
        $locatie = $request->get_param('locatie');
        $isActief = ($request->get_param('isActief') == true ? 1 : 0);
        $versienummer = $request->get_param('versienummer');


        //Checken of locatie al aanwezig is met hoger versienummer.
        $query = "
		    SELECT `versienummer` 
            FROM `locaties` 
            WHERE `locatieUUID` = '$locatieUUID'
		;";

        $result = $db->query($query)->fetch_array(MYSQLI_ASSOC);

        if ($result == null) {                    //locatie bestaat nog niet
            //Sql statement
            $query = "
                INSERT INTO `locaties`(`locatieUUID`, `locatie`, `isActief`, `versienummer`)
                VALUES ('$locatieUUID', '$locatie', '$isActief', '$versienummer')
		    ;";

            $result = $db->query($query);


            if ($result === TRUE) {
                return 0; //"Locatie {$locatieUUID} succesvol gecreëerd.";
            }
            else {
                return 1; //"Aanmaken locatie {$locatieUUID} niet gelukt: databasefout {$db->error}";
            }
        }
        else {
            if ($result['versienummer'] < $versienummer) { 		//locatie bestaat maar frontend heeft lager versienummer
                //Sql statement
                $query = "
				    UPDATE locaties
				    SET locatie = '$locatie', isActief = '$isActief', versienummer = '$versienummer'
				    WHERE locatieUUID = '$locatieUUID'
			    ;";

                $result = $db->query($query);

                if ($result === TRUE) {
                    return 0; //"Locatie {$locatieUUID} succesvol geupdate.";
                }
                else {
                    return 1; //"Aanmaken locatie {$locatieUUID} niet gelukt: databasefout {$db->error}";
                }
            }
            else {									//versienummer is lager dan in database frontend
                return 2; //"Locatie {$locatieUUID} werd niet geupdate: inhoud verouderd.";
            }
        }
    }

}

new integration_project();

?>