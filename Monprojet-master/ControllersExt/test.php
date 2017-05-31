<?php

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
}

require_once __DIR__ . '/vendor/autoload.php';

// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if (isset($_GET['q'])) {
  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * Google API Console <https://console.developers.google.com/>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  $DEVELOPER_KEY = 'AIzaSyBQ0jcFXIsUYswGavQ46ur6zrP6TQLAmeg';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);


  // DISABLE SSL CERTIFICATE VERIFYING  - DEV MODE
  $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
  $client->setHttpClient($guzzleClient);

  $htmlBody = '';
  try {

    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => 1,
      'relevanceLanguage' => 'fr',
      'order' => 'relevance'

    ));

    $videos = '';
    $channels = '';
    $playlists = '';

    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    foreach ($searchResponse['items'] as $searchResult) {
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          //$videos .= sprintf('<li>%s (%s)</li>',
            //$searchResult['snippet']['title'], $searchResult['id']['videoId']);
          $videoId = $searchResult['id']['videoId'];
         
          break;
        case 'youtube#channel':
          // $channels .= sprintf('<li>%s (%s)</li>',
              // $searchResult['snippet']['title'], $searchResult['id']['channelId']);

          break;
        case 'youtube#playlist':
          // $playlists .= sprintf('<li>%s (%s)</li>',
          //     $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
          break;
      }
    }

  } catch (Google_Service_Exception $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}
