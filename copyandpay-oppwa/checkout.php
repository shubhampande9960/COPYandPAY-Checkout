<?php
function request()
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $price = $_POST["price"];

        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data =
            "entityId=8ac7a4c79394bdc801939736f17e063d" .
            "&amount=$price" .
            "&currency=EUR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization:Bearer OGFjN2E0Yzc5Mzk0YmRjODAxOTM5NzM2ZjFhNzA2NDF8enlac1lYckc4QXk6bjYzI1NHNng=",
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }
}

$responseData = request();
$checkoutId = json_decode($responseData)->id;
?>


<!DOCTYPE html>
<html>
<head>
<br><br><br><br><br>

    <title>COPYandPAY PHP</title>
    <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?php echo $checkoutId; ?>"></script>

</head>
<body>
    <form action="status.php?checkoutId=<?php echo $checkoutId; ?>" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>
</body>
</html>



