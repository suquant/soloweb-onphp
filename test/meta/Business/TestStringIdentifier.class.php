<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class TestStringIdentifier extends AutoTestStringIdentifier implements Prototyped, DAOConnected
	{
		/**
		 * @return TestStringIdentifier
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return TestStringIdentifierDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('TestStringIdentifierDAO');
		}
		
		/**
		 * @return ProtoTestStringIdentifier
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoTestStringIdentifier');
		}
		
		// your brilliant stuff goes here
	}
?>