<?php

namespace App\MessageHandler;

use App\Message\DeletePhotoFile;
use App\Photo\PhotoFileManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeletePhotoFileHandler implements MessageHandlerInterface
{
	private $photoManager;

	public function __construct(PhotoFileManager $photoManager)
	{
		$this->photoManager = $photoManager;
	}

	public function __invoke(DeletePhotoFile $deletePonkaToImage)
	{
		$fileName = $deletePonkaToImage->getFileName();
		$this->photoManager->deleteImage($fileName);
	}
}