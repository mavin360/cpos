<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'ANZO';
?>
<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-btns" style="display: inline-block; width: 100%;">
   <?= $this->Html->link(__('Add Role <i class="fa fa-plus"></i>'), ['action' => 'add_role'],['escape' => false,'class'=>'btn btn-primary']) ?>
</div>		  
</div>
</div>
<?php echo $this->Flash->render(); 

?>

<div class="table-responsive">
    <table class="table mb30 table-danger">
        <thead>
            <tr>
                 <th scope="col">#</th>
                <th scope="col"><?= $this->Paginator->sort('user_role_name','Role Name') ?></th>
				<th scope="col"><?= $this->Paginator->sort('user_role_description','Role Description') ?></th>
				<th scope="col"><?= $this->Paginator->sort('user_role_status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach ($allRoles as $role):?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= h($role->user_role_name) ?></td>
				<td><?= h($role->user_role_description) ?></td>
				<td><?= h($role->user_role_status) ?></td>
               
                <td class="actions">
					 <?php //echo $this->Html->link(__('View'), ['action' => 'view-role', $role->user_role_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit-role', $role->user_role_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete-role', $role->user_role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->user_role_id)]); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>
