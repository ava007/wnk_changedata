<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $changes
 */
?>
<div class="changes index large-9 medium-8 columns content">
    <h3><?= __('Changes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sts') ?></th>
                <th scope="col"><?= $this->Paginator->sort('target_table') ?></th>
                <th scope="col"><?= $this->Paginator->sort('target_op') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remarks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sourcecty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sourceip') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($changes as $change): ?>
            <tr>
                <td><?= h($change->created) ?></td>
                <td><?= h($change->email) ?></td>
                <td><?= h($change->sts) ?></td>
                <td><?= h($change->target_table) ?></td>
                <td><?= h($change->target_op) ?></td>
                <td><?= h($change->remarks) ?></td>
                <td><?= h($change->sourcecty) ?></td>
                <td><?= h($change->sourceip) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Approve'), ['action' => 'approve', $change->id]) ?>
                    <?= $this->Html->link(__('Reject'), ['action' => 'reject', $change->id]) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $change->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
