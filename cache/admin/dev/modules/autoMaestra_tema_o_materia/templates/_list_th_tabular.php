<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tom_codigo ui-state-default ui-th-column">
  <?php if ('tom_codigo' == $sort[0]): ?>
    <?php /*echo link_to(__('Tom codigo', array(), 'messages'), '@tema_o_materia_maestra_tema_o_materia?sort=tom_codigo&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'), array('class' => $sort[1]))*/ ?>

    <a href="<?php echo url_for('@tema_o_materia_maestra_tema_o_materia?sort=tom_codigo&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Tom codigo', array(), 'messages') ?>
    </a>

    <?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php /*echo link_to(__('Tom codigo', array(), 'messages'), '@tema_o_materia_maestra_tema_o_materia?sort=tom_codigo&sort_type=asc')*/ ?>

    <a href="<?php echo url_for('@tema_o_materia_maestra_tema_o_materia?sort=tom_codigo&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Tom codigo', array(), 'messages') ?>
    </a>

  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tom_nombre ui-state-default ui-th-column">
  <?php if ('tom_nombre' == $sort[0]): ?>
    <?php /*echo link_to(__('Tom nombre', array(), 'messages'), '@tema_o_materia_maestra_tema_o_materia?sort=tom_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'), array('class' => $sort[1]))*/ ?>

    <a href="<?php echo url_for('@tema_o_materia_maestra_tema_o_materia?sort=tom_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc')) ?>">
      <span class="ui-icon <?php echo ($sort[1] == 'asc' ? 'ui-icon-circle-triangle-s' : 'ui-icon-circle-triangle-n') ?>"></span>
      <?php echo __('Tom nombre', array(), 'messages') ?>
    </a>

    <?php //echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php /*echo link_to(__('Tom nombre', array(), 'messages'), '@tema_o_materia_maestra_tema_o_materia?sort=tom_nombre&sort_type=asc')*/ ?>

    <a href="<?php echo url_for('@tema_o_materia_maestra_tema_o_materia?sort=tom_nombre&sort_type=asc') ?>">
      <span class="ui-icon ui-icon-triangle-2-n-s"></span>
      <?php echo __('Tom nombre', array(), 'messages') ?>
    </a>

  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>