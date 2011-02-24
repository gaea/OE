var gestionar_estudiantes_datastore = new Ext.data.GroupingStore({
		proxy: new Ext.data.HttpProxy({
			url: getAbsoluteUrl('gestion_estudiantes', 'consultar_estudiantes'),
			method: 'POST',
			limit: 20,
			start: 0
		}),
		baseParams:{}, 
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			},[ 
				{name:'est_codigo_usuario'},
				{name:'est_codigo'},
				{name:'est_nombres'},
				{name:'est_apellidos'},
				{name:'usu_login'},
				{name:'est_identificacion'},
				{name:'ide_codigo'},
				{name:'ide_tipo'},
				{name:'est_e-mail'},
				{name:'est_telefono'},
				{name:'est_url-image'},
				{name:'est_habilitado'}
			]),
		sortInfo:{field: 'est_codigo', direction: "ASC"}
	});
gestionar_estudiantes_datastore.load();

var gestionar_estudiante_tipo_identificacion_datastore = new Ext.data.GroupingStore({
	proxy: new Ext.data.HttpProxy({
		url: getAbsoluteUrl('gestion_estudiantes', 'consultar_tipos_identificacion'),
		method: 'POST'
	}),
	reader: new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total'
	},
	[ 
		{name: 'ide_codigo'},
		{name: 'ide_tipo'}
	]),
	sortInfo:{field: 'ide_tipo', direction: "ASC"}
});
gestionar_estudiante_tipo_identificacion_datastore.load();

var gestionar_estudiantes_tipo_identificacion_combo = new Ext.form.ComboBox({
	name: 'ide_codigo',
	fieldLabel: 'Tipo de identificaci&oacute;n',
	width: 168,
	mode: 'local',
	store: gestionar_estudiante_tipo_identificacion_datastore,
	hiddenName:'ide_codigo',
	valueField: 'ide_codigo',
	displayField:'ide_tipo',
	typeAhead: true,
	triggerAction: 'all',
	allowBlank: false,
	forceSelection: true, 
	selectOnFocus: true,
	emptyText: 'seleccione uno'
});

var gestionar_estudiantes_datos_estudiante_panel = new Ext.FormPanel({
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
			labelWidth:150,
			defaults:{xtype:'textfield', labelStyle: 'font-size:16px;', height:30, style:'font-size:16px;'},
			items:[
				{
					fieldLabel: 'Login',
					height:30,
					anchor:'100%',
					name: 'usu_login',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					xtype:'textfield',
					fieldLabel: 'Password',
					anchor: '100%',
					allowBlank: false,
					name: 'usu_password',
					inputType: 'password',
				},
				{
					fieldLabel: 'Nombres',
					anchor:'100%',
					name: 'est_nombres',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel: 'Apellidos',
					anchor:'100%',
					name: 'est_apellidos',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				
				{
					fieldLabel: 'E-mail',
					anchor:'100%',
					name: 'est_e-mail',
					vtype: 'email'
				},
				{
					fieldLabel: 'Tel&eacute;fono',
					anchor:'100%',
					name: 'est_telefono',
					invalidText: 'dff',
					vtype: 'phone'
				},
				{
					fieldLabel: 'Identificaci&oacute;n',
					anchor:'100%',
					name: 'est_identificacion',
					maskRe: /([a-zA-Z0-9\s]+)$/
				},
				gestionar_estudiantes_tipo_identificacion_combo,
				{
					xtype:'fileuploadfield', 
					id:'est_url', 
					emptyText:'Seleccione una imagen', 
					fieldLabel:'Imagen de Perfil',
					name:'est_url-imagen',
					buttonText:'Examinar',
					allowBlank:true,
					///buttonCfg: {iconCls: 'archivo'}
				}/*,
				{
					xtype:'checkbox',
					fieldLabel:'Habilitado',
					id:'est_habilitado',
					name:'est_habilitado',
					inputValue:'true',
					allowBlank:false
				}*/
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
					//bodyStyle:'text-align:center;margin-left:auto;',
					html: '<img id="est_image_foto" width=140 heigth=160 align=center />'
				}
			]
		},
	],
	buttons:[
		{
			text:'<font size=3px>Guardar</font>',
			iconCls:'guardar32',
			scale: 'large',
			handler:function(){
				if(codigo_estudiante == ''){
					gestionar_estudiantes_guardar_estudiante_function();
				}
				else{
					gestionar_estudiantes_actualizar_estudiante_function();
				}
			}
		},
		{
			text:'<font size=3px>Cancelar</font>',
			iconCls:'cancelar32',
			scale: 'large',
			handler:function(){
				gestionar_estudiantes_window.hide();
			}
		}
	]
});

