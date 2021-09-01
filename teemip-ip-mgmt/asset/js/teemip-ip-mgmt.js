/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

function IpWidget(id, sTargetClass, sTitle, iChangeId, oDefault) {
	this.id = id;
	this.sTargetClass = sTargetClass;
	this.sTitle = sTitle;
	this.iChangeId = iChangeId;
	this.oDefault = oDefault;
	this.bCreationInProgress = false;
	this.ajax_request = null;
	this.v_html = '';
	var me = this;

	this.Init = function () {
		// make sure that the form is clean
		$('#'+this.id+'_btnRemove').prop('disabled', true);
		$('#'+this.id+'_linksToRemove').val('');
	}

	this.StopPendingRequest = function () {
		if (me.ajax_request) {
			me.ajax_request.abort();
			me.ajax_request = null;
		}
	}

	this.DisplayCreationForm = function () {
		me.v_html = $('#v_'+me.id).html();
		$('#v_'+me.id).html(me.v_html).append('<img src="'+GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/asset/img/ipindicator-xs.gif" alt="" />');
		var theMap = {
			operation: 'get_ip_creation_form',
			vid: me.id,
			class: me.sTargetClass,
			default: me.oDefault
		}

		// Make sure that we cancel any pending request before issuing another since responses may arrive in arbitrary order
		me.StopPendingRequest();

		// Create dialog zone
		if ($('#dialog_content').length === 0) {
			$('<div id="dialog_content"></div>').appendTo('body');
		}

		// Run the query
		me.ajax_request = $.post(GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/ajax.teemip-ip-mgmt.php',
			theMap,
			function (data) {
				$('#dialog_content').html(data);
				$('#dialog_content').dialog({
					title: me.sTitle,
					modal: true,
					width: 850
				});
				$('#dialog_content').dialog("option", "close", me.OnCloseCreateIpObject);
				// Modify the action of the cancel button
				$('#dialog_content'+' button.cancel').off('click').on('click', function (e) {
					me.CloseCreateIpObject();
					e.stopImmediatePropagation();
				});
				me.ajax_request = null;
				// Adjust the dialog's size to fit into the screen
				if ($('#dialog_content').width() > ($(window).width()-40)) {
					$('#dialog_content').width($(window).width()-40);
				}
				if ($('#dialog_content').height() > ($(window).height()-70)) {
					$('#dialog_content').height($(window).height()-70);
				}
				switch (me.sTargetClass) {
					// Warning: parameter '2' needs to be programmatically set
					case 'IPv4Block':
					case 'IPv6Block':
						$('#field_2_org_id').attr('readonly', true);
						$('#2_org_id').attr('readonly', true);
						$('#2_parent_id').attr('readonly', true);
						$('#2_firstip').attr('readonly', true);
						$('#2_lastip').attr('readonly', true);
						break;

					case 'IPv4Subnet':
					case 'IPv6Subnet':
						$('#2_org_id').attr('readonly', true);
						$('#2_block_id').attr('readonly', true);
						$('#2_ip').attr('readonly', true);
						$('#2_mask').attr('readonly', true);
						break;

					case 'IPv4Range':
					case 'IPv6Range':
						$('#2_org_id').attr('readonly', true);
						$('#2_subnet_id').attr('readonly', true);
						$('#2_firstip').attr('readonly', true);
						$('#2_lastip').attr('readonly', true);
						break;

					case 'IPv4Address':
					case 'IPv6Address':
						$('#2_org_id').attr('readonly', true);
						$('#2_ip').attr('readonly', true);
						break;

					default:
				}
				}
			);
	}
	
	this.DoCreateIpObject = function()
	{
		var sFormId = $('#dcr_'+me.id+' form').attr('id');
		if (CheckFields(sFormId, true))
		{
			$('#'+sFormId).block();
			var theMap = { class: me.sTargetClass,
				changeid: me.iChangeId,
				vid: me.id,
				default: me.oDefault
				}
			
			// Gather the values from the form
			// Gather the parameters from the search form
			$('#'+sFormId+' :input').each(
				function () {
					if (this.name != '') {
						theMap[this.name] = this.value;
					}
				}
				);
			
			// Override the 'operation' code
			theMap['operation'] = 'do_create_ip_object';
			
			me.bCreationInProgress = true;
			$('#dialog_content').dialog('close');
			
			// Make sure that we cancel any pending request before issuing another
			// since responses may arrive in arbitrary order
			me.StopPendingRequest();
			
			// Run the query
			me.ajax_request = $.post(GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/ajax.teemip-ip-mgmt.php',
				theMap,
				function (data) {
					// Insert newly created object in list
					$('#v_'+me.id).html(data);
					me.ajax_request = null;
				}
			);
		}
		return false; // do NOT submit the form 
	}

	this.CloseCreateIpObject = function () {
		$('#dialog_content').dialog("close");
	}

	this.OnCloseCreateIpObject = function () {
		if (!me.bCreationInProgress) {
			$('#v_'+me.id).html(me.v_html);
		}
		$('#dialog_content').dialog("destroy");
		$('#dialog_content').remove();
		me.ajax_request = null;
//		window.onbeforeunload = function () {
//		};
	}
}