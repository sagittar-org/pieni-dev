<div class="container">
  <h1><?php h($vars['id']); ?></h1>
  <pre><?php h($vars['title']); ?></pre>
  <h2>Description</h2>
  <pre><?php h($vars['description']); ?></pre>
  <pre><?php h($vars['comment']); ?></pre>
<?php foreach (['parameters' => 'Parameters', 'returnvalues' => 'Return Values', 'changelog' => 'Changelog', 'examples' => 'Examples', 'notes' => 'Notes', 'seealso' => 'See Also'] as $key => $value): ?>
<?php if ($vars[$key] === null) continue; ?>
  <h2><?php h($value); ?></h2>
  <pre><?php h($vars[$key]); ?></pre>
<?php endforeach; ?>
</div>
