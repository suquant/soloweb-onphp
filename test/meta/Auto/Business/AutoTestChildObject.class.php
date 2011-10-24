<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2011-02-09 18:30:05                           *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoTestChildObject extends IdentifiableObject
	{
		protected $parent = null;
		protected $parentId = null;
		
		public function __sleep()
		{
			return array('id', 'parentId');
		}
		
		/**
		 * @return TestParentObject
		**/
		public function getParent()
		{
			if (!$this->parent && $this->parentId) {
				$this->parent = TestParentObject::dao()->getById($this->parentId);
			}
			
			return $this->parent;
		}
		
		public function getParentId()
		{
			return $this->parentId;
		}
		
		/**
		 * @return TestChildObject
		**/
		public function setParent(TestParentObject $parent)
		{
			$this->parent = $parent;
			$this->parentId = $parent->getId();
			
			return $this;
		}
		
		/**
		 * @return TestChildObject
		**/
		public function setParentId($id)
		{
			$this->parent = null;
			$this->parentId = $id;
			
			return $this;
		}
		
		/**
		 * @return TestChildObject
		**/
		public function dropParent()
		{
			$this->parent = null;
			$this->parentId = null;
			
			return $this;
		}
	}
?>