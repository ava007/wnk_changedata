<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $change
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Change'), ['action' => 'edit', $change->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Change'), ['action' => 'delete', $change->id], ['confirm' => __('Are you sure you want to delete # {0}?', $change->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Changes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Change'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="changes view large-9 medium-8 columns content">
    <h3><?= h($change->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($change->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($change->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sts') ?></th>
            <td><?= h($change->sts) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Target Table') ?></th>
            <td><?= h($change->target_table) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Target Uuid') ?></th>
            <td><?= h($change->target_uuid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Target Op') ?></th>
            <td><?= h($change->target_op) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Old') ?></th>
            <td><?= h($change->data_old) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data New') ?></th>
            <td><?= h($change->data_new) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Remarks') ?></th>
            <td><?= h($change->remarks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sourcecty') ?></th>
            <td><?= h($change->sourcecty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sourceip') ?></th>
            <td><?= h($change->sourceip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Target Id') ?></th>
            <td><?= $this->Number->format($change->target_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($change->created) ?></td>
        </tr>
    </table>
</div>
