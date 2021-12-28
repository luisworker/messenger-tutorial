<?php

namespace App\MessengerHandler;

use App\Messenger\AddPonkaToImage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddPonkaToImageHandler implements MessageHandlerInterface
{
	public function __invoke(AddPonkaToImage $addPonkaToImage)
	{
		dump($addPonkaToImage);
	}
}