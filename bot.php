<?php

define('TOKEN', '82');
define('DOMAIN', 'https://example.com/');
define('WEBHOOK', DOMAIN.'bot.php');
define('CHATID', '35');
define('API', 'https://api.telegram.org/bot'.TOKEN.'/');

$result = file_get_contents(API.'getWebhookInfo');
$result = json_decode($result);

if (empty($result->result->url)) {
	file_get_contents(API.'setWebhook?url='.WEBHOOK);
	echo 'WEBHOOK IS INSTALLED';
}

$result = file_get_contents('php://input');
$result = json_decode($result);
switch ($result->message->text) {
	case '/start':
		file_get_contents(API.'sendMessage?chat_id='.$result->message->chat->id.'&text=Напиши мне, а я передам все своему хозяину ');
		break;
	default:
		file_get_contents(API.'forwardMessage?chat_id='.CHATID.'&from_chat_id='.$result->message->chat->id.'&message_id='.$result->message->message_id);
		file_get_contents(API.'sendMessage?chat_id='.$result->message->chat->id.'&text=Сообщение отправлено!');
		break;
}