<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoTestUserDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'test_user';
		}
		
		public function getObjectName()
		{
			return 'TestUser';
		}
		
		public function getSequence()
		{
			return 'test_user_id';
		}
		
		public function uncacheLists()
		{
			TestPart::dao()->uncacheLists();
			
			return parent::uncacheLists();
		}
	}
?>