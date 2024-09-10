<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\NewsroomProvider\Controller;

use CMDBSource;
use MetaModel;
use NewsroomProviderBase;
use User;
use UserRights;

class TeemIpNewsroomProvider extends NewsroomProviderBase
{
	const MODULE_NAME = 'teemip-newsroom-provider';
	const API_VERSION = '1.0';
	const DEFAULT_SETTING_ENABLED = true;
	const DEFAULT_SETTING_DEBUG = false;
	const DEFAULT_SETTING_ENDPOINT = 'https://support.teemip.net/pages/exec.php?exec_module=teemip-newsroom-editor&exec_page=index.php';

	/**
	 * @inheritDoc
	 */
	public function GetTTL(): int
	{
		// Update every hour
		return 60 * 60;
	}

	/**
	 * @inheritDoc
	 */
	public function IsApplicable(User $oUser = null): bool
	{
		if(!$this->IsEnabled())
		{
			return false;
		}
		elseif($oUser !== null)
		{
			return UserRights::IsAdministrator($oUser);
		}
		else
		{
			return false;
		}

	}

	/**
	 * @inheritDoc
	 */
	public function GetLabel(): string
	{
		return 'TeemIp';
	}

	/**
	 * @inheritDoc
	 */
	public function GetMarkAllAsReadURL(): string
	{
		return $this->MakeUrl('mark_all_as_read');
	}

	/**
	 * @inheritDoc
	 */
	public function GetFetchURL(): string
	{
		return $this->MakeUrl('fetch');
	}

	/**
	 * @inheritDoc
	 */
	public function GetViewAllURL(): string
	{
		return $this->MakeUrl('view_all');
	}

	/**
	 * Note: Placeholders are only used in the news' URL
	 *
	 * @inheritDoc
	 * @noinspection PhpUnhandledExceptionInspection
	 */
	public function GetPlaceholders(): array
	{
		$aPlaceholders = array();

		$oUser = UserRights::GetUserObject();
		if ($oUser !== null)
		{
			$aPlaceholders['%user_login%'] = $oUser->Get('login');
			$aPlaceholders['%user_hash%'] = $this->GetUserHash();
		}

		$oContact = UserRights::GetContactObject();
		if ($oContact !== null)
		{
			$aPlaceholders['%contact_firstname%'] = $oContact->Get('first_name');
			$aPlaceholders['%contact_lastname%'] = $oContact->Get('name');
			$aPlaceholders['%contact_email%'] = $oContact->Get('email');
			$aPlaceholders['%contact_organization%'] = $oContact->Get('org_id_friendlyname');
			$aPlaceholders['%contact_location%'] = $oContact->Get('location_id_friendlyname');
		}
		else
		{
			$aPlaceholders['%contact_firstname%'] = '';
			$aPlaceholders['%contact_lastname%'] = '';
			$aPlaceholders['%contact_email%'] = '';
			$aPlaceholders['%contact_organization%'] = '';
			$aPlaceholders['%contact_location%'] = '';
		}
		return $aPlaceholders;
	}

	/**
	 * @inheritDoc
	 */
	public function GetPreferencesUrl(): mixed
	{
		return null;
	}

	/**
	 * Returns true if the module is enabled
	 *
	 * @return boolean
	 * @throws \MySQLException
	 * @throws \MySQLQueryHasNoResultException
	 */
	public static function IsEnabled(): bool
	{
		$defaultValue = static::DEFAULT_SETTING_ENABLED;
		$bValue = MetaModel::GetModuleSetting(static::MODULE_NAME, 'enabled', $defaultValue);
		if ($bValue)
		{
			$oConfig = MetaModel::GetConfig();
			$sLatestInstallationDate = CMDBSource::QueryToScalar("SELECT max(installed) FROM ".$oConfig->Get('db_subname')."priv_module_install");
			$aInstalledITSMDesignerModules = CMDBSource::QueryToArray("SELECT * FROM ".$oConfig->Get('db_subname')."priv_module_install WHERE installed = '".$sLatestInstallationDate."' AND name = 'itsm-designer-connector'");
			if (!empty($aInstalledITSMDesignerModules))
			{
				$bValue = false;
			}
		}
		return $bValue;
	}

	/**
	 * Returns true if the debug option is enabled
	 *
	 * @return boolean
	 */
	public static function IsDebugEnabled(): bool
	{
		$defaultValue = static::DEFAULT_SETTING_DEBUG;
		return MetaModel::GetModuleSetting(static::MODULE_NAME, 'debug', $defaultValue);
	}

	/**
	 * Returns the version of the API called on the remote server
	 *
	 * @return string
	 */
	private static function GetVersion(): string
	{
		return static::API_VERSION;
	}

	/**
	 * Returns a hash to identify the current user
	 * Note: User ID is sent as a non-reversible hash to ensure user's privacy
	 *
     * @return string
     * @throws \OQLException
     */
    private static function GetUserHash(): string
	{
		$sUserId = UserRights::GetUserId();

		// Prepare a unique hash to identify users across all iTops in order to be able for them to tell which news they have already read.
		return hash('fnv1a64', $sUserId);
	}

	/**
	 * Returns an hash to identify the current iTop instance
	 *
	 * Note: iTop UUID is sent as a non-reversible hash to ensure user's privacy
	 *
	 * @return string
	 */
	private static function GetInstanceHash(): string
	{
		$sITopUUID = trim(@file_get_contents(APPROOT . 'data/instance.txt'), "{} \n");

		// Note: We don't retrieve DB UUID for now as it is not of any use for now.
		return hash('fnv1a64', $sITopUUID);
	}

	/**
	 * Returns a URL to the news editor for the $sOperation and current user
	 *
     * @param string $sOperation
     * @return string
     * @throws \OQLException
     */
    private function MakeUrl(string $sOperation): string
	{
		return static::DEFAULT_SETTING_ENDPOINT
			.'&operation='.$sOperation
			.'&version='.$this->GetVersion()
			.'&user='.urlencode($this->GetUserHash())
			.'&instance='.urlencode($this->GetInstanceHash());
	}
}
