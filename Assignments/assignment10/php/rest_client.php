<?php

function getWeather()
{
    $apiUrl = "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php";
    $searchTerm = $_POST['zip_code'];
    $encodedSearchTerm = urlencode($searchTerm);

    // Initialize cURL session for API call
    $ch = curl_init();

    // Set the URL with search parameter
    curl_setopt($ch, CURLOPT_URL, "$apiUrl?zip_code=$encodedSearchTerm");

    // Ensure cURL returns the response as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and get the response
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        $acknowledgement = curl_error($ch);
        $output = "";
        return [$acknowledgement, $output];
    } else {
        // Decode JSON response into PHP array
        $result = json_decode($response, true);
        if (isset($result['error'])) {
            $acknowledgement = $result['error'];
            $output = "";
            curl_close($ch);
            return [$acknowledgement, $output];
        }
        $higherTemp = $result['higher_temperatures'];
        $lowerTemp = $result['lower_temperatures'];

        $acknowledgement = "";

        $output = "<h2>{$result['searched_city']['name']}</h2>";
        $output .= "<p><strong>Temperature:</strong> {$result['searched_city']['temperature']}</p>";
        $output .= "<p><strong>Humidity:</strong> {$result['searched_city']['humidity']}</p>";

        $output .= "<p><strong>3-day forecast</strong></p>";
        $output .= "<ul>";
        foreach ($result['searched_city']['forecast'] as $dayForecast) {
            $day = $dayForecast['day'];
            $condition = $dayForecast['condition'];
            $output .= "<li>{$day}: {$condition}</li>";
        }
        $output .= "</ul>";

        if (!empty($higherTemp)) {
            $output .= "<p><strong>Up to three cities where temperatures are higher than {$result['searched_city']['name']}</strong></p>";
            $output .= "<table class=\"table table-striped\">";
            $output .= "<thead><tr><th>City Name</th><th>Temperature</th></tr></thead><tbody>";
            $count = 0;
            foreach ($higherTemp as $row) {
                if ($count >= 3)
                    break;
                $output .= "<tr><td>{$row['name']}</td><td>{$row['temperature']}</td></tr>";
                $count++;
            }
            $output .= "</tbody></table>";
        } else {
            $output .= "<p><strong>There are no cities where temperatures are higher than {$result['searched_city']['name']}</strong></p>";
        }

        if (!empty($lowerTemp)) {
            $output .= "<p><strong>Up to five cities where temperatures are lower than {$result['searched_city']['name']}</strong></p>";
            $output .= "<table class=\"table table-striped\">";
            $output .= "<thead><tr><th>City Name</th><th>Temperature</th></tr></thead><tbody>";
            $count = 0;
            foreach ($lowerTemp as $row) {
                if ($count >= 5)
                    break;
                $output .= "<tr><td>{$row['name']}</td><td>{$row['temperature']}</td></tr>";
                $count++;
            }
            $output .= "</tbody></table>";
        } else {
            $output .= "<p><strong>There are no cities where temperatures are lower than {$result['searched_city']['name']}</strong></p>";
        }

        return [$acknowledgement, $output];


    }
}
?>