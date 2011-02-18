var gestionar_profesores_datastore = new Ext.data.GroupingStore({
		proxy: new Ext.data.HttpProxy({
			url: 'gestion_profesores/consultar_profesores',
			method: 'POST',
			limit: 20,
			start: 0
		}),
		baseParams:{}, 
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			},[ 
				{name:'pro_codigo_usuario'},
				{name:'pro_codigo'},
				{name:'pro_nombres'},
				{name:'pro_apellidos'},
				{name:'pro_login'},
				{name:'pro_identificacion'},
				{name:'ide_codigo'},
				{name:'ide_nombre'},
				{name:'pro_e-mail'},
				{name:'pro_telefono'},
				{name:'pro_url-image'},
				{name:'pro_habilitado'}
			]),
		sortInfo:{field: 'pro_codigo', direction: "ASC"}
	});
//gestionar_profesores_datastore.load();

var gestionar_profesor_tipo_identificacion_datastore = new Ext.data.GroupingStore({
	proxy: new Ext.data.HttpProxy({
		url: 'tipo_identificacion/consultar_tipos',
		method: 'POST'
	}),
	reader: new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total'
	},
	[ 
		{name: 'ide_codigo'},
		{name: 'ide_nombre'}
	]),
	sortInfo:{field: 'ide_nombre', direction: "ASC"}
});
//gestionar_profesor_tipo_identificacion_datastore.load();

var gestionar_profesor_tipo_identificacion_combo = new Ext.form.ComboBox({
	name: 'ide_nombre',
	fieldLabel: 'Tipo de identificaci&oacute;n',
	width: 168,
	mode: 'local',
	store: gestionar_profesor_tipo_identificacion_datastore,
	valueField: 'ide_codigo',
	displayField:'ide_nombre',
	typeAhead: true,
	triggerAction: 'all',
	allowBlank: false,
	forceSelection: true, 
	selectOnFocus: true,
	emptyText: 'seleccione uno'
});

