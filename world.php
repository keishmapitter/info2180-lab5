<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$stmt = $conn->query("SELECT * FROM countries");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



$reqCountry=trim(filter_var(htmlspecialchars($_GET['country']), FILTER_SANITIZE_STRING));
$country= $conn->query("SELECT * FROM countries WHERE name LIKE '%$reqCountry%'");
$countryr= $country->fetchAll(PDO::FETCH_ASSOC);

$reqContext =trim(filter_var(htmlspecialchars($_GET['context']), FILTER_SANITIZE_STRING)); 
$cities= $conn->query("SELECT cities.population, cities.district ,cities.name FROM cities JOIN countries ON countries.code=cities.country_code WHERE countries.name LIKE '%$reqContext%'");
$citiesr= $cities->fetchAll(PDO::FETCH_ASSOC);
$getcoun = isset($_GET['country'])
?>



  <?php if ($getcoun && !isset($_GET['context'])):  ?>
    <table>
        <tr>
          <th> Country Name</th>  
          <th> Continent</th>  
          <th> Indenpendence Year</th>  
          <th> Head of State</th>  
        </tr>
        
        <tbody>
        <?php foreach ($countryr as $text): ?>
            <tr>
                <td> <?= $text['name']; ?></td>  
                <td> <?= $text['continent']; ?></td>  
                <td> <?= $text['independence_year']; ?></td>  
                <td> <?= $text['head_of_state']; ?></td>  
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
        
    <?php elseif ($getcoun && isset($_GET['context'])):?>
        <table>
            <tr>
              <th> Name</th>  
              <th> District</th>  
              <th> Popululation</th>  
            </tr>
            
            <tbody>
            <?php foreach ($citiesr as $city): ?>
                <tr>
                    <td> <?= $city['name']; ?></td>  
                    <td> <?= $city['district']; ?></td>  
                    <td> <?= $city['population']; ?></td>  
                </tr>
             <?php endforeach; ?>
            </tbody>
        </table>
<?php endif ?>