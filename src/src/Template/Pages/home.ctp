<main>
    <?php if ($auth): ?>
        <div class="row">
          <aside class="col-md-4">
            <section class="user_info">
            </section>
            <section class="micropost_form">
                <?= $this->element('micropost_form', ['micropost' => $micropost]) ?>
            </section>
          </aside>
            <div class="col-md-8">
              <h3>Micropost Feed</h3>
                <?php foreach ($feed_items as $feed_item): ?>
                     <?= $this->element('feed', ['micropost' => $feed_item]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <nav>2025/11/21</nav>
        <?= $this->Html->link(
            '新規登録',
            '/signup',
            ['class' => ['signup']]
        ); ?>
    <?php endif; ?>
</main>