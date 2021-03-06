<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2011-02-09 19:33:41                           *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoTestContactValueExtended extends TestContactValue
	{
		protected $web = null;
		protected $skype = null;
		
		public function __sleep()
		{
			return array_merge(
				parent::__sleep(),
				array('web', 'skype')
			);
		}
		
		public function getWeb()
		{
			return $this->web;
		}
		
		/**
		 * @return TestContactValueExtended
		**/
		public function setWeb($web)
		{
			$this->web = $web;
			
			return $this;
		}
		
		public function getSkype()
		{
			return $this->skype;
		}
		
		/**
		 * @return TestContactValueExtended
		**/
		public function setSkype($skype)
		{
			$this->skype = $skype;
			
			return $this;
		}
	}
?>