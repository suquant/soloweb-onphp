<?php
/***************************************************************************
 *   Copyright (C) 2011 by Andrew N. Fediushin &                           *
 *   Kutcurua Georgy Tamazievich                                           *
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
	 * Логирование через очереди сообщений AMQP
	 *
	 * Usage:
	 * 	QueueLogger::me()->log(QueueLogger::LEVEL_DEBUG, "Vasya Pupkin said");
	 * или
	 * 	QueueLogger::WARNING('Vasya made me my day!', 'joke');
	 */
	class QueueLogger extends Singleton
	{
	
		const LEVEL_INSANE		= 'insane';	// подробнейшая отладочная информация
		const LEVEL_DEBUG		= 'debug';	// отладочные сообщения
		const LEVEL_PERF		= 'perf';	// время выполнения операций, профилирование
		const LEVEL_INFO		= 'info';	// сообщения компонент
		const LEVEL_WARNING		= 'warn';	// предупреждающие сообщения
		const LEVEL_ERROR		= 'error';	// ошибки в компонентах
		const LEVEL_CRITICAL	= 'crit';	// ошибки системы
	
		const WATCH_CACHE	= 0x01; // Маска для сообщений от кэшэра
		const WATCH_WORKER	= 0x02; // Маска для сообщений от воркера
		const WATCH_ACL		= 0x04; // Маска для сообщений о проверке/создании ACL
	
		/**
		 * ничего не делать (на случай, когда нет никакого "кролика")
		 * @var boolean
		 */
		private static $doNothing = false;
	
		// Порядок следования - нарочитый.
		protected $levelPriorityMap = array(
			QueueLogger::LEVEL_INSANE,
			QueueLogger::LEVEL_DEBUG,
			QueueLogger::LEVEL_PERF,
			QueueLogger::LEVEL_INFO,
			QueueLogger::LEVEL_WARNING,
			QueueLogger::LEVEL_ERROR,
			QueueLogger::LEVEL_CRITICAL
		);
	
		private static $currentLevel = 3; // QueueLogger::LEVEL_INFO
		private static $currentMap = 0x00; // Срабатывать нигде
	
		/**
		 * Коннект к RabbitMQ
		 *
		 * @var AMQPPecl
		 */
		private static $connection = null;
		
		/**
		 * Коннект к RabbitMQ
		 *
		 * @var AMQPPeclChannel
		 */
		private static $channel = null;
	
		/**
		 * Обменник, держащий очередь
		 *
		 * @var AMQPExchange
		 */
		private static $exchange = null;
	
		/**
		 * Системная очередь сообщений
		 *
		 * @var AMQPQueue
		 */
		private static $queue = null;
	
	
		/**
		 * подробнейшая отладочная информация
		 * (значения параметров вызовов функций, результаты работы этих функций и т.д.)
		 *
		 * @param <type> $message
		 * @param <type> $tag
		 */
		static public function INSANE($message, $tag=null)
		{ 
			self::me()->_rawlog(self::LEVEL_INSANE, $message, $tag); 
		}
		
		/**
		 * отладочные сообщения
		 * (выполнилось условие TTT, вызвали функцию по имени ZZZ и т.п.)
		 *
		 * @param <type> $message
		 * @param <type> $tag
		 */
		static public function DEBUG($message, $tag=null)
		{ 
			self::me()->_rawlog(self::LEVEL_DEBUG, $message, $tag); 
		}
		
		/**
		 * время выполнения операций, профилирование
		 * (вызванный метод XXX отработал за YYY миллисекунд)
		 *
		 * @param <type> $message
		 * @param <type> $tag
		 */
		static public function PERF($message, $tag=null)
		{
			self::me()->_rawlog(self::LEVEL_PERF, $message, $tag); 
		}
		
		/**
		 * сообщения компонент
		 * (отправлено письмо тому-то, принято решение сделать то-то потому-то, сделано то-то и т.д.)
		 *
		 * @param <type> $message
		 * @param <type> $tag
		 */
		static public function INFO($message, $tag=null)
		{ 
			self::me()->_rawlog(self::LEVEL_INFO, $message, $tag); 
		}
		
		/**
		 * предупреждающие сообщения
		 * (использовано значение по-умолчанию при требовании указывать явно,
		 * стал использоваться поиск через базу вместо поиска люценом и т.п.)
		 *
		 * @param <type> $message
		 * @param <type> $tag
		 */
		static public function WARNING($message, $tag=null)
		{ 
			self::me()->_rawlog(self::LEVEL_WARNING, $message, $tag); 
		}
		
		/**
		 * ошибки в компонентах
		 * (не может создать файл, неправильный запрос в базу и т.п.)
		 *
		 * @param <type> $message
		 * @param <type> $tag
		 */
		static public function ERROR($message, $tag=null)
		{ 
			self::me()->_rawlog(self::LEVEL_ERROR, $message, $tag);
		}
		
		/**
		 * ошибки системы (недоступна база, упал кеш и т.д.)
		 *
		 * @param <type> $message
		 * @param <type> $tag
		 */
		static public function CRITICAL($message, $tag=null)
		{ 
			self::me()->_rawlog(self::LEVEL_CRITICAL, $message, $tag);
		}
	
	
		/**
		 * @return QueueLogger
		 */
		static public function me()
		{
			return self::getInstance(__CLASS__);
		}
	
		/**
		 * @return QueueLogger
		**/
		public function disconnect()
		{
			if (self::$connection) {
				self::$connection = null;
			}
			
			if (self::$channel) {
				self::$channel = null;
			}
	
			return $this;
		}
	
		/**
		 * @return QueueLogger
		**/
		public function connect()
		{
			if (self::$doNothing) {
				return $this;
			}
	
			if (!$this->isConnected()) {
				try {
					self::$connection = new AMQPPecl(
						AMQPCredentials::create()
							->setHost(LOGGER_HOST)
							->setPort(LOGGER_PORT)
							->setVirtualHost(LOGGER_VIRTUAL_HOST)
							->setPassword(LOGGER_PASSWORD)
							->setLogin(LOGGER_LOGIN)
					);
					
					self::$channel = self::$connection->createChannel(1);
					
					self::$channel->exchangeDeclare(
						LOGGER_EXCHANGER,
						AMQPExchangeConfig::create()->setType(
							AMQPExchangeType::wrap( AMQPExchangeType::TOPIC )
						)->setDurable(TRUE)
					);
					self::$channel->queueDeclare(
						LOGGER_QUEUE,
						AMQPQueueConfig::create()
							->setDurable(TRUE)
					);
					
					self::$channel->queueBind(
						LOGGER_QUEUE,
						LOGGER_EXCHANGER,
						LOGGER_ROUTING_KEY . '.#'
					);
					
				} catch (Exception $e) {
					error_log(__METHOD__ . " Can't connect to queue: " . $e->getMessage());
				}
			}
	
			return $this;
		}
	
		/**
		 * Проверка на состояние подключения к очереди
		 *
		 * @return boolean
		 */
		public function isConnected()
		{
			if (self::$doNothing) {
				return false;
			}
			return	self::$connection && self::$channel;
		}
	
		/**
		 * Проверяет, подпадает ли указанное местоположение в маску наблюдаемых
		 *
		 * @param int $whereMask
		 * @return boolean
		 */
		public function onMap($whereMask)
		{
			return (self::$currentMap & $whereMask); // Это, мля, битовая конъюнкция, лапы убери, да?
		}
	
		/**
		 * Устанавливает битовую маску, определяющую наблюдаемые источники сообщений
		 *
		 * @param int $mask
		 */
		public function setWatchMap($mask)
		{
			self::$currentMap = $mask;
		}
	
		/**
		 * Подключение временной очереди к обменнику системных сообщений
		 *
		 * @param string $routingKey Ключ роутинга системных сообщений
		 *
		 * @return AMQPPeclChannel
		 * @throws Exception В случае невозможности присоединиться к системной очереди
		 */
		public function getTmpQueue($routingKey)
		{
			$this->connect();
	
			if ($this->isConnected()) {
				$id = uniqid();
				$tmp_queue_name = 'temporary_' . $id;
				
				$channel = self::$connection->createChannel(2);
				
				$channel->queueDeclare(
					$tmp_queue_name,
					AMQPQueueConfig::create()->setAutodelete(true)
				);
				
				$channel->queueBind(
					$tmp_queue_name,
					LOGGER_EXCHANGER,
					$routingKey
				);
				
				return $channel;
			} else {
				if (!self::$doNothing) {
					throw new Exception(__METHOD__ . " Can't connect to system queue");
				}
			}
		}
	
		/**
		 * Получить доступ к основной очереди обменника системных сообщений
		 *
		 * @return AMQPPeclChannel
		 * @throws Exception В случае невозможности присоединиться к системной очереди
		 */
		public function getMainQueue()
		{
			$this->connect();
	
			if ($this->isConnected()) {
				return self::$channel;
			} else {
				if (!self::$doNothing) {
					throw new Exception(__METHOD__ . " Can't connect to system queue");
				}
			}
		}
	
		/**
		 * Отправка неформатированного сообщения через системный логер
		 *
		 * @param string $message Текст сообщения
		 * @param string $routingKey Ключ роутинга сообщения
		 *
		 * @return QueueLogger
		**/
		public function rawPublish($message, $routingKey)
		{
			if (self::$doNothing) {
				return $this;
			}
	
			$this->connect();
			if ($this->isConnected()) {
				
				$msg = AMQPOutgoingMessage::create();
				$msg->setBody(
					$message
				)->setTimestamp(
					Timestamp::makeNow()
				)->setAppId(
					__CLASS__
				);
				
				self::$channel->basicPublish(LOGGER_EXCHANGER, $routingKey, $msg);
				//self::$exchange->publish($message, $routingKey);
			} else {
				if (!self::$doNothing) {
					error_log(sprintf(__METHOD__ . " Can't connect to system queue. Message: '%s' with routing '%s'.", $message, $routingKey));
				}
			}
	
			return $this;
		}
	
	
		/**
		 * Передать сообщение в логер
		 *
		 * @param string $level Информационный уровень сообщения
		 * @param string $message Сообщение
		 * @param string $tag Тэг
		 */
		public function log($level, $message, $tag=null)
		{
			$this->_rawlog($level, $message, $tag);
		}
	
		protected function _rawlog($level, $message, $tag=null)
		{
			if (self::$doNothing) {
				return;
			}
	
			$ts = microtime(true);
			$trace = debug_backtrace();
	
			if (FALSE === ($levelNum = array_search(strtolower($level), $this->levelPriorityMap))) {
				error_log('Logging with unknown loglevel: ' . $level);
				return;
			}
	
			if ($levelNum < self::$currentLevel) {
				return;
			}
	
			$message = array(
				'timestamp' => $ts,
				'level' => $levelNum,
				'message' => $message,
			);
			$message['server'] = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
	
			if ($tag)
				$message['tag'] = $tag;
	
			if (isset($trace[1])) {
				$message['trace'] = array();
				$message['trace']['depth'] = count($trace) - 2;
				if (isset($trace[1]['file']))
					$message['trace']['file'] = $trace[1]['file'];
				if (isset($trace[1]['line']))
					$message['trace']['line'] = $trace[1]['line'];
				if (isset($trace[2]['class']))
					$message['trace']['class'] = $trace[2]['class'];
				if (isset($trace[2]['function']))
					$message['trace']['function'] = $trace[2]['function'];
			}
	
			$this->rawPublish(json_encode($message), LOGGER_ROUTING_KEY . '.' . strtolower($level));
		}
	
		public function setLevel($newCurrentLevel)
		{
			if (FALSE === ($levelNum = array_search(strtolower($newCurrentLevel), $this->levelPriorityMap))) {
				throw new WrongArgumentException("set unknown logging level '${newCurrentLevel}'");
			}
	
			self::$currentLevel = $levelNum;
		}
	
		public function __destruct()
		{
			try {
				$this->disconnect();
			} catch (BaseException $e) {
				// boo.
			}
		}
	
		/**
		 * @param boolean $stopTalking  "хватит трындеть?"
		 * @return QueueLogger
		 */
		public function setDoNothing($stopTalking = true)
		{
			self::$doNothing = ($stopTalking == true);
			return $this;
		}
	}
?>