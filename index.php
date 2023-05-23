<?php
    require __DIR__ . "/vendor/autoload.php";
    require __DIR__ . "/constant.php";
    use Pixabay\PixabayClient;


    $path = "https://api.telegram.org/".BOT_KEY;
    $update = json_decode(file_get_contents("php://input"), TRUE);

    $messageId = $update["message"]["message_id"];
    $chatId = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];

    // Start Command
    if (strpos($message,"start")){
        $userName = $update['message']['from']['first_name']." ".$update['message']['from']['last_name'];
        $data = [
            'chat_id' => "$chatId",
            'text' => "Hello, $userName it\'s KRI55H at your service.Here are some help tricks with command",
        ];
        file_get_contents($path."/sendMessage?".http_build_query($data));
    }

    // Clear command
    if(strpos($message,"clear")){
        $data = [
            'chat_id' => $chatId,
            'message_id' => $messageId
        ];
        file_get_contents($path . "/deleteMessage?".http_build_query($data));
    }

// This function is currently not working
//      Send Image
//    if(strpos($message,"image")){
//        $category = str_replace("/image ","",$message);
//        try {
//            $pixBay = new PixabayClient([
//                'key' => PIXLAB_KEY
//            ]);
//            $results = $pixBay->get(['q' => "$category"], true);
//        } catch (Exception $e) {
//            $data = [
//                'chat_id' => "$chatId",
//                'text' => $e->getMessage()
//            ];
//            file_get_contents($path."/sendMessage?".http_build_query($data));
//        }
//        foreach ($results['hits'] as $img){
//            $data = [
//                'chat_id' => "$chatId",
//                'photo' => $img['largeImageURL']
//            ];
//            file_get_contents($path."/sendPhoto?".http_build_query($data));
//            break;
//        }
//    }

?>