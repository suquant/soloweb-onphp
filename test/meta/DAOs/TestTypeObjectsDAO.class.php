<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	final class TestTypeObjectsDAO extends ManyToManyLinked
	{
		public function __construct(TestType $testType, $lazy = false)
		{
			parent::__construct(
				$testType,
				TestObject::dao(),
				$lazy
			);
		}
		
		/**
		 * @return TestTypeObjectsDAO
		**/
		public static function create(TestType $testType, $lazy = false)
		{
			return new self($testType, $lazy);
		}
		
		public function getHelperTable()
		{
			return 'test_type_test_object';
		}
		
		public function getChildIdField()
		{
			return 'test_object_id';
		}
		
		public function getParentIdField()
		{
			return 'test_type_id';
		}
	}
?>