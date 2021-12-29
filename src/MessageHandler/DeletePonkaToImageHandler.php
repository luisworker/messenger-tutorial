<?php

namespace App\MessageHandler;

use App\Message\DeletePhotoFile;
use App\Message\DeletePonkaToImage;
use App\Photo\PhotoFileManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class DeletePonkaToImageHandler implements MessageHandlerInterface
{

	private $entityManager;
	/**
	 * @var \Symfony\Component\Messenger\MessageBusInterface
	 */
	private $messageBus;

	public function __construct(MessageBusInterface $messageBus, EntityManagerInterface $entityManager)
	{

		$this->entityManager = $entityManager;
		$this->messageBus = $messageBus;
	}

	public function __invoke(DeletePonkaToImage $deletePonkaToImage)
	{
		$imagePost = $deletePonkaToImage->getImagePost();


		$this->entityManager->remove($imagePost);
		$this->entityManager->flush();

		$message = new DeletePhotoFile($imagePost->getFilename());
		$this->messageBus->dispatch($message);
	}
}