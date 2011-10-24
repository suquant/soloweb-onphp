<?php
/***************************************************************************
 *		Created by Kutcurua Georgy Tamazievich at 15.11.2010 14:05:55
 *		email: g.kutcurua@gmail.com, icq: 723737, jabber: soloweb@jabber.ru
 ***************************************************************************/
/* $Id$ */
 
	final class PrimitiveUniversalUniqueString extends PrimitiveString
	{
		const UUID_PATTERN = '/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i';
		
		/**
		 * @param string $name
		 * @return PrimitiveUniversalUniqueString
		 */
		public static function create($name)
		{
			return new self($name);
		}
		
		public function __construct($name)
		{
			parent::__construct($name);
			$this->setAllowedPattern(self::UUID_PATTERN);
		}
		
		
	} 