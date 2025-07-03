<!DOCTYPE html>

<html>

<head>

    <title>Checkout Status</title>



</head>

<body>

    



   <?php
   $checkoutId = $_GET["checkoutId"];

   $responseData = request($checkoutId);

   function request($checkoutId)
   {
       $url =
           "https://eu-test.oppwa.com/v1/checkouts/" . $checkoutId . "/payment";

       $url .= "?entityId=8ac7a4c79394bdc801939736f17e063d";

       $ch = curl_init();

       curl_setopt($ch, CURLOPT_URL, $url);

       curl_setopt($ch, CURLOPT_HTTPHEADER, [
           "Authorization:Bearer OGFjN2E0Yzc5Mzk0YmRjODAxOTM5NzM2ZjFhNzA2NDF8enlac1lYckc4QXk6bjYzI1NHNng=",
       ]);

       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production

       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       $responseData = curl_exec($ch);

       if (curl_errno($ch)) {
           return curl_error($ch);
       }

       curl_close($ch);

       return $responseData;
   }
   ?>



<h1>Transaction Response</h1>



<div> 

<textarea name="" id="txt_result" cols="100" rows="30"  <pre> <?php echo $responseData; ?> </textarea>

</div>

<br><br>

<div class="field">

              <div class="control">

                <a href="http://localhost/copyandpay-oppwa/" class="button is-primary is-small">

                  </span>

                  <span>Submit Another Request</span>

                </a>

              </div>

            </div>



</body>

</html>


