<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tom_codigo">
  <?php if ('tom_codigo' == $sort[0]): ?>
    <?php echo link_to(__('Tom codigo', array(), 'messages'), '@tema_o_materia', array('query_string' => 'sort=tom_codigo&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Tom codigo', array(), 'messages'), '@tema_o_materia', array('query_string' => 'sort=tom_codigo&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_tom_nombre">
  <?php if ('tom_nombre' == $sort[0]): ?>
    <?php echo link_to(__('Tom nombre', array(), 'messages'), '@tema_o_materia', array('query_string' => 'sort=tom_nombre&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Tom nombre', array(), 'messages'), '@tema_o_materia', array('query_string' => 'sort=tom_nombre&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>