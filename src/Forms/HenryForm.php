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

namespace Invo\Forms;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

class HenryForm extends Form
{
    /**
     * Initialize the products form
     *
     * @param null $entity
     * @param array $options
     */
    public function initialize($entity = null, array $options = [])
    {
        if (!isset($options['edit'])) {
            $this->add((new Text('id'))->setLabel('Id'));
        } else {
            $this->add(new Hidden('id'));
        }
        
        $descripcion = new TextArea('descripcion');
        $descripcion->setLabel('Descripción');
        $descripcion->setFilters(['string', 'striptags']);
        $descripcion->addValidators([
            new PresenceOf(['message' => 'Descripción es requerido'])
        ]);
        
        $this->add($descripcion);
        
        $precio = new Text('precio');
        $precio->setLabel('Precio');
        $precio->setFilters(['float']);
        $precio->addValidators([
            new PresenceOf(['message' => 'Precio es requerido']),
            new Numericality(['message' => 'Precio debe ser un valor numérico']),
        ]);
        
        $this->add($precio);
    }
}
