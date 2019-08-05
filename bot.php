<?php
define('TOKEN', '82');
define('CHATID', '35');
define('API', 'https://api.telegram.org/bot'.TOKEN.'/');

$data = json_decode(file_get_contents('php://input'));

switch ($data->message->text) {
	case '/start':
		file_get_contents(API.'sendMessage?chat_id='.$data->message->chat->id.'&text=Напиши мне, а я передам все своему хозяину ');
		break;
	default:
		file_get_contents(API.'forwardMessage?chat_id='.CHATID.'&from_chat_id='.$data->message->chat->id.'&message_id='.$data->message->message_id);
		file_get_contents(API.'sendMessage?chat_id='.$data->message->chat->id.'&text=Сообщение отправлено!');
		break;
}