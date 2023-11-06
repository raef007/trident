<?php

namespace App\Core;

class SystemCommand
{
	protected $messages=[];

	public function getMessages()
	{
		return $this->messages;
	}

	public function setMessages($messages)
	{
		$this->messages = $messages;
		return $this;
	}
}