<div class="row">
  <aside class="col-md-4">
    <section class="user_info">
      <!-- TODO -->
      ※ プロフィール画像が入る予定
      <h1><?= $user->name ?></h1>
      <span>view my profile</span>
      <span><strong>Microposts:</strong>※ user.microposts.count</span>
    </section>
    <!-- TODO
    <section class="stats">
      <%= render 'shared/stats' %>
      <% if @users.any? %>
        <div class="user_avatars">
          <% @users.each do |user| %>
            <%= link_to gravatar_for(user, size: 30), user %>
          <% end %>
        </div>
      <% end %>
    </section> -->
  </aside>
  <div class="col-md-8">
    <h3><?= $title ?></h3>
    <!-- <% if @users.any? %>
      <ul class="users follow">
        <%= render @users %>
      </ul>
      <%= will_paginate %>
    <% end %> -->
    <ul class="users follow">
      <?php foreach ($relations_users->following as $relations_user): ?>
        <li><?= $relations_user->name ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
