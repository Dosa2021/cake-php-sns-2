<?php if ($is_following): ?>
    <?= $this->Form->postLink(
        'unfollow',
        [
            'controller' => 'Relationships',
            'action' => 'unfollow',
             $user->id
        ],
        ['class' => 'btn btn-primary']
    ) ?>
<?php else: ?>
    <?= $this->Form->postLink(
        'follow',
        [
            'controller' => 'Relationships',
            'action' => 'follow',
             $user->id
        ],
        ['class' => 'btn btn-primary']
    ) ?>
<?php endif; ?>