var gestionar_estudiantes_window = new Ext.Window({
	title:'Datos del usuario',
	modal:true,
	closeAction:'hide',
	forceLayout:true,
	items:[gestionar_estudiantes_datos_estudiante_panel]
});
gestionar_estudiantes_window.show();
gestionar_estudiantes_window.hide();

function aumentar_tamano_letra_3px(val, x, store){
	return "<font size='3px'>"+val+"</font>";
}

function poner_pinta(val, x, store){
	if(val != null){
		return '<img src="../'+val+'" width=50 heigth=80 align=center />';
	}
	else{
		return '<img src="../images/no_estudiante_image.png" width=50 heigth=80 align=center />';
	}
}

function si_no(val, x, store){
	if(val == true){
		return "<font size='3px' color=blue>Si</font>";
	}
	else{
		return "<font size='3px' color=Red>No</font>";
	}
}

var gestionar_estudiantes_colmodel = new Ext.grid.ColumnModel({
	defaults:{sortable: true, locked: false, resizable: true, align:'center', renderer:aumentar_tamano_letra_3px, css:'height:32px;'},
	columns:[
		{header: "<font size='3px'>Pinta</font>", width: 80, dataIndex: 'est_url-image', renderer:poner_pinta},
		{header: "<font size='3px'>Codigo de usuario</font>", dataIndex: 'est_codigo_usuario', hidden: true},
		{header: "<font size='3px'>Login</font>", width: 100, dataIndex: 'usu_login'},
		{header: "<font size='3px'>Codigo</font>", width: 100, dataIndex: 'est_codigo'},
		{id: 'col_est_nombres', header: "<font size='3px'>Nombres</font>", width: 200, dataIndex: 'est_nombres'},
		{header: "<font size='3px'>Apellidos</font>", width: 200, dataIndex: 'est_apellidos'},
		{header: "<font size='3px'>E-mail</font>", width: 200, dataIndex: 'est_e-mail'},
		{header: "<font size='3px'>Tel&eacute;fono</font>", width: 90, dataIndex: 'est_telefono'},
		{header: "<font size='3px'>Habilitado</font>", width: 85, dataIndex: 'est_habilitado', renderer:si_no},
		{header: "<font size='3px'>Identificaci&oacute;n</font>", width: 120, dataIndex: 'est_identificacion'}
	]
});

var codigo_estudiante = '';

var gestionar_estudiantes_gridpanel = new Ext.grid.GridPanel({
	id: 'gestionar_estudiantes_gridpanel',
	title:'Lista de estudiantes',
	columnLines:true,
	width:800,
	autoWidth:true,
	region:'center',
	collapseMode:'mini',
	stripeRows:true,
	monitorResize: true,
	//bodyStyle:'font-size:16px;',
	frame: true,
	ds: gestionar_estudiantes_datastore,
	cm: gestionar_estudiantes_colmodel,
	sm: new Ext.grid.RowSelectionModel({
		singleSelect: true,
		listeners: {
			rowselect: function(sm, row, rec) {
				gestionar_estudiante_datos_estudiantes_panel.getForm().reset();
				gestionar_estudiante_datos_estudiantes_panel.getForm().loadRecord(rec);
				
				codigo_estudiante = rec.get('est_codigo');
				
				if(rec.get('est_url-image') != null){
					Ext.get('est_image_foto').dom.src = urlPrefix +'../'+rec.get('est_url-image');
				}
				else{
					Ext.get('est_image_foto').dom.src = urlPrefix +'../images/no_estudiante_image.png';
				}
				
				//comboTipoId.setValue(rec.data.identificacion_nombre);
				//codigo_usuario = rec.get('usuario_codigo');*/
			}
		}
	}),
	autoExpandColumn:'col_est_nombres',
	autoExpandMin:200,
	autoHeight:true,
	listeners:{
		viewready: function(g) {
			g.getSelectionModel().selectRow(0);
		}
	},
	bbar: new Ext.PagingToolbar({
		pageSize:10,
		store:gestionar_estudiantes_datastore,
		displayInfo:true,
		displayMsg:'estudiantes {0} - {1} de {2}',
		emptyMsg:"No hay estudiantes"
	}),
	view: new Ext.grid.GroupingView()
});

