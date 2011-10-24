<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class TestUserPartsDAO extends OneToManyLinked
	{
		public function __construct(TestUser $testUser, $lazy = false)
		{
			parent::__construct(
				$testUser,
				TestPart::dao(),
				$lazy
			);
		}
		
		/**
		 * @return TestUserPartsDAO
		**/
		public static function create(TestUser $testUser, $lazy = false)
		{
			return new self($testUser, $lazy);
		}
		
		public function getParentIdField()
		{
			return 'test_user_id';
		}
	}
?>