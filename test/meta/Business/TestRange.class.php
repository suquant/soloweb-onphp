<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class TestRange extends AutoTestRange implements Prototyped, DAOConnected
	{
		/**
		 * @return TestRange
		**/
		public static function create($start = null, $end = null)
		{
			return new self($start = null, $end = null);
		}
		
		/**
		 * @return TestRangeDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('TestRangeDAO');
		}
		
		/**
		 * @return ProtoTestRange
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoTestRange');
		}
		
		// your brilliant stuff goes here
	}
?>