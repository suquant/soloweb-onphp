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
	final class PrimitiveEnumByValue extends PrimitiveEnum
	{
		public function import(array $scope)
		{
			if (!$this->className)
				throw new WrongStateException(
					"no class defined for PrimitiveEnumeration '{$this->name}'"
				);
			
			if (isset($scope[$this->name])) {
				$scopedValue = urldecode($scope[$this->name]);
				
				$names = ClassUtils::callStaticMethod($this->className.'::getNameList');
				
				foreach ($names as $key => $value) {
					if ($value == $scopedValue) {
						try {
							$this->value = new $this->className($key);
						} catch (MissingElementException $e) {
							$this->value = null;
							return false;
						}
						
						return true;
					}
				}
				
				return false;
			}
			
			return null;
		}
		
		public function importValue(/* Identifiable */ $value)
		{
			if( $value && is_scalar( $value ) )
				return $this->import(array($this->getName() => $value));
			else 
				return parent::importValue($value);
		}
	}
?>