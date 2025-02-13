<!-- SQL Query to create database and tables for countryCityAPI.php

-- Drop existing tables if they exist (to avoid conflicts)
DROP TABLE IF EXISTS cities;
DROP TABLE IF EXISTS states;
DROP TABLE IF EXISTS countries;

-- 1️⃣ Create Countries Table
CREATE TABLE countries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    country_code VARCHAR(10) NOT NULL UNIQUE,
    country_name VARCHAR(100) NOT NULL,
    region VARCHAR(50) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2️⃣ Create States Table
CREATE TABLE states (
    id INT AUTO_INCREMENT PRIMARY KEY,
    state_code VARCHAR(10) NOT NULL,
    state_name VARCHAR(100) NOT NULL,
    country_code VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (country_code) REFERENCES countries(country_code) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE (state_code, country_code) -- Ensures state_code is unique per country
);

-- 3️⃣ Create Cities Table
CREATE TABLE cities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city_name VARCHAR(100) NOT NULL,
    state_code VARCHAR(10) NOT NULL,
    country_code VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (state_code, country_code) REFERENCES states(state_code, country_code) ON DELETE CASCADE ON UPDATE CASCADE
);
-->


<?php

ini_set('max_execution_time', 0); // Allow unlimited execution time

// Database credentials
$host = "localhost";
$dbname = "sample2";
$username = "root";
$password = "";

// Geonames API username
$geoUsername = "nerandadilhara"; 

// Global API request counter
$requestCount = 0;
$maxRequestsPerHour = 900; // Limit to 900 requests to stay safe

// Connect to MySQL database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Function to fetch data from an API with rate limiting
function fetchApiData($url) {
    global $requestCount, $maxRequestsPerHour;

    // Pause for 1 hour if reaching the limit
    if ($requestCount >= $maxRequestsPerHour) {
        echo "⏳ API limit reached. Waiting 1 hour before continuing...<br>";
        flush();
        sleep(3600); // Wait for 1 hour
        $requestCount = 0; // Reset counter after waiting
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        return false;
    }
    curl_close($ch);

    $requestCount++; // Increment request counter
    return json_decode($response, true);
}

// 1️⃣ Fetch Countries from RestCountries API
$countriesUrl = "https://restcountries.com/v3.1/all";
$countries = fetchApiData($countriesUrl);

if ($countries) {
    foreach ($countries as $country) {
        $countryCode = $country['cca2'] ?? null;
        $countryName = $country['name']['common'] ?? null;
        $region = $country['region'] ?? null;

        if ($countryCode && $countryName) {
            $stmt = $pdo->prepare("INSERT INTO countries (country_code, name) 
                VALUES (:country_code, :name)
                ON DUPLICATE KEY UPDATE name = :name");

            $stmt->execute([
                ':country_code' => $countryCode,
                ':name' => $countryName
            ]);
        }
    }
    echo "✅ Countries updated successfully.<br>";
} else {
    echo "❌ Failed to fetch country data.<br>";
}


$stmt = $pdo->prepare("SELECT id, country_code FROM countries");
$stmt->execute();
$countries = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($countries); // Display fetched data for debugging



foreach ($countries as $country) {
    $countryCode = $country['country_code']; // No need for country_id

    // ✅ Fetch states from API
    $stateUrl = "http://api.geonames.org/searchJSON?country=$countryCode&featureCode=ADM1&maxRows=1000&username=$geoUsername";
    $states = fetchApiData($stateUrl);

    if ($states && isset($states['geonames'])) {
        foreach ($states['geonames'] as $state) {
            $stateName = $state['name'] ?? null;
            $stateCode = $state['adminCode1'] ?? null;

            if ($stateName && $stateCode) {
                // ✅ Insert or update the state
                $stmt = $pdo->prepare("INSERT INTO states (name, state_code, country_code) 
                    VALUES (:state_name, :state_code, :country_code) 
                    ON DUPLICATE KEY UPDATE name = :state_name");

                $stmt->execute([
                    ':state_name' => $stateName,
                    ':state_code' => $stateCode,
                    ':country_code' => $countryCode
                ]);
            }
        }
        echo "✅ States for $countryCode updated successfully.<br>";
    } else {
        echo "❌ Failed to fetch states for $countryCode.<br>";
    }

// Fetch all countries
$stmt = $pdo->prepare("SELECT id, country_code FROM countries");
$stmt->execute();
$countries = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($countries as $country) {
    $countryCode = $country['country_code'];

    echo "🌍 Fetching cities for country: $countryCode <br>";

    $startRow = 0;
    $batchSize = 1000; // API allows maxRows=1000

    do {
        $cityUrl = "http://api.geonames.org/searchJSON?country=$countryCode&featureClass=P&maxRows=$batchSize&startRow=$startRow&username=$geoUsername";
        $cities = fetchApiData($cityUrl);

        if ($cities && isset($cities['geonames']) && count($cities['geonames']) > 0) {
            foreach ($cities['geonames'] as $city) {
                $cityName = $city['name'] ?? null;
                $stateCode = $city['adminCode1'] ?? "UNKNOWN"; // Handle missing state codes
                $countryId = $country['id'];

                if ($cityName) {
                    // ✅ Ensure the state exists before inserting the city
                    $stateCheckStmt = $pdo->prepare("SELECT id FROM states WHERE state_code = :state_code AND country_code = :country_code");
                    $stateCheckStmt->execute([
                        ':state_code' => $stateCode,
                        ':country_code' => $countryCode
                    ]);
                    $stateId = $stateCheckStmt->fetchColumn();

                    // ✅ If the state does not exist, insert it first
                    if (!$stateId) {
                        $insertStateStmt = $pdo->prepare("INSERT INTO states (name, state_code, country_code, country_id)
                            VALUES (:state_name, :state_code, :country_code, :country_id)
                            ON DUPLICATE KEY UPDATE name = :state_name");

                        $insertStateStmt->execute([
                            ':state_name' => "Unknown State",
                            ':state_code' => $stateCode,
                            ':country_code' => $countryCode,
                            ':country_id' => $countryId
                        ]);

                        $stateId = $pdo->lastInsertId();
                    }

                    // ✅ Insert the city
                    try {
                        $stmt = $pdo->prepare("INSERT INTO cities (name, state_code, state_id, country_code, status, created_at) 
                            VALUES (:name, :state_code, :state_id, :country_code, 1, NOW()) 
                            ON DUPLICATE KEY UPDATE name = :name");

                        $stmt->execute([
                            ':name' => $cityName,
                            ':state_code' => $stateCode,
                            ':state_id' => $stateId,
                            ':country_code' => $countryCode
                        ]);
                    } catch (PDOException $e) {
                        echo "❌ SQL Error: " . $e->getMessage() . "<br>";
                    }
                }
            }
            echo "✅ Batch from $startRow fetched for $countryCode.<br>";

            $startRow += $batchSize; // Move to next batch
            sleep(1); // Prevent hitting API rate limits
        } else {
            break; // Stop fetching if no more results
        }
    } while (true);

    echo "✅ Cities for $countryCode updated successfully.<br><br>";
}

echo "🎉 All cities fetched successfully!";
}



echo "🎉 Data fetching and insertion completed successfully!";
?>
