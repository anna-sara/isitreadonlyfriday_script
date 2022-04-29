<?php
// Initialize an URL to the variable
$url = "https://isitreadonlyfriday.com/api/isitreadonlyfriday/2";

// Use get_headers() function
$headers = @get_headers($url);

// Use condition to check the existence of URL
if($headers && strpos( $headers[0], '200')) {

    // Get json respone from URL
    $url_json = file_get_contents($url);
    $url_json_data = json_decode($url_json);

    // Get data from json-files with messages
    $messages_json = json_decode(file_get_contents('messages.txt'), true);

    // Get number of the weekdaynumber for this day
    $day_of_week = getWeekday(date("h:i:sa")); 

    
  
    // Check if readonly is true och false. If true it will print message.
    if ($url_json_data->readonly == 1) {
        // Choose random message to print
        //$random_message_friday = $messages_json['Friday'][array_rand($messages_json['Friday'])];
        //print($random_message_friday['message']);
        print("Remember, readonly friday today!");
    } else if ($url_json_data->readonly == 0 && $day_of_week == 6 ){
        // Choose random message to print
        $random_message_weekend = $messages_json['Weekend'][array_rand($messages_json['Weekend'])];
        //Print random message
        print($random_message_weekend['message']);
    } else if ($url_json_data->readonly == 0 && $day_of_week == 7 ){
         // Choose random message to print
         $random_message_weekend = $messages_json['Weekend'][array_rand($messages_json['Weekend'])];
         //Print random message
        print($random_message_weekend['message']);
    } else {
         // Choose random message to print
         $random_message_weekday = $messages_json['Weekday'][array_rand($messages_json['Weekday'])];
         // Print message
        print($random_message_weekday['message']);
    }
}

// Function to get number of current day of the week (monday = 1, tuesday = 2....)
function getWeekday($date) {
    return date('w', strtotime($date));
}
?>
