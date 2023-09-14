<?php
class PhoneNumberManager {
    public function checkNetwork($phoneNumber) {
        if (strpos($phoneNumber, "075") === 0 || strpos($phoneNumber, "070") === 0 || strpos($phoneNumber, "074") === 0) {
            return "Airtel Number";
        } elseif (strpos($phoneNumber, "078") === 0 || strpos($phoneNumber, "077") === 0 || strpos($phoneNumber, "076") === 0) {
            return "MTN Number";
        } elseif (strpos($phoneNumber, "+") === false) {
            return "International Number";
        }else {
            return "Neither Airtel nor MTN";
        }
    }

    public function convertPhoneNumber($phoneNumber) {
        
        if(strpos($phoneNumber, "+") === 0)
        {
            return $phoneNumber;
        } else {
            return "+256" . substr($phoneNumber, 1); 
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phoneNumberManager = new PhoneNumberManager();
    $user_input = $_POST["phoneNumber"];
    $operation = $_POST["operation"];

    if ($operation === "check_and_convert") {
        $networkResult = $phoneNumberManager->checkNetwork($user_input);
        $convertResult = $phoneNumberManager->convertPhoneNumber($user_input);

        $result = "It is an  " . $networkResult . "<br>International Number: " . $convertResult;
    } else {
        $result = "Invalid operation";
    }

    echo $result;
}
?>
