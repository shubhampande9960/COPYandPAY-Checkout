<?php
function request()
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $price = $_POST["price"];

        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data =
            "entityId=8a8294174b7ecb28014b9699220015ca" .
            "&amount=$price" .
            "&currency=EUR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg=",
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



