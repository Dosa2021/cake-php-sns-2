<li>
  <span><?= $micropost->content ?></span>
  <?php if ($auth['id'] === $user->id): ?>
    <?= $this->Form->postLink(
      'Delete',
      ['controller' => 'Microposts', 'action' => 'delete', $micropost->id ],
      ['confirm' => '削除してもよろしいですか?']
    ); ?>
  <?php endif; ?>
</li>

