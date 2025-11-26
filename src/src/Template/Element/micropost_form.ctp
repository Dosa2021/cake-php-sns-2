<?= $this->Form->create($micropost, [
  'url' => [
    'controller' => 'Microposts',
    'action' => 'add'
  ]]) ?>
  <div class="field">
    <?php
        echo $this->Form->control('content',  ['type' => 'textarea']);
    ?>
  </div>
  <?= $this->Form->button(__('Post'), array('class'=>'btn btn-primary')) ?>
<?= $this->Form->end() ?>
