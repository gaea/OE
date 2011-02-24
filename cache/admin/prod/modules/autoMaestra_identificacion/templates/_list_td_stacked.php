<td colspan="2">
  <?php echo __('%%ide_codigo%% - %%ide_tipo%%', array('%%ide_codigo%%' => link_to($identificacion->getIdeCodigo(), 'identificacion_edit', $identificacion), '%%ide_tipo%%' => $identificacion->getIdeTipo()), 'admin') ?>
</td>
