<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class TestSelfRecursion extends AutoTestSelfRecursion implements Prototyped, DAOConnected
	{
		/**
		 * @return TestSelfRecursion
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return TestSelfRecursionDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('TestSelfRecursionDAO');
		}
		
		/**
		 * @return ProtoTestSelfRecursion
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoTestSelfRecursion');
		}
		
		// your brilliant stuff goes here
	}
?>