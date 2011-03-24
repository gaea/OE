var gestionar_cursos_datastore = new Ext.data.GroupingStore({
		proxy:new Ext.data.HttpProxy({
			url:getAbsoluteUrl('gestion_cursos', 'consultar_cursos'),
			method:'POST',
			limit:20,
			start:0
		}),
		baseParams:{}, 
		reader:new Ext.data.JsonReader({
			root:'results',
			totalProperty:'total'
			},[ 
				{name:'cur_codigo'},
				{name:'cur_codigo_profesor'},
				{name:'cur_nombre_profesor'},
				{name:'cur_nombre'},
				{name:'cur_fecha_creacion'},
				{name:'cur_habilitado'}
			]),
		sortInfo:{field: 'cur_codigo', direction: "ASC"}
	});
gestionar_cursos_datastore.load();

var gestionar_curso_datos_curso_panel = new Ext.FormPanel({
	width:600,
	frame:true,
	layout:'column',
	items:[
		{
			xtype:'panel',
			layout:'form',
			columnWidth:1,
			bodyStyle:'padding: 10px',
			labelWidth:140,
			defaults:{xtype:'textfield'},
			items:[
				{
					fieldLabel:'Codigo',
					readOnly:true,
					anchor:'100%',
					name:'cur_codigo',
					maskRe:/([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel:'Nombre',
					anchor:'100%',
					allowBlank:false,
					name:'cur_nombre',
					maskRe:/([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel:'Profesor',
					anchor:'100%',
					name:'cur_nombre_profesor',
					maskRe:/([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel:'Fecha de creaci&oacute;n',
					anchor:'100%',
					name:'cur_fecha_creacion',
					maskRe:/([a-zA-Z0-9\s]+)$/
				}
			]
		}
	],
	buttons:[
		{
			text:'Guardar',
			iconCls:'guardar16',
			handler:function(){
				if(codigo_curso == ''){
					gestionar_cursos_guardar_curso_function();
				}
				else{
					gestionar_cursos_actualizar_curso_function();
				}
			}
		},
		{
			text:'Cancelar',
			iconCls:'cancelar16',
			handler:function(){
				gestionar_cursos_window.hide();
			}
		}
	]
});

var gestionar_cursos_window = new Ext.Window({
	title:'Datos del curso',
	modal:true,
	closeAction:'hide',
	forceLayout:true,
	items:[gestionar_curso_datos_curso_panel]
});
gestionar_cursos_window.show();
gestionar_cursos_window.hide();

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

var gestionar_cursos_colmodel = new Ext.grid.ColumnModel({
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

var codigo_curso = '';

var gestionar_cursos_gridpanel = new Ext.grid.GridPanel({
	id:'gestionar_cursos_gridpanel',
	title:'Lista de cursos',
	columnLines:true,
	width:800,
	autoWidth:true,
	region:'center',
	collapseMode:'mini',
	stripeRows:true,
	monitorResize:true,
	frame:true,
	ds:gestionar_cursos_datastore,
	cm:gestionar_cursos_colmodel,
	sm:new Ext.grid.RowSelectionModel({
		singleSelect:true,
		listeners:{
			rowselect: function(sm, row, rec) {
				gestionar_curso_datos_curso_panel.getForm().reset();
				gestionar_curso_datos_curso_panel.getForm().loadRecord(rec);
				
				codigo_curso = rec.get('pro_codigo');
				
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
		pageSize:10,
		store:gestionar_cursos_datastore,
		displayInfo:true,
		displayMsg:'cursos {0} - {1} de {2}',
		emptyMsg:"No hay cursos"
	}),
	view: new Ext.grid.GroupingView()
});

var gestionar_cursos_panel = new Ext.Panel({
	id:'gestionar_cursos_panel',
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
					iconCls:'agregar_curso24',
					scale:'medium',
					handler:function(){
						codigo_curso = '';
						gestionar_curso_datos_curso_panel.getForm().reset();
						Ext.get('pro_image_foto').dom.src = urlPrefix +'../images/no_user_image.png';
						gestionar_cursos_window.show();
						gestionar_cursos_gridpanel.getSelectionModel().clearSelections();
					}
				},
				{
					text:"Modificar",
					iconAlign:'top',
					iconCls:'modificar_curso24',
					scale:'medium',
					handler:function(){
						if(codigo_curso != ''){
							gestionar_cursos_window.show();
						}
						else{
							mostrar_mensaje_rapido('Alerta', 'Por favor seleccione un curso');
						}
					}
				},
				{
					text:"Habilitar",
					iconAlign:'top',
					iconCls:'habilitar_curso24',
					scale:'medium',
					handler:function(){
						if(codigo_curso != ''){
							gestionar_cursos_habilitar_curso_function();
						}
						else{
							mostrar_mensaje_rapido('Alerta', 'Por favor seleccione un curso');
						}
					}
				},
				{
					text:"Desabilitar",
					iconAlign:'top',
					iconCls:'desabilitar_curso24',
					scale:'medium',
					handler:function(){
						if(codigo_curso != ''){
							gestionar_cursos_desabilitar_curso_function();
						}
						else{
							mostrar_mensaje_rapido('Alerta', 'Por favor seleccione un curso');
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
						{xtype: 'textfield', iconCls: 'texto_buscar', id: 'busqueda_curso', emptyText: 'buscar'},
						{
							text:'Buscar por login', 
							iconCls:'buscar_por', 
							handler:function(){ 
								gestionar_cursos_datastore.load({
									params: {busqueda:Ext.getCmp('busqueda_curso').getValue(), campo:'login', start: 0, limit: 20}
								});
							}
						},
						{
							text:'Buscar por nombre', 
							iconCls:'buscar_por', 
							handler:function(){ 
								gestionar_cursos_datastore.load({
									params: {busqueda:Ext.getCmp('busqueda_curso').getValue(), campo:'nombres', start: 0, limit: 20}
								});
							}
						},
						{
							text:'Buscar por todos los campos', 
							iconCls:'buscar_por', 
							handler:function(){ 
								gestionar_cursos_datastore.load({
									params: {busqueda:Ext.getCmp('busqueda_curso').getValue(), campo:'todos', start: 0, limit: 20}
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
						gestionar_cursos_importar_window.show();
					}
				},
				{
					text:"Exportar",
					iconAlign:'top',
					iconCls:'exportar24',
					scale: 'medium',
					handler:function(){
						window.open(getAbsoluteUrl('gestion_cursos', 'exportar_curso'),"csv");
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
		gestionar_cursos_gridpanel
	],
	renderTo:'div_form_gestionar_cursos'
});

Ext.get('pro_image_foto').dom.src = urlPrefix +'../images/no_user_image.png';

var gestionar_curso_importar_panel = new Ext.FormPanel({
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
				gestionar_cursos_importar_curso_function();
			}
		},
		{
			text:'Cancelar',
			iconCls:'cancelar16',
			handler:function(){
				gestionar_cursos_importar_window.hide();
			}
		}
	]
});

var gestionar_cursos_importar_window = new Ext.Window({
	title:'Importacion de archivos CSV',
	modal:true,
	closeAction:'hide',
	forceLayout:true,
	items:[gestionar_curso_importar_panel]
});
gestionar_cursos_importar_window.show();
gestionar_cursos_importar_window.hide();

///**************** funciones ***************************///

gestionar_cursos_importar_curso_function = function(){
	subir_datos(
		gestionar_curso_importar_panel,
		getAbsoluteUrl('gestion_cursos', 'importar_curso'),
		[],
		function(){
			gestionar_cursos_datastore.reload();
			gestionar_curso_importar_panel.getForm().reset();
			gestionar_cursos_importar_window.hide();
		},
		function(){}
	);
}

gestionar_cursos_exportar_curso_function = function(){
	subirDatosAjax(
		getAbsoluteUrl('gestion_cursos', 'exportar_curso'),
		[],
		function(){},
		function(){}
	);
}

gestionar_cursos_guardar_curso_function = function(){
	subir_datos(
		gestionar_curso_datos_curso_panel,
		getAbsoluteUrl('gestion_cursos', 'guardar_curso'),
		[],
		function(){gestionar_cursos_datastore.reload();},
		function(){}
	);
}

gestionar_cursos_actualizar_curso_function = function(){
	subir_datos(
		gestionar_curso_datos_curso_panel,
		getAbsoluteUrl('gestion_cursos', 'actualizar_curso'),
		{codigo_curso: codigo_curso},
		function(){gestionar_cursos_datastore.reload();},
		function(){}
	);
}

gestionar_cursos_habilitar_curso_function = function(){
	subirDatosAjax(
		getAbsoluteUrl('gestion_cursos', 'habilitar_curso'),
		{codigo_curso: codigo_curso},
		function(){gestionar_cursos_datastore.reload();},
		function(){}
	);
}

gestionar_cursos_desabilitar_curso_function = function(){
	subirDatosAjax(
		getAbsoluteUrl('gestion_cursos', 'desabilitar_curso'),
		{codigo_curso: codigo_curso},
		function(){gestionar_cursos_datastore.reload();},
		function(){}
	);
}
