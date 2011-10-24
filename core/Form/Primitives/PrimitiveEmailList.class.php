<?php
/***************************************************************************
 *   Copyright (C) 2010 by Kutcurua Georgy Tamazievich                     *
 *   email: g.kutcurua@gmail.com, icq: 723737, jabber: soloweb@jabber.ru   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/
/* $Id$ */

	class PrimitiveEmailList extends PrimitiveEmail  {

		/**
		 * Email list
		 *
		 * @param String $name
		 * @return PrimitiveEmailList
		 */
		public static function create($name) {
			return new self($name);
		}
		
		/**
		 * @return PrimitiveEmailList
		**/
		public function setValue($value)
		{
			if ($value) {
				Assert::isArray($value);
				Assert::isTrue(
						preg_match(PrimitiveString::MAIL_PATTERN, current($value) )
					);
			}
			
			$this->value = $value;
			
			return $this;
		}
		
		public function importValue($value)
		{
			if (is_array($value)) {
				try {
					Assert::isTrue(
						preg_match(PrimitiveString::MAIL_PATTERN, current($value) )
					);
					
					return $this->import(
						array($this->name => $value)
					);
				} catch (WrongArgumentException $e) {
					return $this->import(
						array($this->name => ArrayUtils::getIdsArray($value))
					);
				}
			}
			
			return parent::importValue($value);
		}
		
		public function import(array $scope)
		{
			
			if (!BasePrimitive::import($scope))
				return null;
			
			if (!is_array($scope[$this->name]))
				return false;
			
			$list = array_unique($scope[$this->name]);
			
			$values = array();
			
			foreach ($list as $value) {
				if (!preg_match( PrimitiveString::MAIL_PATTERN , $value) )
					return false;
				
				$values[] = $value;
			}
			
			$validList = array();
			
			foreach ($values as $value) {
				$validList[] = $value;
			}
			
			if (count($validList) == count($values)) {
				$this->value = $validList;
				return true;
			}
			
			return false;
		}
		
		public function exportValue()
		{
			if (!$this->value)
				return null;
			
			return $this->value;
		}

	}


?>