<textarea name="<?= dot_array_search('name', $options); ?>"
          class="form-control <?= dot_array_search('class', $options); ?>"
          id="<?= dot_array_search('id', $options); ?>"
          style="<?= dot_array_search('style', $options); ?>"
          placeholder="<?= dot_array_search('placeholder', $options); ?>"
          <?= dot_array_search('extra', $options); ?>
    <?= dot_array_search('data', $options); ?>
    <?= dot_array_search('required', $options); ?>
>
<?= dot_array_search('value.0', $options); ?>
</textarea>