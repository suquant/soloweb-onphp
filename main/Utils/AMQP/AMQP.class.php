<?php
/***************************************************************************
 *   Copyright (C) 2011 by Sergey S. Sergeev                               *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 ***************************************************************************/

	/**
	 * AMQP stands for Advanced Message Queue Protocol, which is
	 * an open standard middleware layer for message routing and queuing.
	**/
	abstract class AMQP
	{
		/**
		 * @var AMQPCredentials
		**/
		protected $credentials = null;
		protected $link	= null;

		/**
		 * @var array of AMQPBaseChannel instances
		**/
		protected $channels	= array();

		/**
		 * @return boolean
		**/
		abstract public function connect();

		/**
		 * @return bolean
		**/
		abstract public function disconnect();

		/**
		 * @return boolean
		**/
		abstract public function isConnected();

		/**
		 * @return AMQPBaseChannel
		 */
		abstract protected function spawnChannel($id, AMQP $transport);
		
		public function __construct(AMQPCredentials $credentials)
		{
			$this->credentials = $credentials;
		}

		public function __destruct()
		{
			if ($this->isConnected()) {
				$this->disconnect();
			}
		}

		/**
		 * @return AMQP
		**/
		public static function spawn($class, AMQPCredentials $credentials)
		{
			return new $class($credentials);
		}

		public function getLink()
		{
			return $this->link;
		}

		/**
		 * @param integer $id
		 * @throws WrongArgumentException
		 * @return AMQPBaseChannel
		**/
		public function createChannel($id)
		{
			Assert::isInteger($id);

			if (isset($this->channels[$id]))
				throw new WrongArgumentException(
					"AMQP channel with id '{$id}' already registered"
				);
			
			if (!$this->isConnected())
				$this->connect();
			
			$this->channels[$id] = 
				$this->spawnChannel($id, $this)->
				open();

			return $this->channels[$id];
		}

		/**
		 * @throws MissingElementException
		 * @return AMQPBaseChannel
		**/
		public function getChannel($id)
		{
			if (isset($this->channels[$id]))
				return $this->channels[$id];

			throw new MissingElementException(
				"Can't find AMQP channel with id '{$id}'"
			);
		}

		/**
		 * @return array
		**/
		public function getChannelList()
		{
			return $this->channels;
		}

		/**
		 * @param integer $id
		 * @throws MissingElementException
		 * @return AMQPBaseChannel
		**/
		public function dropChannel($id)
		{
			if (!isset($this->channels[$id]))
				throw new MissingElementException(
					"AMQP channel with id '{$id}' not found"
				);

			$this->channels[$id]->close();

			unset($this->channels[$id]);

			return $this;
		}
	}
?>