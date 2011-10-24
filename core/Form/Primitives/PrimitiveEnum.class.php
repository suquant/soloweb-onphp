<?php
/***************************************************************************
 *   Copyright (C) 2011 by Kutcurua Georgy Tamazievich                     *
 *   email: g.kutcurua@gmail.com, icq: 723737, jabber: soloweb@jabber.ru   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/
/* $Id$ */

	/**
	 * @ingroup Primitives
	**/
	class PrimitiveEnum extends IdentifiablePrimitive
	{
		public function getTypeName()
		{
			return 'Scalar';
		}
		
		public function isObjectType()
		{
			return false;
		}
		
		public function getList()
		{
			if ($this->value)
				return call_user_func(
					array(
						get_class($this->value),
						'getObjectList'
					)
				);
			else {
				return call_user_func(array($this->className, 'getObjectList') );
			}
			
			Assert::isUnreachable();
		}

		/**
		 * @throws WrongArgumentException
		 * @return PrimitiveEnumeration
		**/
		public function of($class)
		{
			$className = $this->guessClassName($class);
			
			Assert::classExists($className);
			
			Assert::isInstance($className, 'Enum');
			
			$this->className = $className;
			
			return $this;
		}
		
		public function importValue(/* Identifiable */ $value)
		{
			if ($value)
				Assert::isEqual(get_class($value), $this->className);
			else
				return parent::importValue(null);
			
			return $this->import(array($this->getName() => $value->getId()));
		}
		
		public function import(array $scope)
		{
			if (!$this->className)
				throw new WrongStateException(
					"no class defined for PrimitiveEnum '{$this->name}'"
				);
			
			$result = parent::import($scope);
			
			if ($result === true) {
				try {
					$this->value = new $this->className($this->value);
				} catch (MissingElementException $e) {
					$this->value = null;
					
					return false;
				}
				
				return true;
			}
			
			return $result;
		}
	}
?>