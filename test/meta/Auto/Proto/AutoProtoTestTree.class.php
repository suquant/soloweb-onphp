<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2010-03-24 21:11:41                           *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoTestTree extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'TestTree', 4, true, true, false, null, null),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, null, false, true, false, null, null),
				'parent' => LightMetaProperty::fill(new LightMetaProperty(), 'parent', 'parent_id', 'integerIdentifier', 'TestTree', null, false, false, false, 1, 2)
			);
		}
	}
?>