<?php use_helper('I18N', 'Date') ?>
<?php include_partial('maestra_tema_o_materia/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Edit Maestra tema o materia', array(), 'messages') ?></h1>
  </div>

  <?php include_partial('maestra_tema_o_materia/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('maestra_tema_o_materia/form_header', array('tema_o_materia' => $tema_o_materia, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('maestra_tema_o_materia/form', array('tema_o_materia' => $tema_o_materia, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('maestra_tema_o_materia/form_footer', array('tema_o_materia' => $tema_o_materia, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <?php include_partial('maestra_tema_o_materia/themeswitcher') ?>
</div>
