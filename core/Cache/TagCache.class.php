<?php
/**
 * Класс для хранения списка ключей объектов определенного класса по одному тегу.
 *
 */
class TagCache extends Singleton
{
	protected $segmentHandler;
	protected $cachePeer;

	public static function me()
	{
		return Singleton::getInstance(__CLASS__);
	}

	public function setPeer($peer)
	{
		$this->cachePeer = $peer;
	}

	/**
	 * Пометить ключ тегом
	 *
	 * @param string $className		Имя класса элементов соответствующего объекта/списка
	 * @param string $cacheKey		Ключ, под которым объект/список сохранен в memcached
	 * @param string $suffix		Суффикс (мало ли, отличать их надо будет)
	 * @return boolean
	 */
	public function touch($className,$cacheKey,$suffix = '')
	{
		$generatedKey = $this->generateKey($className,$suffix);
		$segmentHandler = new CacheSegmentHandler($generatedKey,$this->cachePeer);

		if (QueueLogger::me()->onMap(QueueLogger::WATCH_WORKER))
			QueueLogger::INSANE('Append tag. Generated tag : ' . $generatedKey . ' for cache key ' . $cacheKey . ', suffix: ' . $suffix,'tagCache');

		return $segmentHandler->touch($cacheKey);
	}

	/**
	 * Удалить пометку тегом из ключа
	 *
	 * @param string $className		Имя класса элементов соответствующего объекта/списка
	 * @param string $cacheKey		Ключ, под которым объект/список сохранен в memcached
	 * @param string $suffix		Суффикс (мало ли, отличать их надо будет)
	 * @return boolean
	 */
	public function unlink($className,$cacheKey,$suffix = '')
	{
		$generatedKey = $this->generateKey($className,$suffix);
		$segmentHandler = new CacheSegmentHandler($generatedKey,$this->cachePeer);

		if (QueueLogger::me()->onMap(QueueLogger::WATCH_WORKER))
			QueueLogger::INSANE('Remove tag. Generated tag : ' . $generatedKey . ' for cache key ' . $cacheKey . ', suffix: ' . $suffix,'tagCache');

		return $segmentHandler->unlink($cacheKey);
	}

	/**
	 * Удаление всего тега сразу
	 *
	 * @param string $className		Имя класса элементов соответствующего объекта/списка
	 * @param string $suffix		Суффикс (мало ли, отличать их надо будет)
	 * @return boolean
	 */
	public function drop($className,$suffix = '')
	{
		$generatedKey = $this->generateKey($className,$suffix);
		$segmentHandler = new CacheSegmentHandler($generatedKey,$this->cachePeer);

		if (QueueLogger::me()->onMap(QueueLogger::WATCH_WORKER))
			QueueLogger::INSANE('Drop tag. Generated tag : ' . $generatedKey . ', suffix: ' . $suffix,'tagCache');

		return $segmentHandler->drop();
	}

	/**
	 * Помечен ли данный ключ тегом
	 *
	 * @param string $className		Имя класса элементов соответствующего объекта/списка
	 * @param string $cacheKey		Ключ, под которым объект/список сохранен в memcached
	 * @param string $suffix		Суффикс (мало ли, отличать их надо будет)
	 * @return boolean
	 */
	public function ping($className,$cacheKey,$suffix = '')
	{
		$generatedKey = $this->generateKey($className,$suffix);
		$segmentHandler = new CacheSegmentHandler($generatedKey,$this->cachePeer);

		if (QueueLogger::me()->onMap(QueueLogger::WATCH_WORKER))
			QueueLogger::INSANE('Ping tag. Generated tag : ' . $generatedKey . ' for cache key ' . $cacheKey . ', suffix: ' . $suffix,'tagCache');

		return $segmentHandler->ping($cacheKey);
	}

	/**
	 * Получение всех ключей, помеченных данным тегом
	 *
	 * @param string $className		Имя класса элементов соответствующего объекта/списка
	 * @param string $suffix		Суффикс (мало ли, отличать их надо будет)
	 * @return boolean
	 */
	public function getValueList($className,$suffix = '')
	{
		$generatedKey = $this->generateKey($className,$suffix);
		$segmentHandler = new CacheSegmentHandler($generatedKey,$this->cachePeer);

		if (QueueLogger::me()->onMap(QueueLogger::WATCH_WORKER))
			QueueLogger::INSANE('GetValueList tag. Generated tag : ' . $generatedKey . ', suffix: ' . $suffix,'tagCache');

		return $segmentHandler->getValueList();
	}

	protected function generateKey($className,$suffix = '')
	{
		$generatedTag = $className.'_tag_'.$suffix;
		return $generatedTag;
	}
}
?>