var gestionar_estudiantes_panel = new Ext.Panel({
	id:'gestionar_estudiantes_panel',
	layout:'border',
	height:window.innerHeight-112,
	monitorResize: true,
	tbar:[
		{
			xtype:'buttongroup',
			title:"<font size='3px'>Gesti&oacute;n</font>",
			items:[
				{
					text:"<font size='3px'>Agregar</font>",
					iconAlign:'top',
					iconCls:'agregar_estudiante32',
					scale:'large',
					handler:function(){
						codigo_estudiante = '';
						gestionar_estudiantes_datos_estudiante_panel.getForm().reset();
						Ext.get('est_image_foto').dom.src = urlPrefix +'../images/no_estudiante_image.png';
						gestionar_estudiantes_window.show();
						gestionar_estudiantes_gridpanel.getSelectionModel().clearSelections();
					}
				},
				{
					text:"<font size='3px'>Modificar</font>",
					iconAlign:'top',
					iconCls:'modificar_estudiante32',
					scale:'large',
					handler:function(){
						if(codigo_estudiante != ''){
							gestionar_estudiantes_window.show();
						}
						else{
							mostrar_mensaje_rapido('Alerta', 'Por favor seleccione un estudiante');
						}
					}
				},
				{
					text:"<font size='3px'>Habilitar</font>",
					iconAlign:'top',
					iconCls:'habilitar_estudiante32',
					scale:'large',
					handler:function(){
						if(codigo_estudiante != ''){
							gestionar_estudiantes_habilitar_estudiante_function();
						}
						else{
							mostrar_mensaje_rapido('Alerta', 'Por favor seleccione un estudiante');
						}
					}
				},
				{
					text:"<font size='3px'>Desabilitar</font>",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante32',
					scale:'large',
					handler:function(){
						if(codigo_estudiante != ''){
							gestionar_estudiantes_desabilitar_estudiante_function();
						}
						else{
							mostrar_mensaje_rapido('Alerta', 'Por favor seleccione un estudiante');
						}
					}
				}
			]
		},
		{
			xtype:'buttongroup',
			title:"<font size='3px'>Filtro</font>",
			items:[
				{
					xtype:'splitbutton',
					text:"<font size='3px'>Buscar</font>",
					iconAlign:'top',
					iconCls:'buscar32',
					scale:'large',
					colspan:1,
					menu:[
						{xtype: 'textfield', iconCls: 'buscar', id: 'busqueda_estudiante', emptyText: 'buscar'},
						{
							text:'Buscar por login', 
							iconCls:'buscar_por', 
							handler:function(){ 
								gestionar_estudiantes_datastore.load({
									params: {busqueda:Ext.getCmp('busqueda_estudiante').getValue(), campo:'login', start: 0, limit: 20}
								});
							}
						},
						{
							text:'Buscar por nombre', 
							iconCls:'buscar_por', 
							handler:function(){ 
								gestionar_estudiantes_datastore.load({
									params: {busqueda:Ext.getCmp('busqueda_estudiante').getValue(), campo:'nombres', start: 0, limit: 20}
								});
							}
						},
						{
							text:'Buscar por todos los campos', 
							iconCls:'buscar_por', 
							handler:function(){ 
								gestionar_estudiantes_datastore.load({
									params: {busqueda:Ext.getCmp('busqueda_estudiante').getValue(), campo:'todos', start: 0, limit: 20}
								});
							}
						}
					]
				}
			]
		},
		{
			xtype:'buttongroup',
			title:"<font size='3px'>CSV</font>",
			items:[
				{
					text:"<font size='3px'>Importar</font>",
					iconAlign:'top',
					iconCls:'importar32',
					scale: 'large',
					handler:function(){ 
						gestionar_estudiantes_importar_window.show();
					}
				},
				{
					text:"<font size='3px'>Exportar</font>",
					iconAlign:'top',
					iconCls:'exportar32',
					scale: 'large',
					handler:function(){ 
						//gestionar_estudiantes_exportar_estudiante_function();
						window.open (getAbsoluteUrl('gestion_estudiantes', 'exportar_estudiante'),"csv");
					}
				},
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
		gestionar_estudiantes_gridpanel
	],
	/*listeners :{
		bodyresize:function(p,w,h){
		//heightCentro=(agPrinCentro.getSize().height)-68;
		alert(6);
		
		//this.doLayout();
		}
	},*/
	renderTo:'div_form_gestionar_estudiantes'
});

Ext.get('est_image_foto').dom.src = urlPrefix +'../images/no_estudiante_image.png';

var gestionar_estudiantes_importar_panel = new Ext.FormPanel({
	width:500,
	frame:true,
	fileUpload:true,
	labelWidth:180,
	defaults:{xtype:'textfield', labelStyle: 'font-size:14px;', height:30, style:'font-size:14px;'},
	items:[
		{
			xtype:'label',
			html:'<b>Las columnas deben seguir el siguiente orden:</b><br><br><center>login;password;nombres;apellidos;e-mail</center><br><br>',
			height:30,
			anchor:'100%'
		},
		{
			xtype:'fileuploadfield', 
			id:'est_importar_file', 
			emptyText:'Seleccione un archivo', 
			fieldLabel:'Importar datos en CSV',
			name:'est_importar',
			buttonText:'Examinar',
			allowBlank:true
		}
	],
	buttons:[
		{
			text:'<font size=3px>Subir</font>',
			iconCls:'guardar32',
			scale: 'large',
			handler:function(){
				gestionar_estudiantes_importar_estudiante_function();
			}
		},
		{
			text:'<font size=3px>Cancelar</font>',
			iconCls:'cancelar32',
			scale: 'large',
			handler:function(){
				gestionar_estudiantes_importar_window.hide();
			}
		}
	]
});

var gestionar_estudiantes_importar_window = new Ext.Window({
	title:'Importacion de archivos CSV',
	modal:true,
	closeAction:'hide',
	forceLayout:true,
	items:[gestionar_estudiantes_importar_panel]
});
gestionar_estudiantes_importar_window.show();
gestionar_estudiantes_importar_window.hide();

///**************** funciones ***************************///

gestionar_estudiantes_importar_estudiante_function = function(){
	subir_datos(
		gestionar_estudiantes_importar_panel,
		getAbsoluteUrl('gestion_estudiantes', 'importar_estudiante'),
		[],
		function(){
			gestionar_estudiantes_datastore.reload();
			gestionar_estudiantes_importar_panel.getForm().reset();
			gestionar_estudiantes_importar_window.hide();
		},
		function(){}
	);
}

gestionar_estudiantes_exportar_estudiante_function = function(){
	subirDatosAjax(
		getAbsoluteUrl('gestion_estudiantes', 'exportar_estudiante'),
		[],
		function(){},
		function(){}
	);
}

gestionar_estudiantes_guardar_estudiante_function = function(){
	subir_datos(
		gestionar_estudiante_datos_estudiante_panel,
		getAbsoluteUrl('gestion_estudiantes', 'guardar_estudiante'),
		[],
		function(){gestionar_estudiantes_datastore.reload();},
		function(){}
	);
}

gestionar_estudiantes_actualizar_estudiante_function = function(){
	subir_datos(
		gestionar_estudiante_datos_estudiante_panel,
		getAbsoluteUrl('gestion_estudiantes', 'actualizar_estudiante'),
		{codigo_estudiante: codigo_estudiante},
		function(){gestionar_estudiantes_datastore.reload();},
		function(){}
	);
}

gestionar_estudiantes_habilitar_estudiante_function = function(){
	subirDatosAjax(
		getAbsoluteUrl('gestion_estudiantes', 'habilitar_estudiante'),
		{codigo_estudiante: codigo_estudiante},
		function(){gestionar_estudiantes_datastore.reload();},
		function(){}
	);
}

gestionar_estudiantes_desabilitar_estudiante_function = function(){
	subirDatosAjax(
		getAbsoluteUrl('gestion_estudiantes', 'desabilitar_estudiante'),
		{codigo_estudiante: codigo_estudiante},
		function(){gestionar_estudiantes_datastore.reload();},
		function(){}
	);
}
