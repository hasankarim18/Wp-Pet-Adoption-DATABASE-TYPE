<?php



get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image"
    style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg'); ?>);"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">Pet Adoption</h1>
    <div class="page-banner__intro">
      <p>Providing forever homes one search at a time.</p>
    </div>
  </div>
</div>

<div class="container container--narrow page-section">

  <?php
  $pets = get_query_var('petad_pets', []);
  $count = get_query_var('count_pets', []);
  $count_value = $count[0]->{"COUNT(*)"};
  ?>

  <p>This page took <strong><?php echo timer_stop(); ?></strong> seconds to prepare. Found
    <strong><?php echo number_format($count_value); ?></strong> results
    (showing the first <?php echo count($pets); ?>).
  </p>


  <table class="pet-adoption-table">
    <tr>
      <th>Name</th>
      <th>Species</th>
      <th>Weight</th>
      <th>Birth Year</th>
      <th>Hobby</th>
      <th>Favorite Color</th>
      <th>Favorite Food</th>
      <?php if (current_user_can('administrator')): ?>
        <th>Actions</th>
      <?php endif; ?>
    </tr>
    <?php

    $pets = get_query_var('petad_pets', []);

    if (!empty($pets)) {
      foreach ($pets as $pet) {
        ?>
        <tr>
          <td><?php echo sanitize_text_field($pet->petname); ?></td>
          <td><?php echo sanitize_text_field($pet->species); ?></td>
          <td><?php echo sanitize_text_field($pet->petweight); ?></td>
          <td><?php echo sanitize_text_field($pet->birthyear); ?></td>
          <td><?php echo sanitize_text_field($pet->favhobby); ?></td>
          <td><?php echo sanitize_text_field($pet->favcolor); ?></td>
          <td><?php echo sanitize_text_field($pet->favfood); ?></td>
          <?php if (current_user_can('administrator')): ?>
            <td>
              <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="POST">
                <input type="hidden" name="action" value="deletepet">
                <input type="hidden" name="id" value="<?php echo $pet->id; ?>">
                <button class="delete-pet-button">Delete</button>
              </form>
            </td>
          <?php endif; ?>

        </tr>
        <?php

      }
    }
    ?>


  </table>

  <?php
  if (current_user_can('administrator')) {
    $petName = isset($_POST['incommingpetname']) ? sanitize_text_field($_POST['incommingpetname']) : '';
    //  echo $petName;
    ?>
    <form class="create-pet-form" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <p>Enter Just the name of the pet name, other will be generated randomly</p>
      <input type="hidden" name="action" value="createpet">
      <input style="padding:10px; border-radius: 5px;" type="text" name="incommingpetname" placeholder="name....">
      <button style="padding:10px 20px;border-radius:5px;">Add Pet</button>
    </form>
    <?php
  }
  ?>

</div>

<?php get_footer(); ?>