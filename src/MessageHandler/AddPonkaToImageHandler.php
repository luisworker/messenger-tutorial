<?php

namespace App\MessageHandler;

use App\Message\AddPonkaToImage;
use App\Photo\PhotoFileManager;
use App\Photo\PhotoPonkaficator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddPonkaToImageHandler implements MessageHandlerInterface
{


	private $photoManager;
	private $ponkaficator;
	private $entityManager;

	public function __construct(PhotoFileManager       $photoManager,
								PhotoPonkaficator      $ponkaficator,
								EntityManagerInterface $entityManager)
	{
		$this->photoManager = $photoManager;
		$this->ponkaficator = $ponkaficator;
		$this->entityManager = $entityManager;
	}

	public function __invoke(AddPonkaToImage $addPonkaToImage)
	{
		$imagePost = $addPonkaToImage->getImagePost();
		$updatedContents = $this->ponkaficator->ponkafy(
			$this->photoManager->read($imagePost->getFilename())
		);
		$this->photoManager->update($imagePost->getFilename(), $updatedContents);
		$imagePost->markAsPonkaAdded();
		$this->entityManager->flush();
	}
}