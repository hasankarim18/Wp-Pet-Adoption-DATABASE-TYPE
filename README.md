# Wordpress Pet Adoption Database Table

## Example for WordPress CRUD

## Display Pets with query parameters

```

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

  <p>This page took <strong><?php echo timer_stop(); ?></strong> seconds to prepare. Found <strong>x</strong> results
    (showing the first x).</p>


  <table class="pet-adoption-table">
    <tr>
      <th>Name</th>
      <th>Species</th>
      <th>Weight</th>
      <th>Birth Year</th>
      <th>Hobby</th>
      <th>Favorite Color</th>
      <th>Favorite Food</th>
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

        </tr>
        <?php

      }
    }
    ?>


  </table>

</div>

<?php get_footer(); ?>










```
