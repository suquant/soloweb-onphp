<?php
/***************************************************************************
 *   Copyright (C) 2011 by Andrew N Fediushin                              *
 *   email: g.kutcurua@gmail.com, icq: 723737, jabber: soloweb@jabber.ru   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/
/* $Id$ */

	/**
	 * A wrapper to multiple cache for workload
	 * distribution using CachePeer children.
	 *
	 * @ingroup Cache
	**/
	class RingedCache extends SelectivePeer
	{
		const LEVEL_ULTRAHIGH	= 0xFFFF;
		const LEVEL_HIGH		= 0xC000;
		const LEVEL_NORMAL		= 0x8000;
		const LEVEL_LOW			= 0x4000;
		const LEVEL_VERYLOW		= 0x0001;

		protected $peers		= array();
		private static $ground	= 'unknown peer';
		private static $ring	= array();

		/**
		 * @return RingedCache
		**/
		public static function create()
		{
			return new self;
		}

		/**
		 * @return RingedCache
		**/
		public function addPeer(
			$label, CachePeer $peer, array $points
		)
		{
			if (isset($this->peers[$label]))
				throw new WrongArgumentException(
					'use unique names for your peers'
				);

			if ($peer->isAlive()) {
				foreach ($points as $point) {
					if ($this->checkPointOnExists($point)) {
						throw new WrongArgumentException(
							'use unique points (' . $point . ') for your peers'
						);
					}
					self::$ring[$point] = $label;
				}
				$this->peers[$label]['object'] = $peer;
				$this->peers[$label]['points'] = $points;
				$this->peers[$label]['stat'] = array();
				$this->alive = true;
				ksort(self::$ring);
				self::$ground = reset(self::$ring);
				if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
					QueueLogger::INFO('Add peer "' . $label . '"', 'cache');
			} else {
				if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
					QueueLogger::INFO('Peer "' . $label . '" is dead, dont add to cluster!', 'cache');
			}

			return $this;
		}

		/**
		 * Снимает с кольца все точки пира
		 *
		 * @param string $label
		 */
		private function dropFromRing($label)
		{
			// Снимаем с кольца все точки этого пира
			self::$ring = array_filter(
				self::$ring,
				create_function('$data', 'return ( $data != \''.$label.'\' );')
			);
			ksort(self::$ring);
			self::$ground = reset(self::$ring);
		}

		/**
		 * Проверка точки на существование в уже добавленных в кольцо
		 *
		 * @param int $point
		 * @return boolean
		 */
		public function checkPointOnExists($point)
		{
			return isset(self::$ring[$point]);
		}
		/**
		 * @return RingedCache
		**/
		public function dropPeer($label)
		{
			if (!isset($this->peers[$label]))
				throw new MissingElementException(
					"there is no peer with '{$label}' label"
				);

			$this->dropFromRing($label);
			unset($this->peer[$label]);

			return $this;
		}

		public function checkAlive()
		{
			$this->alive = false;

			foreach ($this->peers as $label => $peer)
				if ($peer['object']->isAlive()) {
					$this->alive = true;
				} else {
					unset($this->peers[$label]);
					$this->dropFromRing($label);
				}

			return $this->alive;
		}

		/**
		 * low-level cache access
		**/

		public function increment($key, $value)
		{
			$label = $this->guessLabel($key);

			if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
				QueueLogger::INSANE('key "' . $key . '" on value "' . $value . '". Cache: "' . $label . '"', 'cache');

			if ($this->peers[$label]['object']->isAlive())
				return $this->peers[$label]['object']->increment($key, $value);
			else
				$this->checkAlive();

			return null;
		}

		public function decrement($key, $value)
		{
			$label = $this->guessLabel($key);

			if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
				QueueLogger::INSANE('key "' . $key . '" on value "' . $value . '". Cache: "' . $label . '"', 'cache');

			if ($this->peers[$label]['object']->isAlive())
				return $this->peers[$label]['object']->decrement($key, $value);
			else
				$this->checkAlive();

			return null;
		}

		public function get($key)
		{
			$label = $this->guessLabel($key);

			if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
				QueueLogger::INSANE('key "' . $key . '" from cache: "' . $label . '"', 'cache');

			if ($this->peers[$label]['object']->isAlive())
				return $this->peers[$label]['object']->get($key);
			else
				$this->checkAlive();

			return null;
		}

		public function getList($indexes)
		{
			$labels = array();
			$out = array();

			if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
				QueueLogger::INSANE('get list', 'cache');

			foreach ($indexes as $index)
				$labels[$this->guessLabel($index)][] = $index;

			foreach ($labels as $label => $indexList)
				if ($this->peers[$label]['object']->isAlive()) {
					if ($list = $this->peers[$label]['object']->getList($indexList))
						$out = array_merge($out, $list);
				} else
					$this->checkAlive();

			return $out;
		}

		public function delete($key)
		{
			$label = $this->guessLabel($key);

			if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
				QueueLogger::INSANE('key "' . $key . '" from cache: "' . $label . '"', 'cache');

			if (!$this->peers[$label]['object']->isAlive()) {
				$this->checkAlive();
				return false;
			}

			return $this->peers[$label]['object']->delete($key);
		}

		/**
		 * @return RingedCache
		**/
		public function clean()
		{
			foreach ($this->peers as $peer)
				$peer['object']->clean();

			$this->checkAlive();

			return parent::clean();
		}

		public function getStats()
		{
			$stats = array();

			foreach ($this->peers as $label => $peer)
				$stats[$label] = $peer['stat'];

			return $stats;
		}

		public function append($key, $data)
		{
			$label = $this->guessLabel($key);

			if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
				QueueLogger::INSANE('key "' . $key . '" from cache: "' . $label . '"', 'cache');

			if ($this->peers[$label]['object']->isAlive())
				return $this->peers[$label]['object']->append($key, $data);
			else
				$this->checkAlive();

			return false;
		}

		protected function store(
			$action, $key, $value, $expires = Cache::EXPIRES_MINIMUM
		)
		{
			$label = $this->guessLabel($key);
			if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
				QueueLogger::INSANE('label: "' . $label . '"', 'cache');

			if ($this->peers[$label]['object']->isAlive())
				return
					$this->peers[$label]['object']->$action(
						$key,
						$value,
						$expires
					);
			else
				$this->checkAlive();

			return false;
		}

		/**
		 * brainfuck
		**/
		protected function guessLabel($key)
		{
			if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
				QueueLogger::INSANE('key: "' . $key . '"', 'cache');
			$class = $this->getClassName();

			$keyPoint = crc32($key) >> 1;

			$selectedLabel = self::$ground;
			foreach(self::$ring as $point => $label) {
				if ($point > $keyPoint) {
					$selectedLabel = $label;
					break;
				}
			}

			if (QueueLogger::me()->onMap(QueueLogger::WATCH_CACHE))
				QueueLogger::INSANE('set cache "' . $selectedLabel . '"', 'cache');

			if (isset($this->peers[$selectedLabel]['stat'][$class]))
				++$this->peers[$selectedLabel]['stat'][$class];
			else
				$this->peers[$selectedLabel]['stat'][$class] = 1;

			return $selectedLabel;
		}
	}
?>