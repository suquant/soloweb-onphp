<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2011-02-09 18:30:05                           *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoTestSubItem extends NamedObject
	{
		protected $item = null;
		protected $encapsulant = null;
		
		public function __sleep()
		{
			return array('id', 'item', 'encapsulant', 'name');
		}
		
		/**
		 * @return TestItem
		**/
		public function getItem()
		{
			return $this->item;
		}
		
		/**
		 * @return TestSubItem
		**/
		public function setItem(TestItem $item)
		{
			$this->item = $item;
			
			return $this;
		}
		
		/**
		 * @return TestSubItem
		**/
		public function dropItem()
		{
			$this->item = null;
			
			return $this;
		}
		
		/**
		 * @return TestEncapsulant
		**/
		public function getEncapsulant()
		{
			return $this->encapsulant;
		}
		
		/**
		 * @return TestSubItem
		**/
		public function setEncapsulant(TestEncapsulant $encapsulant)
		{
			$this->encapsulant = $encapsulant;
			
			return $this;
		}
		
		/**
		 * @return TestSubItem
		**/
		public function dropEncapsulant()
		{
			$this->encapsulant = null;
			
			return $this;
		}
	}
?>