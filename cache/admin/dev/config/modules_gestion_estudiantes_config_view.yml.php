<?php
// auto-generated by sfViewConfigHandler
// date: 2011/02/24 16:08:22
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'Open Evaluation (Administrador)', false, false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('../extjs/resources/css/ext-all.css', '', array ());
  $response->addStylesheet('../extjs/resources/css/xtheme-blue.css', '', array ());
  $response->addStylesheet('../extjs/ex/examples/examples.css', '', array ());
  $response->addStylesheet('../extjs/ex/fileuploadfield/css/fileuploadfield.css', '', array ());
  $response->addJavascript('../extjs/adapter/ext/ext-base.js', '', array ());
  $response->addJavascript('../extjs/ext-all-debug.js', '', array ());
  $response->addJavascript('../extjs/src/locale/ext-lang-es.js', '', array ());
  $response->addJavascript('../extjs/ex/examples/examples.js', '', array ());
  $response->addJavascript('../extjs/examples/ux/Spinner.js', '', array ());
  $response->addJavascript('../extjs/examples/ux/SpinnerField.js', '', array ());
  $response->addJavascript('../extjs/ex/fileuploadfield/FileUploadField.js', '', array ());
  $response->addJavascript('variablesgenerales.js', '', array ());
  $response->addJavascript('funcionesgenerales.js', '', array ());
  $response->addJavascript('../extjs/ex/moreVtypes.js', '', array ());


