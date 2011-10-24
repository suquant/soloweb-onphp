<?php
/****************************************************************************
 *   Copyright (C) 2009 by Sergey S. Sergeev                                *
 *                                                                          *
 *   This program is free software; you can redistribute it and/or modify   *
 *   it under the terms of the GNU Lesser General Public License as         *
 *   published by the Free Software Foundation; either version 3 of the     *
 *   License, or (at your option) any later version.                        *
 *                                                                          *
 ****************************************************************************/

	/**
	 * @ingroup Primitives
	**/
	final class PrimitiveHstoreList extends PrimitiveHstore
	{
		
		public function import(array $scope)
		{
			if (!BasePrimitive::import($scope))
				return null;
			
			$this->rawValue = $scope[$this->name];
			
			if (!is_array($scope[$this->name]))
				return false;
			
			$list = $scope[$this->name];
			
			$resultList = array();
			
			$errorFlag = false;
			
			foreach ($list as $subScope) {
				
				if(
					!is_array($subScope) 
				)
					return false;
				
				$form = $this->makeForm();
				
				$form->import($subScope);
				
				if(
					$form->getInnerErrors()
				)
					$errorFlag = true;
				
				$resultList[] = $form;
			}
			
			$this->imported = true;
			
			$this->value = $resultList;
			
			if (
				count($resultList) != count($list) ||
				$errorFlag
			) {
				return false;
			}
			
			
			return true;
		}
		
		/**
		 * @throws WrongArgumentException
		 * @return boolean
		**/
		public function importValue($value)
		{
			if ($value === null)
				return parent::importValue(null);
			
			Assert::isArray($value, 'importValue');
				
			$list = $value;
			
			$resultList = array();
			
			$errorFlag = false;
			
			foreach ($list as $subScope) {
				
				if(
					!is_array($subScope)
				)
					return false;
				
				$form = $this->makeForm();
				
				$form->import($subScope);
				
				if(
					$form->getInnerErrors()
				)
					$errorFlag = true;
				
				$resultList[] = $form;
			}
			
			$this->imported = true;
			
			$this->value = $resultList;
			
			if (
				count($resultList) != count($list) ||
				$errorFlag
			) {
				return false;
			}
			
			
			return true;
		}

		/**
		 * @return array
		**/
		public function exportValue()
		{
			if (!is_array( $this->value ))
				return null;
			
			$resultList = array();
			
			foreach ( $this->value as $form )
			{
				if( !$form instanceof Form  )
					return null;
				
				$resultList[] = Hstore::make($form->export());
			}
			
			return $resultList;
		}
		
		/**
		 * @return array
		**/
		public function getInnerFormList()
		{
			return $this->getInnerForm();
		}
		
	
		public function getInnerErrors()
		{
			$errors = array();
			
			foreach ( $this->value as $form )
			{
				if(!$form instanceof Form)
					return null;
					
				$errors[] = $form->getInnerErrors();
			}
			
			return $errors;
		}
	
	}
?>