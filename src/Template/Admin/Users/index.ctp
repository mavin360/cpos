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
?>

<?php //pr($users); ?>

<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-btns" >
   <?= $this->Html->link(__('Add User <i class="fa fa-plus"></i>'), ['action' => 'add'],['escape' => false,'class'=>'btn btn-primary']) ?>
</div>		  
</div>

<?php echo $this->Flash->render(); ?>
<div class="table-responsive col-sm-9">
    <table class="table mb30 table-danger">
        <thead>
            <tr>
                 <th scope="col">#</th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
				<th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
				<th scope="col"><?= $this->Paginator->sort('email') ?></th>
				<th scope="col"><?= $this->Paginator->sort('phone') ?></th>
				<th scope="col"><?= $this->Paginator->sort('user_role_id','User Role') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach ($users as $user): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= h($user->first_name) ?></td>
				<td><?= h($user->last_name) ?></td>
				<td><?= h($user->email) ?></td>
				<td><?= h($user->phone) ?></td>
				<td><?= h($user->user_role->user_role_name) ?></td>
                <td><?= h($user->user_status) ?></td>
               
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
	<?php if($this->Paginator->counter('{{pages}}')>1){?>
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
	<?php }?>	
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

<div class="col-sm-3">

</div>
</div>
