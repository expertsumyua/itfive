<?php

   
       
    function message_to_telegram($text, $chatid, $token) {
        
        $data = [
            'chat_id' => $chatid,
            'text' => $text,
            'parse_mode' => "HTML"
        ];

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, 'https://api.telegram.org/bot' . $token . '/sendMessage' );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data ); 
    
        $result = curl_exec( $ch );
        curl_close( $ch );
    }

?>