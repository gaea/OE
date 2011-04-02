var gestionar_profesores_datastore = new Ext.data.GroupingStore({
		proxy:new Ext.data.HttpProxy({
			url:getAbsoluteUrl('gestion_profesores', 'consultar_profesores'),
			method:'POST',
			limit:20,
			start:0
		}),
		baseParams:{campo_busqueda:'ninguno'}, 
		reader:new Ext.data.JsonReader({
			root:'results',
			totalProperty:'total'
			},[ 
				{name:'pro_codigo_usuario'},
				{name:'pro_codigo'},
				{name:'pro_nombres'},
				{name:'pro_apellidos'},
				{name:'usu_login'},
				{name:'pro_identificacion'},
				{name:'ide_codigo'},
				{name:'ide_tipo'},
				{name:'pro_e-mail'},
				{name:'pro_telefono'},
				{name:'pro_url-image'},
				{name:'pro_habilitado'}
			]),
		sortInfo:{field: 'pro_codigo', direction: "ASC"}
	});
gestionar_profesores_datastore.load();

var gestionar_profesor_tipo_identificacion_datastore = new Ext.data.GroupingStore({
	proxy: new Ext.data.HttpProxy({
		url:getAbsoluteUrl('gestion_profesores', 'consultar_tipos_identificacion'),
		method:'POST'
	}),
	reader: new Ext.data.JsonReader({
		root:'results',
		totalProperty:'total'
	},
	[ 
		{name:'ide_codigo'},
		{name:'ide_tipo'}
	]),
	sortInfo:{field: 'ide_tipo', direction: "ASC"}
});
gestionar_profesor_tipo_identificacion_datastore.load();

var gestionar_profesor_tipo_identificacion_combo = new Ext.form.ComboBox({
	name:'ide_codigo',
	fieldLabel:'Tipo de identificaci&oacute;n',
	width:168,
	mode:'local',
	store:gestionar_profesor_tipo_identificacion_datastore,
	hiddenName:'ide_codigo',
	valueField:'ide_codigo',
	displayField:'ide_tipo',
	typeAhead:true,
	triggerAction:'all',
	allowBlank:false,
	forceSelection:true, 
	selectOnFocus:true,
	emptyText:'seleccione uno'
});

