<td>
  <?= h($user->name) ?>
  <?php if ($is_admin && !($user->admin)): ?>
    <?= $this->Form->postLink(
      'Delete',
      ['controller' => 'Users', 'action' => 'delete', $user->id],
      ['confirm' => '削除してもよろしいですか?']
    ); ?>
  <?php endif; ?>
</td>
