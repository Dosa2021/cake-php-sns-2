<section class="stats">
  <?php $following_count = count($relations_users->following); ?>
  <?= $this->Html->link(
    "{$following_count} following",
    [
      'controller' => 'Users',
      'action' => 'following',
       $auth['id']], $relations_users
  ); ?>
  <!-- TODO: 実装 -->
  <a href="">
    <?= count($relations_users->followers) ?>
    followers
  </a>
</section>