var gestionar_profesor_datos_profesor_panel = new Ext.FormPanel({
	width:600,
	frame:true,
	layout:'column',
	fileUpload:true,
	items:[
		{
			xtype:'panel',
			layout:'form',
			columnWidth:0.7,
			bodyStyle:'padding: 10px',
			labelWidth:140,
			defaults:{xtype:'textfield'},
			items:[
				{
					fieldLabel:'Login',
					anchor:'100%',
					name:'usu_login',
					maskRe:/([a-zA-Z0-9\s]+)$/
				},
				{
					xtype:'textfield',
					fieldLabel:'Password',
					anchor:'100%',
					allowBlank:false,
					name:'usu_password',
					inputType:'password',
				},
				{
					fieldLabel:'Nombres',
					anchor:'100%',
					name:'pro_nombres',
					maskRe:/([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel:'Apellidos',
					anchor:'100%',
					name:'pro_apellidos',
					maskRe:/([a-zA-Z0-9\s]+)$/
				},
				
				{
					fieldLabel:'E-mail',
					anchor:'100%',
					name:'pro_e-mail',
					vtype:'email'
				},
				{
					fieldLabel:'Tel&eacute;fono',
					anchor:'100%',
					name:'pro_telefono',
					vtype:'phone'
				},
				{
					fieldLabel:'Identificaci&oacute;n',
					anchor:'100%',
					name:'pro_identificacion',
					maskRe:/([a-zA-Z0-9\s]+)$/
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
					frame:true,
					html:'<img id="pro_image_foto" width=140 heigth=160 align=center />'
				}
			]
		},
	],
	buttons:[
		{
			text:'Guardar',
			iconCls:'guardar16',
			handler:function(){
				if(codigo_profesor == ''){
					gestionar_profesores_guardar_profesor_function();
				}
				else{
					gestionar_profesores_actualizar_profesor_function();
				}
			}
		},
		{
			text:'Cancelar',
			iconCls:'cancelar16',
			handler:function(){
				gestionar_profesores_window.hide();
			}
		}
	]
});

var gestionar_profesores_window = new Ext.Window({
	title:'Datos del usuario',
	modal:true,
	closeAction:'hide',
	forceLayout:true,
	items:[gestionar_profesor_datos_profesor_panel]
});
gestionar_profesores_window.show();
gestionar_profesores_window.hide();

function poner_pinta(val, x, store){
	if(val != null){
		return '<img src="../'+val+'" width=40 heigth=60 align=center />';
	}
	else{
		return '<img src="../images/no_user_image.png" width=50 heigth=80 align=center />';
	}
}

function si_no(val, x, store){
	if(val == true){
		return "<font color=blue>Si</font>";
	}
	else{
		return "<font color=Red>No</font>";
	}
}

var gestionar_profesores_colmodel = new Ext.grid.ColumnModel({
	defaults:{sortable: true, locked: false, resizable: true, align:'center'},
	columns:[
		{header: "<b>Foto</b>", width: 80, dataIndex: 'pro_url-image', renderer:poner_pinta},
		{header: "<b>Codigo de usuario</b>", dataIndex: 'pro_codigo_usuario', hidden: true},
		{header: "<b>Login</b>", width: 100, dataIndex: 'usu_login'},
		{header: "<b>Codigo</b>", width: 100, dataIndex: 'pro_codigo'},
		{id: 'col_pro_nombres', header: "<b>Nombres</b>", width: 200, dataIndex: 'pro_nombres'},
		{header: "<b>Apellidos</b>", width: 200, dataIndex: 'pro_apellidos'},
		{header: "<b>E-mail</b>", width: 200, dataIndex: 'pro_e-mail'},
		{header: "<b>Tel&eacute;fono</b>", width: 90, dataIndex: 'pro_telefono'},
		{header: "<b>Habilitado</b>", width: 85, dataIndex: 'pro_habilitado', renderer:si_no},
		{header: "<b>Identificaci&oacute;n</b>", width: 120, dataIndex: 'pro_identificacion'}
	]
});

var codigo_profesor = '';

var gestionar_profesores_gridpanel = new Ext.grid.GridPanel({
	id:'gestionar_profesores_gridpanel',
	title:'Lista de profesores',
	columnLines:true,
	width:800,
	autoWidth:true,
	region:'center',
	collapseMode:'mini',
	stripeRows:true,
	monitorResize:true,
	frame:true,
	ds:gestionar_profesores_datastore,
	cm:gestionar_profesores_colmodel,
	sm:new Ext.grid.RowSelectionModel({
		singleSelect:true,
		listeners:{
			rowselect: function(sm, row, rec) {
				gestionar_profesor_datos_profesor_panel.getForm().reset();
				gestionar_profesor_datos_profesor_panel.getForm().loadRecord(rec);
				
				codigo_profesor = rec.get('pro_codigo');
				
				if(rec.get('pro_url-image') != null){
					Ext.get('pro_image_foto').dom.src = urlPrefix +'../'+rec.get('pro_url-image');
				}
				else{
					Ext.get('pro_image_foto').dom.src = urlPrefix +'../images/no_user_image.png';
				}
			}
		}
	}),
	autoExpandColumn:'col_pro_nombres',
	autoExpandMin:200,
	autoHeight:true,
	listeners:{
		viewready:function(g) {
			g.getSelectionModel().selectRow(0);
		}
	},
	bbar:new Ext.PagingToolbar({
		pageSize:20,
		store:gestionar_profesores_datastore,
		displayInfo:true,
		displayMsg:'Profesores {0} - {1} de {2}',
		emptyMsg:"No hay profesores"
	}),
	view: new Ext.grid.GroupingView()
});

var gestionar_profesores_panel = new Ext.Panel({
	id:'gestionar_profesores_panel',
	layout:'border',
	height:window.innerHeight-112,
	monitorResize: true,
	tbar:[
		{
			xtype:'buttongroup',
			title:"Gesti&oacute;n",
			items:[
				{
					text:"Agregar",
					iconAlign:'top',
					iconCls:'agregar_profesor24',
					scale:'medium',
					handler:function(){
						codigo_profesor = '';
						gestionar_profesor_datos_profesor_panel.getForm().reset();
						Ext.get('pro_image_foto').dom.src = urlPrefix +'../images/no_user_image.png';
						gestionar_profesores_window.show();
						gestionar_profesores_gridpanel.getSelectionModel().clearSelections();
					}
				},
				{
					text:"Modificar",
					iconAlign:'top',
					iconCls:'modificar_profesor24',
					scale:'medium',
					handler:function(){
						if(codigo_profesor != ''){
							gestionar_profesores_window.show();
						}
						else{
							mostrar_mensaje_rapido('Alerta', 'Por favor seleccione un profesor');
						}
					}
				},
				{
					text:"Habilitar",
					iconAlign:'top',
					iconCls:'habilitar_profesor24',
					scale:'medium',
					handler:function(){
						if(codigo_profesor != ''){
							gestionar_profesores_habilitar_profesor_function();
						}
						else{
							mostrar_mensaje_rapido('Alerta', 'Por favor seleccione un profesor');
						}
					}
				},
				{
					text:"Desabilitar",
					iconAlign:'top',
					iconCls:'desabilitar_profesor24',
					scale:'medium',
					handler:function(){
						if(codigo_profesor != ''){
							gestionar_profesores_desabilitar_profesor_function();
						}
						else{
							mostrar_mensaje_rapido('Alerta', 'Por favor seleccione un profesor');
						}
					}
				}
			]
		},
		{
			xtype:'buttongroup',
			title:"Filtro",
			items:[
				{
					xtype:'splitbutton',
					text:"Buscar",
					iconAlign:'top',
					iconCls:'buscar24',
					scale:'medium',
					colspan:1,
					menu:[
						{xtype: 'textfield', iconCls: 'texto_buscar', id: 'busqueda_profesor', emptyText: 'buscar'},
						{
							text:'Buscar por login', 
							iconCls:'buscar_por', 
							handler:function(){ 
								gestionar_profesores_datastore.load({
									params: {busqueda:Ext.getCmp('busqueda_profesor').getValue(), campo:'login', start: 0, limit: 20}
								});
							}
						},
						{
							text:'Buscar por nombre', 
							iconCls:'buscar_por', 
							handler:function(){ 
								gestionar_profesores_datastore.load({
									params: {busqueda:Ext.getCmp('busqueda_profesor').getValue(), campo:'nombres', start: 0, limit: 20}
								});
							}
						},
						{
							text:'Buscar por todos los campos', 
							iconCls:'buscar_por', 
							handler:function(){ 
								gestionar_profesores_datastore.load({
									params: {busqueda:Ext.getCmp('busqueda_profesor').getValue(), campo:'todos', start: 0, limit: 20}
								});
							}
						}
					]
				}
			]
		},
		{
			xtype:'buttongroup',
			title:"CSV",
			items:[
				{
					text:"Importar",
					iconAlign:'top',
					iconCls:'importar24',
					scale:'medium',
					handler:function(){ 
						gestionar_profesores_importar_window.show();
					}
				},
				{
					text:"Exportar",
					iconAlign:'top',
					iconCls:'exportar24',
					scale: 'medium',
					handler:function(){
						window.open(getAbsoluteUrl('gestion_profesores', 'exportar_profesor'),"csv");
					}
				},
			]
		},
		{
			xtype:'buttongroup',
			title:"Ayuda",
			items:[
				{
					text:"Estoy perdido!",
					iconAlign:'top',
					iconCls:'ayuda24',
					scale:'medium'
				}
			]
		}
	],
	items:[
		gestionar_profesores_gridpanel
	],
	renderTo:'div_form_gestionar_profesores'
});

Ext.get('pro_image_foto').dom.src = urlPrefix +'../images/no_user_image.png';

var gestionar_profesor_importar_panel = new Ext.FormPanel({
	width:400,
	frame:true,
	fileUpload:true,
	labelWidth:140,
	defaults:{xtype:'textfield'},
	items:[
		{
			xtype:'label',
			html:'<b>Las columnas deben seguir el siguiente orden:</b><br><br><center>login;password;nombres;apellidos;e-mail</center><br><br>',
			height:30
		},
		{
			xtype:'fileuploadfield', 
			id:'pro_importar_file', 
			emptyText:'Seleccione un archivo', 
			fieldLabel:'Importar datos en CSV',
			name:'pro_importar',
			buttonText:'Examinar',
			allowBlank:true
		}
	],
	buttons:[
		{
			text:'Subir',
			iconCls:'guardar16',
			handler:function(){
				gestionar_profesores_importar_profesor_function();
			}
		},
		{
			text:'Cancelar',
			iconCls:'cancelar16',
			handler:function(){
				gestionar_profesores_importar_window.hide();
			}
		}
	]
});

var gestionar_profesores_importar_window = new Ext.Window({
	title:'Importacion de archivos CSV',
	modal:true,
	closeAction:'hide',
	forceLayout:true,
	items:[gestionar_profesor_importar_panel]
});
gestionar_profesores_importar_window.show();
gestionar_profesores_importar_window.hide();

///**************** funciones ***************************///

gestionar_profesores_importar_profesor_function = function(){
	subir_datos(
		gestionar_profesor_importar_panel,
		getAbsoluteUrl('gestion_profesores', 'importar_profesor'),
		[],
		function(){
			gestionar_profesores_datastore.reload();
			gestionar_profesor_importar_panel.getForm().reset();
			gestionar_profesores_importar_window.hide();
		},
		function(){}
	);
}

gestionar_profesores_exportar_profesor_function = function(){
	subirDatosAjax(
		getAbsoluteUrl('gestion_profesores', 'exportar_profesor'),
		[],
		function(){},
		function(){}
	);
}

gestionar_profesores_guardar_profesor_function = function(){
	subir_datos(
		gestionar_profesor_datos_profesor_panel,
		getAbsoluteUrl('gestion_profesores', 'guardar_profesor'),
		[],
		function(){gestionar_profesores_datastore.reload();},
		function(){}
	);
}

gestionar_profesores_actualizar_profesor_function = function(){
	subir_datos(
		gestionar_profesor_datos_profesor_panel,
		getAbsoluteUrl('gestion_profesores', 'actualizar_profesor'),
		{codigo_profesor: codigo_profesor},
		function(){gestionar_profesores_datastore.reload();},
		function(){}
	);
}

gestionar_profesores_habilitar_profesor_function = function(){
	subirDatosAjax(
		getAbsoluteUrl('gestion_profesores', 'habilitar_profesor'),
		{codigo_profesor: codigo_profesor},
		function(){gestionar_profesores_datastore.reload();},
		function(){}
	);
}

gestionar_profesores_desabilitar_profesor_function = function(){
	subirDatosAjax(
		getAbsoluteUrl('gestion_profesores', 'desabilitar_profesor'),
		{codigo_profesor: codigo_profesor},
		function(){gestionar_profesores_datastore.reload();},
		function(){}
	);
}
