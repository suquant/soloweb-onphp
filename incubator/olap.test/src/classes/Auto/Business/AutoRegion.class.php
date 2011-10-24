<?php
/*****************************************************************************
 *   Copyright (C) 2006-2007, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-0.9.300 at 2007-05-15 15:32:37                       *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoRegion extends NamedObject
	{
		protected $country = null;
		protected $parent = null;
		
		public function getCountry()
		{
			return $this->country;
		}
		
		/**
		 * @return Region
		**/
		public function setCountry($country)
		{
			$this->country = $country;
			
			return $this;
		}
		
		/**
		 * @return Region
		**/
		public function getParent()
		{
			return $this->parent;
		}
		
		/**
		 * @return Region
		**/
		public function setParent(Region $parent)
		{
			$this->parent = $parent;
			
			return $this;
		}
		
		/**
		 * @return Region
		**/
		public function dropParent()
		{
			$this->parent = null;
			
			return $this;
		}
	}
?>