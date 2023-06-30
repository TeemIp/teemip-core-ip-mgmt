<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class IPTriggerOnWaterMark extends Trigger {
	public static function Init() {
		$aParams = array
		(
			"category" => "core/cmdb,application,grant_by_profile",
			"key_type" => "autoincrement",
			"name_attcode" => "description",
			"state_attcode" => "",
			"reconc_keys" => array(),
			"db_table" => "priv_trigger_onwatermark",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeExternalKey("org_id", array(
			"targetclass" => "Organization",
			"jointype" => null,
			"allowed_values" => null,
			"sql" => "org_id",
			"is_null_allowed" => false,
			"on_target_delete" => DEL_MANUAL,
			"depends_on" => array(),
		)));
		MetaModel::Init_AddAttribute(new AttributeExternalField("org_name", array("allowed_values" => null, "extkey_attcode" => 'org_id', "target_attcode" => 'name')));
		MetaModel::Init_AddAttribute(new AttributeEnum("target_class", array(
			"allowed_values" => new ValueSetEnum('IPv4Subnet,IPv4Range,IPv6Range'),
			"sql" => "target_class",
			"default_value" => "IPv4Subnet",
			"is_null_allowed" => false,
			"depends_on" => array(),
		)));
		MetaModel::Init_AddAttribute(new AttributeEnum("event", array("allowed_values" => new ValueSetEnum('cross_high,cross_low'), "sql" => "event", "default_value" => "cross_high", "is_null_allowed" => true, "depends_on" => array())));

		// Display lists
		MetaModel::Init_SetZListItems('details', array('org_id', 'description', 'target_class', 'event', 'action_list')); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', array('finalclass', 'target_class', 'description', 'event', 'org_id')); // Attributes to be displayed for a list
	}

	/**
	 * @inheritDoc
	 */
	public function IsInScope(DBObject $oObject) {
		$sTargetClass = $this->Get('target_class');

		return  ($oObject instanceof $sTargetClass);
	}
}
