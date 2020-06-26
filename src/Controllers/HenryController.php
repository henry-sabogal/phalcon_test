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

namespace Invo\Controllers;

use Invo\Forms\HenryForm;
use Invo\Models\Henry;
use Phalcon\Paginator\Adapter\Model as Paginator;

class HenryController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Henry');
    }

    public function indexAction(): void
    {
        $items = Henry::find();
        $this->view->items = $items;
    }
    
    /**
     * Creates a new item
     */
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'products',
                'action'     => 'index',
            ]);

            return;
        }

        $form = new HenryForm();
        $henry = new Henry();

        if (!$form->isValid($this->request->getPost(), $henry)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'henry',
                'action'     => 'new',
            ]);

            return;
        }

        if (!$henry->save()) {
            foreach ($henry->getMessages() as $message) {
                $this->flash->error((string)$message);
            }

            $this->dispatcher->forward([
                'controller' => 'henry',
                'action'     => 'new',
            ]);

            return;
        }

        $form->clear();
        $this->flash->success('Henry item was created successfully');

        $this->dispatcher->forward([
            'controller' => 'henry',
            'action'     => 'index',
        ]);
    }
    
    /**
     * Shows the form to create a new item
     */
    public function newAction(): void
    {
        $this->view->form = new HenryForm(null, ['edit' => true]);
    }
    
    /**
     * Edits a item based on its id
     *
     * @param $id
     */
    public function editAction($id): void
    {
        $henry = Henry::findFirstById($id);
        if (!$henry) {
            $this->flash->error('Item was not found');

            $this->dispatcher->forward([
                'controller' => 'henry',
                'action'     => 'index',
            ]);

            return;
        }

        $this->view->form = new HenryForm($henry, ['edit' => true]);
    }
    
    /**
     * Saves current product in screen
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'henry',
                'action'     => 'index',
            ]);

            return;
        }

        $id = $this->request->getPost('id', 'int');
        $henry = Henry::findFirstById($id);
        if (!$henry) {
            $this->flash->error('Item does not exist');

            $this->dispatcher->forward([
                'controller' => 'henry',
                'action'     => 'index',
            ]);

            return;
        }

        $form = new HenryForm();
        $this->view->form = $form;
        $data = $this->request->getPost();

        if (!$form->isValid($data, $henry)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'henry',
                'action'     => 'edit',
                'params'     => [$id],
            ]);

            return;
        }

        if (!$henry->save()) {
            foreach ($henry->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'henry',
                'action'     => 'edit',
                'params'     => [$id],
            ]);

            return;
        }

        $form->clear();
        $this->flash->success('Item was updated successfully');

        $this->dispatcher->forward([
            'controller' => 'henry',
            'action'     => 'index',
        ]);
    }
    
    /**
     * Deletes a item
     *
     * @param string $id
     */
    public function deleteAction($id): void
    {
        $henry = Henry::findFirstById($id);
        if (!$henry) {
            $this->flash->error('Item was not found');

            $this->dispatcher->forward([
                'controller' => 'henry',
                'action'     => 'index',
            ]);

            return;
        }

        if (!$henry->delete()) {
            foreach ($henry->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'henry',
                'action'     => 'index',
            ]);

            return;
        }

        $this->flash->success('Item was deleted');

        $this->dispatcher->forward([
            'controller' => 'henry',
            'action'     => 'index',
        ]);
    }
    
}
