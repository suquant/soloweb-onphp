<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class TestEncapsulant extends AutoTestEncapsulant implements Prototyped, DAOConnected
	{
		/**
		 * @return TestEncapsulant
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return TestEncapsulantDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('TestEncapsulantDAO');
		}
		
		/**
		 * @return ProtoTestEncapsulant
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoTestEncapsulant');
		}
		
		// your brilliant stuff goes here
	}
?>