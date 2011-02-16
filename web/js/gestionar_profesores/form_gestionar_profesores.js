var gestionar_profesores_datastore = new Ext.data.GroupingStore({
		id: 'gestionar_profesores_datastore',
		proxy: new Ext.data.HttpProxy({
			url: 'gestion_profesores/consultarProfesores',
			method: 'POST',
			limit: 20,
			start: 0
		}),
		baseParams:{}, 
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			//id: 'id_reader'
			},[ 
				{name:'ges_pro_codigo_usuario'},
				{name:'ges_pro_codigo'},
				{name:'ges_pro_nombres'},
				{name:'ges_pro_apellidos'},
				{name:'ges_pro_login'},
				{name:'ges_pro_identificacion_codigo'},
				{name:'ges_pro_tipo_identificacion_nombre'},
				{name:'ges_pro_e-mail'},
				{name:'ges_pro_telefono'},
				{name:'ges_pro_url-image'},
				{name:'ges_pro_habilitado'},
			]),
		sortInfo:{field: 'codigo', direction: "ASC"}
	});
//gestionar_profesores_datastore.load();

var gestionar_profesores_tpl = new Ext.XTemplate(
	'<div class="thumb-wrap" id="{name}">',
	'<div class="thumb"><img src="{url}" title="{name}"></div>',
	'</div>',
	'<div class="x-clear"></div>'
);

var ges_pro_tipo_identificacion_datastore = new Ext.data.GroupingStore({
	id: 'ges_pro_tipo_identificacion_datastore',
	proxy: new Ext.data.HttpProxy({
		url: 'tipo_identificacion/consultarTipos',
		method: 'POST'
	}),
	reader: new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'id'
	},
	[ 
		{name: 'ges_pro_tipo_identificacion_codigo'},
		{name: 'ges_pro_tipo_identificacion_nombre'}
	]),
	sortInfo:{field: 'identificacion_nombre', direction: "ASC"}
});
//ges_pro_tipo_identificacion_datastore.load();

var ges_pro_tipo_identificacion_combo = new Ext.form.ComboBox({
	xtype: 'combo',
	name: 'ges_pro_tipo_identificacion_nombre',
	id: 'ges_pro_tipo_identificacion_combo',
	fieldLabel: 'Tipo de identificacion',
	width: 168,
	mode: 'local',
	store: ges_pro_tipo_identificacion_datastore,
	valueField: 'ges_pro_tipo_identificacion_codigo',
	displayField:'ges_pro_tipo_identificacion_nombre',
	typeAhead: true,
	triggerAction: 'all',
	allowBlank: false,
	forceSelection: true, 
	selectOnFocus: true,
	emptyText: ' [seleccione uno]'
});	

var form_gestionar_profesores = new Ext.Panel({
	layout:'border',
	height:screen.height-213,
	defaults: {
		collapsible:true,
		split:true,
		bodyStyle:'padding:15px'
	},
	tbar:[
		{
			xtype:'buttongroup',
			title:'Gesti&oacute;n',
			items:[
				{
					text:'Agregar',
					iconAlign:'top',
					iconCls:'agregar_profesor32',
					scale: 'large'
				},
				{
					text:'Modificar',
					iconAlign:'top',
					iconCls:'modificar_profesor32',
					scale: 'large'
				},
				{
					text:'Eliminar',
					iconAlign:'top',
					iconCls:'eliminar_profesor32',
					scale: 'large'
				}
			]
		},
		{
			xtype:'buttongroup',
			title:'Filtro',
			items:[
				{
					text:'Buscar',
					iconAlign:'top',
					iconCls:'buscar32',
					scale: 'large'
				}
			]
		},
		{
			xtype:'buttongroup',
			title:'Ayuda',
			items:[
				{
					text:'Estoy perdido!',
					iconAlign:'top',
					iconCls:'ayuda32',
					scale: 'large'
				}
			]
		}
	],
	items:[
		{
			xtype:'form',
			title:'Datos del usuario',
			region:'center',
			collapsible:false,
			frame:true,
			fileUpload:true,
			//layout:'column',
			bodyStyle:'padding: 10px', 
			defaults:{xtype:'textfield', labelStyle: 'font-size:16px;', height:30},
			items:[
				new Ext.DataView({
					store: gestionar_profesores_datastore,
					tpl: gestionar_profesores_tpl,
					height:100,
					//columnWidth:0.5,
					multiSelect:true,
					overClass:'x-view-over',
					itemSelector:'div.thumb-wrap',
					emptyText:'No imagen'
				}),
				{
					fieldLabel: 'Login',
					id: 'ges_pro_login',
					height:30,
					//columnWidth:0.5,
					name: 'ges_pro_login',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel: 'Nombre',
					id: 'ges_pro_nombre',
					//columnWidth:0.5,
					name: 'ges_pro_nombre',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel: 'Apellidos',
					id: 'ges_pro_apellidos',
					//columnWidth:0.5,
					name: 'ges_pro_apellidos',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel: 'Identificaci&oacute;n',
					id: 'ges_pro_identificacion',
					//columnWidth:0.5,
					name: 'ges_pro_identificacion',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel: 'E-mail',
					id: 'ges_pro_e-mail',
					//columnWidth:0.5,
					name: 'ges_pro_e-mail',
					vtype: 'email'
				},
				{
					fieldLabel: 'Telefono',
					id: 'ges_pro_telefono',
					//columnWidth:0.5,
					name: 'ges_pro_telefono',
					vtype: 'phone'
				},
				ges_pro_tipo_identificacion_combo,
				{
					xtype:'fileuploadfield', 
					id:'ges_pro_url', 
					emptyText:'Seleccione una imagen de perfil', 
					fieldLabel:'Imagen de Perfil',
					name:'ges_pro_url-imagen',
					buttonText:'...',
					allowBlank:true,
					///buttonCfg: {iconCls: 'archivo'}
				},
				{
					xtype:'checkbox',
					fieldLabel:'Habilitado',
					id:'ges_pro_habilitado',
					name:'ges_pro_habilitado',
					allowBlank:false
				}
			]
		},
		{
			xtype:'panel',
			title:'bbbbbb',
			//autoHeight: true,
			region:'west',
			collapseMode:'mini',
			html:'eeeee',
			width:450
		}
	],
	renderTo:'div_form_gestionar_profesores'
});
