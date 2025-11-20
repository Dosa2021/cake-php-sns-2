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
    <li>
      <?= $this->Html->link(
        'Login',
        '/login',
      ); ?>
    </li>
  </ul>
</header>