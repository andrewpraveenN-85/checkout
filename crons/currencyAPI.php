<?php

    // Database credentials
    $host = "localhost";
    $dbname = "ABC";
    $username = "root";
    $password = "";

    // Currency API details (Apilayer ExchangeRates API)
    $apiKey = "0N8XYBMe6ywNsTyULzoINwXmCkcirjhf"; // Replace with your valid API key
    $baseCurrency = "USD"; // Base currency
    $apiUrl = "https://api.apilayer.com/exchangerates_data/latest?apikey=$apiKey&base=$baseCurrency";

    // Currency Symbols Mapping (Manually added)
    $currencySymbols = [
        "AED" => "د.إ", "AFN" => "؋", "ALL" => "L", "AMD" => "֏", "ANG" => "ƒ", "AOA" => "Kz",
        "ARS" => "$", "AUD" => "A$", "AWG" => "ƒ", "AZN" => "₼", "BAM" => "KM", "BBD" => "Bds$",
        "BDT" => "৳", "BGN" => "лв", "BHD" => ".د.ب", "BIF" => "FBu", "BMD" => "$", "BND" => "B$",
        "BOB" => "Bs.", "BRL" => "R$", "BSD" => "B$", "BTN" => "Nu.", "BWP" => "P", "BYN" => "Br",
        "BZD" => "BZ$", "CAD" => "C$", "CDF" => "FC", "CHF" => "CHF", "CLP" => "$", "CNY" => "¥",
        "COP" => "$", "CRC" => "₡", "CUP" => "₱", "CVE" => "$", "CZK" => "Kč", "DJF" => "Fdj",
        "DKK" => "kr", "DOP" => "RD$", "DZD" => "دج", "EGP" => "£", "ERN" => "Nfk", "ETB" => "Br",
        "EUR" => "€", "FJD" => "FJ$", "FKP" => "£", "FOK" => "kr", "GBP" => "£", "GEL" => "₾",
        "GGP" => "£", "GHS" => "₵", "GIP" => "£", "GMD" => "D", "GNF" => "FG", "GTQ" => "Q",
        "GYD" => "GY$", "HKD" => "HK$", "HNL" => "L", "HRK" => "kn", "HTG" => "G", "HUF" => "Ft",
        "IDR" => "Rp", "ILS" => "₪", "IMP" => "£", "INR" => "₹", "IQD" => "ع.د", "IRR" => "﷼",
        "ISK" => "kr", "JEP" => "£", "JMD" => "J$", "JOD" => "JD", "JPY" => "¥", "KES" => "KSh",
        "KGS" => "с", "KHR" => "៛", "KID" => "$", "KMF" => "CF", "KRW" => "₩", "KWD" => "KD",
        "KYD" => "$", "KZT" => "₸", "LAK" => "₭", "LBP" => "ل.ل", "LKR" => "Rs", "LRD" => "$",
        "LSL" => "L", "LYD" => "LD", "MAD" => "DH", "MDL" => "L", "MGA" => "Ar", "MKD" => "ден",
        "MMK" => "K", "MNT" => "₮", "MOP" => "MOP$", "MRU" => "UM", "MUR" => "₨", "MVR" => "Rf",
        "MWK" => "MK", "MXN" => "$", "MYR" => "RM", "MZN" => "MT", "NAD" => "$", "NGN" => "₦",
        "NIO" => "C$", "NOK" => "kr", "NPR" => "Rs", "NZD" => "NZ$", "OMR" => "﷼", "PAB" => "B/.",
        "PEN" => "S/.", "PGK" => "K", "PHP" => "₱", "PKR" => "Rs", "PLN" => "zł", "PYG" => "₲",
        "QAR" => "﷼", "RON" => "lei", "RSD" => "дин", "RUB" => "₽", "RWF" => "FRw", "SAR" => "﷼",
        "SBD" => "SI$", "SCR" => "₨", "SDG" => "ج.س.", "SEK" => "kr", "SGD" => "S$", "SHP" => "£",
        "SLE" => "Le", "SLL" => "Le", "SOS" => "Sh", "SRD" => "$", "SSP" => "£", "STN" => "Db",
        "SYP" => "£", "SZL" => "E", "THB" => "฿", "TJS" => "SM", "TMT" => "T", "TND" => "DT",
        "TOP" => "T$", "TRY" => "₺", "TTD" => "TT$", "TVD" => "$", "TWD" => "NT$", "TZS" => "TSh",
        "UAH" => "₴", "UGX" => "USh", "USD" => "$", "UZS" => "so'm", "VES" => "Bs.",
        "VND" => "₫", "VUV" => "VT", "WST" => "WS$", "XAF" => "FCFA", "XCD" => "EC$", "XOF" => "CFA",
        "XPF" => "CFP", "YER" => "﷼", "ZAR" => "R", "ZMW" => "ZK", "ZWL" => "Z$"
    ];
    

    // Connect to the database
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create table if it doesn't exist
        $sql = "CREATE TABLE IF NOT EXISTS currencies (
            id INT AUTO_INCREMENT PRIMARY KEY,
            currency_code VARCHAR(10) NOT NULL UNIQUE,
            currency_name VARCHAR(100) NOT NULL,
            symbol VARCHAR(10) DEFAULT NULL,
            base_currency_code VARCHAR(10) NOT NULL,
            exchange_rate DECIMAL(15,6) NOT NULL,
            effective_date DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($sql);

        // Fetch exchange rates using cURL
        function fetchExchangeRates($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL verification (for local XAMPP)
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Accept: application/json'
            ]);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                die("cURL Error: " . curl_error($ch));
            }

            curl_close($ch);
            return $response;
        }

        $response = fetchExchangeRates($apiUrl);
        $data = json_decode($response, true);

        // Verify API response
        if ($data && isset($data['rates'])) {
            $rates = $data['rates'];
            $date = date('Y-m-d'); // Current effective date

            foreach ($rates as $currencyCode => $exchangeRate) {
                // Get symbol from the mapping or set as NULL if not found
                $symbol = isset($currencySymbols[$currencyCode]) ? $currencySymbols[$currencyCode] : null;

                // Insert or update currency rates
                $stmt = $pdo->prepare("INSERT INTO currencies (currency_code, currency_name, symbol, base_currency_code, exchange_rate, effective_date)
                    VALUES (:currency_code, :currency_name, :symbol, :base_currency_code, :exchange_rate, :effective_date)
                    ON DUPLICATE KEY UPDATE exchange_rate = :exchange_rate, effective_date = :effective_date, symbol = :symbol, updated_at = CURRENT_TIMESTAMP");

                $stmt->execute([
                    ':currency_code' => $currencyCode,
                    ':currency_name' => $currencyCode, // Placeholder (modify if you fetch real currency names)
                    ':symbol' => $symbol,
                    ':base_currency_code' => $baseCurrency,
                    ':exchange_rate' => $exchangeRate,
                    ':effective_date' => $date
                ]);
            }

            echo "Currency exchange rates updated successfully with symbols.";
        } else {
            echo "Failed to fetch exchange rates.";
        }

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }

?>
