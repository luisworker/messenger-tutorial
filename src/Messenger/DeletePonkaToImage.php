<?php

namespace App\Messenger;

use App\Entity\ImagePost;

class DeletePonkaToImage
{

	private $imagePost;

	public function	__construct(ImagePost $imagePost)
	{
		$this->imagePost = $imagePost;
	}

	public function getImagePost(): ImagePost
	{
		return $this->imagePost;
	}
}