<?php
/***************************************************************************
 *   Copyright (C) 2011 by Kutcurua Georgy Tamazievich                     *
 *   email: g.kutcurua@gmail.com, icq: 723737, jabber: soloweb@jabber.ru   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/

	/**
	 * Explode function apply
	 * 
	 * @ingroup Filters
	**/
	final class ExplodeFilter extends BaseFilter
	{
		protected $delimiter		= NULL;
		
		protected $limit			= NULL;
		
		/**
		 * @return RemoveNewLineFilter
		**/
		public static function me()
		{
			return Singleton::getInstance(__CLASS__);
		}
		
		/**
		 * Delimiter
		 * @return ExplodeFilter
		 */
		public function setDelimiter($delimiter)
		{
			Assert::isScalar($delimiter);
			
			$this->delimiter = $delimiter;
			
			return $this;
		}
		
		/**
		 * Limit
		 * @return ExplodeFilter
		 */
		public function setLimit($limit)
		{
			Assert::isInteger($limit);
			
			$this->limit = $limit;
			
			return $this;
		}
		
		public function apply($value)
		{
			Assert::isNotNull(
				$this->delimiter,
				'delimiter must be setted!'
			);
			
			if( $this->limit )
				return explode($this->delimiter, $value, $this->limit);
				
			return explode($this->delimiter, $value);
		}
	}
?>