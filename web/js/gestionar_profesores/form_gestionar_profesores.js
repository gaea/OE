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

var detalle_datos_profesor_panel = new Ext.Panel({
	xtype:'panel',
	title:'Datos del usuario',
	region:'center',
	//collapsible:false,
	//width:500,
	frame:true,
	layout:'column',
	items:[
		{
			xtype:'form',
			columnWidth:0.7,
			bodyStyle:'padding: 10px',
			labelWidth:150,
			defaults:{xtype:'textfield', labelStyle: 'font-size:16px;', height:30, style:'font-size:16px;'},
			fileUpload:true,
			items:[
				{
					fieldLabel: 'Login',
					id: 'ges_pro_login',
					height:30,
					anchor:'100%',
					name: 'ges_pro_login',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel: 'Nombres',
					id: 'ges_pro_nombres',
					anchor:'100%',
					name: 'ges_pro_nombres',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel: 'Apellidos',
					id: 'ges_pro_apellidos',
					anchor:'100%',
					name: 'ges_pro_apellidos',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				
				{
					fieldLabel: 'E-mail',
					id: 'ges_pro_e-mail',
					anchor:'100%',
					name: 'ges_pro_e-mail',
					vtype: 'email'
				},
				{
					fieldLabel: 'Telefono',
					id: 'ges_pro_telefono',
					anchor:'100%',
					name: 'ges_pro_telefono',
					vtype: 'phone'
				},
				{
					fieldLabel: 'Identificaci&oacute;n',
					id: 'ges_pro_identificacion',
					anchor:'100%',
					name: 'ges_pro_identificacion',
					maskRe: /([a-zA-Z0-9\s]+)$/
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
			xtype:'fieldset',
			border:false,
			columnWidth:0.3,
			padding:10,
			items:[
				{
					xtype:'panel',
					height:150,
					width:150,
					frame:true
				}
			]
		},
	]
});

var gestionar_profesores_colmodel = new Ext.grid.ColumnModel({
	defaults:{sortable: true, locked: false, resizable: true, align:'center', /*css:'font-size:12px;'*/},
	columns:[
		{id: 'ges_pro_url-image', header: "<font size='3px'>Pinta</font>", width: 80, dataIndex: 'ges_pro_url-image'},
		{id: 'ges_pro_codigo_usuario', header: "<font size='3px'>Codigo de usuario</font>", dataIndex: 'ges_pro_codigo_usuario', hidden: true},
		{id: 'ges_pro_login', header: "<font size='3px'>Login</font>", width: 100, dataIndex: 'ges_pro_login'},
		{id: 'ges_pro_codigo', header: "<font size='3px'>Codigo</font>", width: 100, dataIndex: 'ges_pro_codigo'},
		{id: 'ges_pro_nombres', header: "<font size='3px'>Nombres</font>", width: 200, dataIndex: 'ges_pro_nombres'},
		{id: 'ges_pro_apellidos', header: "<font size='3px'>Apellidos</font>", width: 200, dataIndex: 'ges_pro_apellidos'},
		{id: 'ges_pro_e-mail', header: "<font size='3px'>E-mail</font>", width: 200, dataIndex: 'ges_pro_e-mail'},
		{id: 'ges_pro_telefono', header: "<font size='3px'>Telefono</font>", width: 90, dataIndex: 'ges_pro_telefono'},
		{id: 'ges_pro_habilitado', header: "<font size='3px'>Habilitado</font>", width: 85, dataIndex: 'ges_pro_habilitado'},
		{id: 'ges_pro_tipo_identificacion_nombre', header: "<font size='3px'>Identificacion</font>", width: 120, dataIndex: 'ges_pro_tipo_identificacion_nombre'}
	]
});

var codigo_profesor = '';

var gestionar_profesores_gridpanel = new Ext.grid.GridPanel({
	id: 'gestionar_profesores_gridpanel',
	title:'Lista de profesores',
	//columnWidth: '.6',
	width:800,
	autoWidth:true,
	region:'west',
	collapseMode:'mini',
	stripeRows:true,
	style:'font-size:16px;',
	//style: {"margin-left": "10px"},
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
	//autoExpandColumn: 'grid_persona_nombre',
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

var form_gestionar_profesores = new Ext.Panel({
	layout:'border',
	height:screen.height-313,
	defaults: {
		collapsible:true,
		split:true
		//bodyStyle:'padding:15px'
	},
	tbar:[
		{
			xtype:'buttongroup',
			title:"<font size='3px'>Gesti&oacute;n</font>",
			items:[
				{
					text:"<font size='3px'>Agregar</font>",
					iconAlign:'top',
					iconCls:'agregar_profesor32',
					scale: 'large'
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
		detalle_datos_profesor_panel,
		gestionar_profesores_gridpanel
	],
	renderTo:'div_form_gestionar_profesores'
});
