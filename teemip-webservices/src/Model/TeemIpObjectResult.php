<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Webservices\Model;

use ObjectResult;

class TeemIpObjectResult extends ObjectResult
{
    /**
     * @var int
     * @api
     */
    public $subnet_size;
    /**
     * @var array
     * @api
     */
    public $nb_of_ips;
    /**
     * @var string
     * @api
     */
    public $text_file;

}
