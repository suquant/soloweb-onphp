<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class TestBinaryStuff extends AutoTestBinaryStuff implements Prototyped, DAOConnected
	{
		/**
		 * @return TestBinaryStuff
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return TestBinaryStuffDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('TestBinaryStuffDAO');
		}
		
		/**
		 * @return ProtoTestBinaryStuff
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoTestBinaryStuff');
		}
		
		// your brilliant stuff goes here
	}
?>