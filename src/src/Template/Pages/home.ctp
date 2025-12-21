<main>
    <?php if ($auth): ?>
        <div class="row">
          <aside class="col-md-4">
            <section class="user_info">
            </section>
            <?= $this->element('stats', ['relations_users' => $relations_users]) ?>
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
          <?= $this->Form->create(null, [
            'url' => [
              'controller' => 'Pages',
              'action' => 'exportcsv'
            ]]) ?>
            <?php
              // TODO:
              echo $this->Form->control(null, ['type' => 'select', 'options' => ['2025/11', '2025/12']]);
            ?>
            <?= $this->Form->button(__('CSVダウンロード'), array('class'=>'btn btn-primary')) ?>
          <?= $this->Form->end() ?>
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