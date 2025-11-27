<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
    </table>
    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
    <div class="col-md-8">
        <!-- TODO: リファクタリング -->
        <?= $this->Form->postLink(
            'フォローする',
            [
                'controller' => 'Relationships',
                'action' => 'follow',
                 $user->id
            ],
            ['class' => 'btn btn-primary']
        ) ?>
        <h3>Microposts</h3>
        <ul>
            <?php foreach ($microposts as $micropost): ?>
                <?= $this->element('micropost', ['micropost' => $micropost, 'user' => $user]) ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
