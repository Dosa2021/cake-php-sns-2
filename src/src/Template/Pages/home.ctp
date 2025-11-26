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