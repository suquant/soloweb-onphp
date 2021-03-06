<?php
/***************************************************************************
 *   Copyright (C) 2008 by Konstantin V. Arkhipov                          *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/

	/**
	 * @ingroup Types
	**/
	final class UnsignedSmallInteger extends Integer
	{
		protected $min = 0;
		protected $max = Integer::UNSIGNED_SMALL_MAX;
		
		/**
		 * @return UnsignedSmallInteger
		**/
		public static function create($value = null)
		{
			return new self($value);
		}
	}
?>