<header>
  <?= $this->Html->link(
    'サカヤクション',
    '/',
    ['id' => ['logo']]
  ); ?>
  <ul>
    <li>
      <?= $this->Html->link(
        'Home',
        '/',
      ); ?>
    </li>
    <?php if ($auth): ?>
      <li>
        <?= $this->Html->link(
          'Users',
          ['controller' => 'Users', 'action' => 'index']
        ); ?>
      </li>
      <li>
        <?= $this->Html->link(
          'Logout',
          ['controller' => 'Users', 'action' => 'logout']
        ); ?>
      </li>
    <?php else: ?>
      <li>
        <?= $this->Html->link(
          'Login',
          '/login',
        ); ?>
      </li>
    <?php endif; ?>
  </ul>
</header>
<script>
    // console.log('JavaScript 動いてます！');
</script>
