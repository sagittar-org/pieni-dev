<p>
  <?php \pieni\utility\Utility::h('<<< This string is escaped by \pieni\utility\Utility::h() >>>'); ?>
</p>
<hr>

<p>
  <?php \pieni\utility\Utility::href(''); ?>
</p>
<hr>

<p>
  Every direct resource are must be located in<br>
  <i><?php \pieni\utility\Utility::h(\pieni\core\FCPATH); ?>/<strong>public</strong></i>.<br>
</p>
<img src="<?php \pieni\utility\Utility::pub('logo.svg'); ?>">
<p>
  This image is referenced by symbolic link:<br>
  <i><?php \pieni\utility\Utility::h(\pieni\core\FCPATH); ?>/<strong>public</strong>/vendor/pieni/utility/logo.svg</i>
</p>
<p>
  Actual image path is:<br>
  <i><?php \pieni\utility\Utility::h(\pieni\core\FCPATH); ?>/vendor/pieni/utility/<strong>public</strong>/logo.svg</i><br>
</p>
<hr>

<p>
  <?php \pieni\utility\Utility::loadView(\pieni\core\REQUEST['method'], [], str_repeat(' ', 2)); ?>
</p>
