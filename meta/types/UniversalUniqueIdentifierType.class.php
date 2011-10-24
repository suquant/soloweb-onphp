<?php
/***************************************************************************
 *	 Created by Kutcurua Georgy Tamazievich at 15.11.2010 13:39:03         *
 *	 email: g.kutcurua@gmail.com, icq: 723737, jabber: soloweb@jabber.ru   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/

	final class UniversalUniqueIdentifierType extends BasePropertyType
	{
		
		public function getPrimitiveName()
		{
			return 'uuid';
		}
		
		public function getDeclaration()
		{
			return 'null';
		}
		
		public function toColumnType($length = null)
		{
			return 'DataType::create(DataType::UUID)';
		}
		
		public function isMeasurable()
		{
			return false;
		}
		
	} 