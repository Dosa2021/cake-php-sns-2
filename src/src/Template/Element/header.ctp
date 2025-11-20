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
