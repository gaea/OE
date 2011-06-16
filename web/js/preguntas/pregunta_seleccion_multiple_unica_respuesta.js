var form_pregunta_seleccion_multiple_unica_respuesta=new Ext.FormPanel({
	layout:'form',
	frame:true,
	title:'pregunta seleccion multiple unica respuesta',
	monitorValid:true,
	stateful:true,
	labelWidth:80,
	width:320,
	bodyStyle:'padding:15px',
	defaults:{xtype: 'textfield',width:160,allowBlank:false},
	items:[
		{html:'hola'}
	],
	buttons:[
		{text:'registrarse'},
		{text:'Acceder', formBind:true}
	],
	renderTo:'div_pregunta_seleccion_multiple_unica_respuestar'
});
