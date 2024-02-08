<html>
<body>

Welcome <?php echo $_POST["name"]; ?><br>
You entered: <?php echo $_POST["email"]; ?><br>
You picked a date: <?php echo $_POST["date"]; ?><br>
Subject is: <?php echo $_POST["subject"]; ?><br>    

<?php
//require 'vendor/autoload.php';
require 'awsunzip/aws-autoloader.php';

date_default_timezone_set('UTC');

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

$sdk = new Aws\Sdk([
    //'endpoint'   => 'http://localhost:8000',
    'region'   => 'ca-central-1',
    'version'  => 'latest'
]);

$dynamodb = $sdk->createDynamoDb();


$marshaler = new Marshaler();

$yourname = _POST["name"];
$youremail = _POST["email"];

$item = $marshaler->marshalJson('
    {
    
        "yourname": " yourname ",
        "youremail": "yml@yaml.org",
        "info": {
            "plot": "nice.",
            "rating": 8 
        }
    }
');

$params = [
    'TableName' => 'Details',
    'Item' => $item
];


try {
    $result = $dynamodb->putItem($params);
    echo "Added item: $year - $title\n";

} catch (DynamoDbException $e) {
    echo "Unable to add item:\n";
    echo $e->getMessage() . "\n";
}
?>

</body>
</html>