var gestionar_profesor_datos_profesor_panel = new Ext.FormPanel({
	width:600,
	frame:true,
	layout:'column',
	items:[
		{
			xtype:'panel',
			layout:'form',
			columnWidth:0.7,
			bodyStyle:'padding: 10px',
			labelWidth:150,
			defaults:{xtype:'textfield', labelStyle: 'font-size:16px;', height:30, style:'font-size:16px;'},
			fileUpload:true,
			items:[
				{
					fieldLabel: 'Login',
					id: 'pro_login',
					height:30,
					anchor:'100%',
					name: 'pro_login',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel: 'Nombres',
					id: 'pro_nombres',
					anchor:'100%',
					name: 'pro_nombres',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel: 'Apellidos',
					id: 'pro_apellidos',
					anchor:'100%',
					name: 'pro_apellidos',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				
				{
					fieldLabel: 'E-mail',
					id: 'pro_e-mail',
					anchor:'100%',
					name: 'pro_e-mail',
					vtype: 'email'
				},
				{
					fieldLabel: 'Tel&eacute;fono',
					id: 'pro_telefono',
					anchor:'100%',
					name: 'pro_telefono',
					vtype: 'phone'
				},
				{
					fieldLabel: 'Identificaci&oacute;n',
					id: 'pro_identificacion',
					anchor:'100%',
					name: 'pro_identificacion',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				gestionar_profesor_tipo_identificacion_combo,
				{
					xtype:'fileuploadfield', 
					id:'pro_url', 
					emptyText:'Seleccione una imagen', 
					fieldLabel:'Imagen de Perfil',
					name:'pro_url-imagen',
					buttonText:'Examinar',
					allowBlank:true,
					///buttonCfg: {iconCls: 'archivo'}
				},
				{
					xtype:'checkbox',
					fieldLabel:'Habilitado',
					id:'pro_habilitado',
					name:'pro_habilitado',
					allowBlank:false
				}
			]
		},
		{	
			xtype:'fieldset',
			border:false,
			columnWidth:0.3,
			padding:10,
			items:[
				{
					xtype:'panel',
					height:170,
					width:150,
					frame:true
				}
			]
		},
	],
	buttons:[
		{
			text:'<font size=3px>Guardar</font>',
			iconCls:'',
			scale: 'large',
			handler:function(){
			}
		},
		{
			text:'<font size=3px>Cancelar</font>',
			iconCls:'',
			scale: 'large',
			handler:function(){
			}
		}
	]
});

var gestionar_profesores_window = new Ext.Window({
	title:'Datos del usuario',
	hidden:true,
	closeAction:'hide',
	items:[gestionar_profesor_datos_profesor_panel]
});

var gestionar_profesores_colmodel = new Ext.grid.ColumnModel({
	defaults:{sortable: true, locked: false, resizable: true, align:'center', /*css:'font-size:12px;'*/},
	columns:[
		{header: "<font size='3px'>Pinta</font>", width: 80, dataIndex: 'pro_url-image'},
		{header: "<font size='3px'>Codigo de usuario</font>", dataIndex: 'pro_codigo_usuario', hidden: true},
		{header: "<font size='3px'>Login</font>", width: 100, dataIndex: 'pro_login'},
		{header: "<font size='3px'>Codigo</font>", width: 100, dataIndex: 'pro_codigo'},
		{id: 'col_pro_nombres', header: "<font size='3px'>Nombres</font>", width: 200, dataIndex: 'pro_nombres'},
		{header: "<font size='3px'>Apellidos</font>", width: 200, dataIndex: 'pro_apellidos'},
		{header: "<font size='3px'>E-mail</font>", width: 200, dataIndex: 'pro_e-mail'},
		{header: "<font size='3px'>Tel&eacute;fono</font>", width: 90, dataIndex: 'pro_telefono'},
		{header: "<font size='3px'>Habilitado</font>", width: 85, dataIndex: 'pro_habilitado'},
		{header: "<font size='3px'>Identificaci&oacute;n</font>", width: 120, dataIndex: 'pro_tipo_identificacion_nombre'}
	]
});

var codigo_profesor = '';

var gestionar_profesores_gridpanel = new Ext.grid.GridPanel({
	id: 'gestionar_profesores_gridpanel',
	title:'Lista de profesores',
	//columnWidth: '.6',
	width:800,
	autoWidth:true,
	region:'center',
	collapseMode:'mini',
	stripeRows:true,
	style:'font-size:16px;',
	frame: true,
	ds: gestionar_profesores_datastore,
	cm: gestionar_profesores_colmodel,
	sm: new Ext.grid.RowSelectionModel({
		singleSelect: true,
		listeners: {
			rowselect: function(sm, row, rec) {
				/*gestion_admin_formpanel.getForm().reset();
				gestion_admin_formpanel.getForm().loadRecord(rec);
				comboTipoId.setValue(rec.data.identificacion_nombre);
				codigo_usuario = rec.get('usuario_codigo');*/
			}
		}
	}),
	autoExpandColumn: 'col_pro_nombres',
	autoExpandMin: 200,
	height: 413,
	listeners: {
		viewready: function(g) {
			g.getSelectionModel().selectRow(0);
		}
	},
	bbar: new Ext.PagingToolbar({
		pageSize: 10,
		store: gestionar_profesores_datastore,
		displayInfo: true,
		displayMsg: 'Profesores {0} - {1} de {2}',
		emptyMsg: "No hay profesores"
	}),
	view: new Ext.grid.GroupingView()
});

var gestionar_profesores_panel = new Ext.Panel({
	layout:'border',
	height:screen.height-313,
	tbar:[
		{
			xtype:'buttongroup',
			title:"<font size='3px'>Gesti&oacute;n</font>",
			items:[
				{
					text:"<font size='3px'>Agregar</font>",
					iconAlign:'top',
					iconCls:'agregar_profesor32',
					scale:'large',
					handler:function(){
						gestionar_profesores_window.show();
					}
				},
				{
					text:"<font size='3px'>Modificar</font>",
					iconAlign:'top',
					iconCls:'modificar_profesor32',
					scale: 'large'
				},
				{
					text:"<font size='3px'>Eliminar</font>",
					iconAlign:'top',
					iconCls:'eliminar_profesor32',
					scale: 'large'
				}
			]
		},
		{
			xtype:'buttongroup',
			title:"<font size='3px'>Filtro</font>",
			items:[
				{
					text:"<font size='3px'>Buscar</font>",
					iconAlign:'top',
					iconCls:'buscar32',
					scale: 'large'
				}
			]
		},
		{
			xtype:'buttongroup',
			title:"<font size='3px'>Ayuda</font>",
			items:[
				{
					text:"<font size='3px'>Estoy perdido!</font>",
					iconAlign:'top',
					iconCls:'ayuda32',
					scale: 'large'
				}
			]
		}
	],
	items:[
		gestionar_profesores_gridpanel
	],
	renderTo:'div_form_gestionar_profesores'
});


///**************** funciones ***************************///

gestionar_profesores_guardar_profesor_function = function (){
	subir_datos(
		gestionar_profesor_datos_profesor_panel,
		'gestion_profesores/guardar_profesor'
	);
}
