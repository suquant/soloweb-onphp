<?php
/***************************************************************************
 *   Copyright (C) 2010 by Kutcurua Georgy Tamazievich                     *
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
	 * @ingroup Types
	**/
	final class UniversalUniqueIdentifier extends RangedType
	{
		/**
		 * @return UniversalUniqueIdentifier
		**/
		public static function create($value = null)
		{
			return new self($value);
		}
		
		/**
		 * @return UniversalUniqueIdentifier
		**/
		public function setValue($value)
		{
			if (
				Assert::checkUniversalUniqueIdentifier($value)
			) {
				$this->checkLimits(mb_strlen($value));
				$this->value = $value;
				
				return $this;
			}
			
			throw new WrongArgumentException();
		}
	}
?>