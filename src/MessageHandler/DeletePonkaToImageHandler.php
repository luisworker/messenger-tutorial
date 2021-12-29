<?php

namespace App\MessageHandler;

use App\Message\DeletePonkaToImage;
use App\Photo\PhotoFileManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeletePonkaToImageHandler implements MessageHandlerInterface
{
	private $photoManager;
	private $entityManager;

	public function __construct(PhotoFileManager $photoManager, EntityManagerInterface $entityManager)
	{
		$this->photoManager = $photoManager;
		$this->entityManager = $entityManager;
	}

	public function __invoke(DeletePonkaToImage $deletePonkaToImage)
	{
		$imagePost = $deletePonkaToImage->getImagePost();
		$this->photoManager->deleteImage($imagePost->getFilename());

		$this->entityManager->remove($imagePost);
		$this->entityManager->flush();
	}
}