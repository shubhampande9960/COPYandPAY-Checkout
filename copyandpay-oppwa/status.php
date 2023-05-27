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

       $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

       $ch = curl_init();

       curl_setopt($ch, CURLOPT_URL, $url);

       curl_setopt($ch, CURLOPT_HTTPHEADER, [
           "Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg=",
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


