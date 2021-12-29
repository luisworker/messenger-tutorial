<?php

namespace App\Message;



class AddPonkaToImage
{

	private $imagePostId;

	public function	__construct(int $imagePost)
	{
		$this->imagePostId = $imagePost;
	}

	public function getImagePost(): int
	{
		return $this->imagePostId;
	}
}