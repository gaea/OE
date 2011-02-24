<?php use_helper('I18N', 'Date') ?>
<?php include_partial('maestra_identificacion/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Crear nuevos tipos de identificacion', array(), 'admin') ?></h1>
  </div>

  <?php include_partial('maestra_identificacion/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('maestra_identificacion/form_header', array('identificacion' => $identificacion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('maestra_identificacion/form', array('identificacion' => $identificacion, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('maestra_identificacion/form_footer', array('identificacion' => $identificacion, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <?php include_partial('maestra_identificacion/themeswitcher') ?>
</div>
