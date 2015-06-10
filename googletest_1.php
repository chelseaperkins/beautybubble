<?php
require 'vendor/autoload.php';

define('APPLICATION_NAME', 'Google Calendar API Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/calendar-api-quickstart.json');
define('CLIENT_SECRET_PATH', 'client_secret.json');
define('SCOPES', implode(' ', array(
  Google_Service_Calendar::CALENDAR)
));

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getGoogleCalendarService() {
    //$client_id = '176746812940-4r3cmc1ivfbsvceq77jl8cvtqq46r0g5.apps.googleusercontent.com';
    //$Email_address = '176746812940-4r3cmc1ivfbsvceq77jl8cvtqq46r0g5@developer.gserviceaccount.com';	 
    $settings_file_location = 'beautybubblewebsitekey.json';	 	
    
    $settings = json_decode(file_get_contents($settings_file_location), true);
    
    //print $settings['private_key'];

    
    $client = new Google_Client();	 	
    $client->setApplicationName("beautybubblewebsite");
    $key = $settings['private_key'];	 
    $Email_address = $settings['client_email'];
    $client_id = $settings['client_id'];
    // separate additional scopes with a comma	 
    $scopes ="https://www.googleapis.com/auth/calendar"; 	
    $cred = new Google_Auth_AssertionCredentials(	 
            $Email_address,	 	 
            array($scopes),	 	
            $key	 	 
            );	 	
    $client->setAssertionCredentials($cred);
    if($client->getAuth()->isAccessTokenExpired()) {	 	
            $client->getAuth()->refreshTokenWithAssertion($cred);	 	
    }	 	
    return new Google_Service_Calendar($client); 
}

function getEvents($service, $calenderId) {
    $results = $service->events->listEvents($calenderId);
    if (count($results->getItems()) == 0) {
      print "No upcoming events found.\n";
    } else {
      print "Upcoming events:\n";
      foreach ($results->getItems() as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
          $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
      }
    }
    return $results;
}

function addEvent($service, $calendarId) {
  $event = new Google_Service_Calendar_Event(array(
    'summary' => 'Google I/O 2015',
    'status' => 'tentative',
    'location' => '800 Howard St., San Francisco, CA 94103',
    'description' => 'A chance to hear more about Google\'s developer products.',
    'creator' => array(
      'displayName' => 'Website',
    ),
    'start' => array(
      'dateTime' => '2015-06-07T09:00:00-07:00',
      'timeZone' => 'America/Los_Angeles',
    ),
    'end' => array(
      'dateTime' => '2015-06-07T17:00:00-07:00',
      'timeZone' => 'America/Los_Angeles',
    ),
    'recurrence' => array(
      //'RRULE:FREQ=DAILY;COUNT=2'
    ),
    'attendees' => array(
      array('email' => 'lpage@example.com'),
      array('email' => 'sbrin@example.com'),
    ),
    'reminders' => array(
      'useDefault' => FALSE,
      'overrides' => array(
        array('method' => 'email', 'minutes' => 24 * 60),
        array('method' => 'sms', 'minutes' => 10),
      ),
    ),
  ));

  $eventResult = $service->events->insert($calendarId, $event);
  printf('Event created: %s\n', $eventResult->htmlLink);
}

$service = getGoogleCalendarService();

$calendarList  = $service->calendarList->listCalendarList();
if (count($calendarList->getItems()) == 0) {
      print "No calenders found.\n";
}
foreach ($calendarList->getItems() as $calendarListEntry) {
    
    print $calendarListEntry->id;
    addEvent($service, $calendarListEntry->id);
    getEvents($service, $calendarListEntry->id);
}
exit;

$calendarId = 'primary';
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => TRUE,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);

if (count($results->getItems()) == 0) {
  print "No upcoming events found.\n";
} else {
  print "Upcoming events:\n";
  foreach ($results->getItems() as $event) {
    $start = $event->start->dateTime;
    if (empty($start)) {
      $start = $event->start->date;
    }
    printf("%s (%s)\n", $event->getSummary(), $start);
  }
}


