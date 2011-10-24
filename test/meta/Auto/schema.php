<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1 at 2011-02-09 19:29:32                           *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	$schema = new DBSchema();
	
	$schema->
		addTable(
			DBTable::create('test_tree')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TEXT),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER),
					'parent_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_range')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::DATE)->
					setNull(false),
					'start'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::DATE),
					'end'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TEXT),
					'description'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('custom_table')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(50),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_encapsulant')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(50),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_user')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(255),
					'nickname'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::CHAR)->
					setNull(false)->
					setSize(40),
					'password'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP)->
					setNull(false),
					'very_custom_field_name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP)->
					setNull(false),
					'registered'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIME),
					'strange_time'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'city_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'first_optional_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'second_optional_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(256),
					'url'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TEXT),
					'properties'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER),
					'ip'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_part')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'test_user_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(50),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_binary_stuff')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(40),
					'id'
				)->
				setPrimaryKey(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BINARY)->
					setNull(false),
					'data'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_item')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(50),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_sub_item')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'test_item_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'encapsulant_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(50),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_parent_object')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'root_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_child_object')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'parent_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_self_recursion')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'parent_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_lazy')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'city_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'city_optional_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'enum_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_object')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(50),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_type')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(50),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_string_identifier')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(40),
					'id'
				)->
				setPrimaryKey(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(32),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_string_identifier_related')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TEXT),
					'test_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_user_with_contact')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(255),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(255),
					'surname'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(255),
					'email'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER),
					'icq'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(255),
					'phone'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'city_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_user_with_contact_extended')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(255),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(255),
					'surname'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(255),
					'email'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER),
					'icq'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(255),
					'phone'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'city_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(255),
					'web'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(255),
					'skype'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('test_encapsulant_custom_table')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'custom_table_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'test_encapsulant_id'
				)
			)->
			addUniques('custom_table_id', 'test_encapsulant_id')
		);
	
	// test_user.city_id -> custom_table.id
	$schema->
		getTableByName('test_user')->
		getColumnByName('city_id')->
		setReference(
			$schema->
				getTableByName('custom_table')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// test_user.first_optional_id -> custom_table.id
	$schema->
		getTableByName('test_user')->
		getColumnByName('first_optional_id')->
		setReference(
			$schema->
				getTableByName('custom_table')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// test_user.second_optional_id -> custom_table.id
	$schema->
		getTableByName('test_user')->
		getColumnByName('second_optional_id')->
		setReference(
			$schema->
				getTableByName('custom_table')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	$schema->
		addTable(
			DBTable::create('test_user_test_encapsulant')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'test_encapsulant_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'test_user_id'
				)
			)->
			addUniques('test_encapsulant_id', 'test_user_id')
		);
	
	// test_part.test_user_id -> test_user.id
	$schema->
		getTableByName('test_part')->
		getColumnByName('test_user_id')->
		setReference(
			$schema->
				getTableByName('test_user')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// test_sub_item.test_item_id -> test_item.id
	$schema->
		getTableByName('test_sub_item')->
		getColumnByName('test_item_id')->
		setReference(
			$schema->
				getTableByName('test_item')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// test_sub_item.encapsulant_id -> test_encapsulant.id
	$schema->
		getTableByName('test_sub_item')->
		getColumnByName('encapsulant_id')->
		setReference(
			$schema->
				getTableByName('test_encapsulant')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// test_parent_object.root_id -> test_child_object.id
	$schema->
		getTableByName('test_parent_object')->
		getColumnByName('root_id')->
		setReference(
			$schema->
				getTableByName('test_child_object')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// test_child_object.parent_id -> test_parent_object.id
	$schema->
		getTableByName('test_child_object')->
		getColumnByName('parent_id')->
		setReference(
			$schema->
				getTableByName('test_parent_object')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// test_self_recursion.parent_id -> test_self_recursion.id
	$schema->
		getTableByName('test_self_recursion')->
		getColumnByName('parent_id')->
		setReference(
			$schema->
				getTableByName('test_self_recursion')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// test_lazy.city_id -> custom_table.id
	$schema->
		getTableByName('test_lazy')->
		getColumnByName('city_id')->
		setReference(
			$schema->
				getTableByName('custom_table')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// test_lazy.city_optional_id -> custom_table.id
	$schema->
		getTableByName('test_lazy')->
		getColumnByName('city_optional_id')->
		setReference(
			$schema->
				getTableByName('custom_table')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	$schema->
		addTable(
			DBTable::create('test_object_test_type')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'test_type_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'test_object_id'
				)
			)->
			addUniques('test_type_id', 'test_object_id')
		);
	
	$schema->
		addTable(
			DBTable::create('test_type_test_object')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'test_object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'test_type_id'
				)
			)->
			addUniques('test_object_id', 'test_type_id')
		);
	
	// test_string_identifier_related.test_id -> test_string_identifier.id
	$schema->
		getTableByName('test_string_identifier_related')->
		getColumnByName('test_id')->
		setReference(
			$schema->
				getTableByName('test_string_identifier')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
?>