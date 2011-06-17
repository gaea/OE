<?php use_helper('I18N', 'Date') ?>
<?php include_partial('admin_tema_o_materia/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Admin tema o materia', array(), 'messages') ?></h1>

  <?php include_partial('admin_tema_o_materia/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('admin_tema_o_materia/form_header', array('tema_o_materia' => $tema_o_materia, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('admin_tema_o_materia/form', array('tema_o_materia' => $tema_o_materia, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('admin_tema_o_materia/form_footer', array('tema_o_materia' => $tema_o_materia, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
