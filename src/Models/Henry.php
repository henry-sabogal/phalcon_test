<?php
declare(strict_types=1);

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Invo\Models;

use Phalcon\Mvc\Model;

class Henry extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $descripcion;

    /**
     * @var float
     */
    public $precio;

}
