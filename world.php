<?php
$host = 'localhost:3307';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($lookup === "cities") {
    // -------- CITIES LOOKUP --------
    $stmt = $conn->prepare("
        SELECT cities.name, cities.district, cities.population
        FROM cities
        JOIN countries ON countries.code = cities.country_code
        WHERE countries.name LIKE :country
    ");

    $stmt->execute(['country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>
            <tr>
                <th>City</th>
                <th>District</th>
                <th>Population</th>
            </tr>";

    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['district']}</td>
                <td>{$row['population']}</td>
              </tr>";
    }

    echo "</table>";
} 
else {
    // -------- COUNTRY LOOKUP --------
    $stmt = $conn->prepare("
        SELECT name, continent, independence_year, head_of_state
        FROM countries
        WHERE name LIKE :country
    ");

    $stmt->execute(['country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>";

    foreach ($results as $row) {
        $indYear = $row['independence_year'] ?: "N/A";
        $head = $row['head_of_state'] ?: "N/A";

        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['continent']}</td>
                <td>{$indYear}</td>
                <td>{$head}</td>
              </tr>";
    }

    echo "</table>";
}
?>
