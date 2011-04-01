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
//gestionar_cursos_datastore.load();

var gestionar_cursos_estudiantes_curso_datastore = new Ext.data.GroupingStore({
	proxy:new Ext.data.HttpProxy({
		url:getAbsoluteUrl('gestion_cursos', 'consultar_estudiantes_cursos'),
		method:'POST',
		limit:20,
		start:0
	}),
	baseParams:{}, 
	reader:new Ext.data.JsonReader({
		root:'results',
		totalProperty:'total'
		},[
			{name:'pro_codigo'},
			{name:'pro_nombres'},
			{name:'pro_apellidos'}
		]),
	sortInfo:{field: 'pro_codigo', direction: "ASC"}
});
//gestionar_cursos_datastore.load();

var gestionar_curso_estudiantes_curso_gridpanel = new Ext.grid.GridPanel({
	id:'gestionar_curso_estudiantes_curso_gridpanel',
	title:'Estudiantes del Curso',
	columnLines:true,
	height:450,
	autoWidth:true,
	region:'center',
	collapseMode:'mini',
	stripeRows:true,
	monitorResize:true,
	frame:true,
	ds:gestionar_cursos_estudiantes_curso_datastore,
	cm:new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true, align:'center'},
		columns:[
			{header: "<b>C&oacute;digo</b>", width: 60, dataIndex: 'pro_codigo'},
			{header: "<b>Nombres</b>", width: 150, dataIndex: 'pro_nombres'},
			{header: "<b>Apellidos</b>", width: 150, dataIndex: 'pro_apellidos'}
		]
	}),
	sm:new Ext.grid.RowSelectionModel({
		singleSelect:true,
		listeners:{
			rowselect: function(sm, row, rec) {

			}
		}
	}),
	autoExpandMin:200,
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
		emptyMsg:"No hay estudiantes en el curso"
	}),
	view: new Ext.grid.GroupingView()
});

var gestionar_cursos_estudiantes_datastore = new Ext.data.GroupingStore({
	proxy:new Ext.data.HttpProxy({
		url:getAbsoluteUrl('gestion_cursos', 'consultar_estudiantes'),
		method:'POST',
		limit:20,
		start:0
	}),
	baseParams:{}, 
	reader:new Ext.data.JsonReader({
		root:'results',
		totalProperty:'total'
		},[
			{name:'pro_codigo'},
			{name:'pro_nombres'},
			{name:'pro_apellidos'}
		]),
	sortInfo:{field: 'pro_codigo', direction: "ASC"}
});
//gestionar_cursos_estudiantes_datastore.load();

var gestionar_curso_estudiantes_gridpanel = new Ext.grid.GridPanel({
	id:'gestionar_curso_estudiantes_gridpanel',
	title:'Todos los estudiantes',
	columnLines:true,
	height:450,
	autoWidth:true,
	region:'center',
	collapseMode:'mini',
	stripeRows:true,
	monitorResize:true,
	frame:true,
	ds:gestionar_cursos_estudiantes_datastore,
	cm:new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true, align:'center'},
		columns:[
			{header: "<b>C&oacute;digo</b>", width: 60, dataIndex: 'pro_codigo'},
			{header: "<b>Nombres</b>", width: 150, dataIndex: 'pro_nombres'},
			{header: "<b>Apellidos</b>", width: 150, dataIndex: 'pro_apellidos'}
		]
	}),
	sm:new Ext.grid.RowSelectionModel({
		singleSelect:true,
		listeners:{
			rowselect: function(sm, row, rec) {

			}
		}
	}),
	autoExpandMin:200,
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
		emptyMsg:"No hay estudiantes"
	}),
	view: new Ext.grid.GroupingView()
});

var gestionar_curso_datos_curso_panel = new Ext.FormPanel({
	width:800,
	frame:true,
	layout:'column',
	items:[
		{
			xtype:'panel',
			layout:'form',
			columnWidth:1,
			bodyStyle:'padding: 10px',
			labelWidth:120,
			defaults:{xtype:'textfield'},
			items:[
				{
					fieldLabel:'C&oacute;digo',
					readOnly:true,
					name:'cur_codigo',
					maskRe:/([a-zA-Z0-9\s]+)$/
				},
				{
					fieldLabel:'Nombre',
					width:300,
					allowBlank:false,
					name:'cur_nombre',
					maskRe:/([a-zA-Z0-9\s]+)$/
				},
				{
					xtype: 'compositefield',
					fieldLabel:'Profesor',
					//anchor:'100%',
					//defaults: { flex: 1 },
					items:[
						{
							xtype:'textfield',
							width:300,
							readOnly:true,
							id:'id_gestionar_curso_nombre_profesor_textfield',
							name:'cur_nombre_profesor'
						},
						{
							xtype:'button',
							width:100,
							text:'seleccionar profesor',
							handler:function(){
								gestionar_curso_seleccionar_profesor_window.show();
							}
						}
					]
					
				},
				{
					xtype:'textfield',
					fieldLabel:'Codigo del profesor',
					width:300,
					readOnly:true,
					id:'id_gestionar_curso_codigo_profesor_textfield',
					name:'cur_codigo_profesor'
				},
				{
					fieldLabel:'Fecha de creaci&oacute;n',
					name:'cur_fecha_creacion',
					readOnly:true,
				}
			]
		},
		{
			xtype:'panel',
			columnWidth:1,
			layout:'column',
			items:[
				{
					xtype:'panel',
					columnWidth:0.5,
					items:[gestionar_curso_estudiantes_curso_gridpanel]
				},
				{
					xtype:'panel',
					columnWidth:0.5,
					items:[gestionar_curso_estudiantes_gridpanel]
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

var gestionar_cursos_seleccionar_profesor_datastore = new Ext.data.GroupingStore({
	proxy:new Ext.data.HttpProxy({
		url:getAbsoluteUrl('gestion_cursos', 'consultar_profesores'),
		method:'POST',
		limit:20,
		start:0
	}),
	baseParams:{}, 
	reader:new Ext.data.JsonReader({
		root:'results',
		totalProperty:'total'
		},[
			{name:'pro_codigo'},
			{name:'pro_nombres'},
			{name:'pro_apellidos'},
			{name:'pro_identificacion'}
		]),
	sortInfo:{field: 'pro_codigo', direction: "ASC"}
});
gestionar_cursos_seleccionar_profesor_datastore.load();

var gestionar_curso_seleccionar_profesor_gridpanel = new Ext.grid.GridPanel({
	id:'gestionar_curso_seleccionar_profesor_gridpanel',
	columnLines:true,
	width:650,
	//autoWidth:true,
	height:400,
	region:'center',
	collapseMode:'mini',
	stripeRows:true,
	monitorResize:true,
	frame:true,
	ds:gestionar_cursos_seleccionar_profesor_datastore,
	cm:new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true, align:'center'},
		columns:[
			{header: "<b>Codigo</b>", width: 100, dataIndex: 'pro_codigo'},
			{header: "<b>Nombres</b>", width: 200, dataIndex: 'pro_nombres'},
			{header: "<b>Apellidos</b>", width: 200, dataIndex: 'pro_apellidos'},
			{header: "<b>Identificaci&oacute;n</b>", width: 200, dataIndex: 'pro_identificacion'}
		]
	}),
	sm:new Ext.grid.RowSelectionModel({
		singleSelect:true,
		listeners:{
			rowselect: function(sm, row, rec) {
				Ext.getCmp('id_gestionar_curso_nombre_profesor_textfield').setValue(rec.get('pro_nombres')+' '+rec.get('pro_apellidos'));
				Ext.getCmp('id_gestionar_curso_codigo_profesor_textfield').setValue(rec.get('pro_codigo'));
				///alert('select');
			}
		}
	}),
	autoExpandMin:200,
	//autoHeight:true,
	listeners:{
		viewready:function(g) {
			g.getSelectionModel().selectRow(0);
		}
	},
	tbar: [
		{
			xtype:'label',
			text:'Filtro:'
		},
		{
			xtype:'textfield',
			id:'id_gestionar_curso_seleccionar_profesor_textfield'
		},
		{
			xtype:'button',
			text:'buscar',
			handler:function(){
				
			}
		}
	],
	bbar:new Ext.PagingToolbar({
		pageSize:10,
		store:gestionar_cursos_seleccionar_profesor_datastore,
		displayInfo:true,
		displayMsg:'cursos {0} - {1} de {2}',
		emptyMsg:"No hay profesores"
	}),
	view: new Ext.grid.GroupingView()
});

var gestionar_curso_seleccionar_profesor_window = new Ext.Window({
	title:'Seleccionar profesor',
	modal:true,
	closeAction:'hide',
	forceLayout:true,
	items:[gestionar_curso_seleccionar_profesor_gridpanel]
});
gestionar_curso_seleccionar_profesor_window.show();
gestionar_curso_seleccionar_profesor_window.hide();


/////***************************//////////////////////

var gestionar_cursos_window = new Ext.Window({
	title:'Datos del curso',
	modal:true,
	closeAction:'hide',
	forceLayout:true,
	items:[gestionar_curso_datos_curso_panel]
});
gestionar_cursos_window.show();
gestionar_cursos_window.hide();

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
		{header: "<b>C&oacute;digo</b>", width: 100, dataIndex: 'cur_codigo'},
		{id: 'col_pro_nombres', header: "<b>Nombre</b>", width: 200, dataIndex: 'cur_nombre'},
		{header: "<b>Profesor</b>", width: 300, dataIndex: 'cur_nombre_profesor'},
		{header: "<b>C&oacute;digo Profesor</b>", width: 150, dataIndex: 'cur_codigo_profesor'},
		{header: "<b>Fecha creaci&oacute;n</b>", width: 150, dataIndex: 'cur_fecha_crecion'},
		{header: "<b>Habilitado</b>", width: 85, dataIndex: 'cur_habilitado', renderer:si_no}
	]
});

var codigo_curso = '';

var gestionar_cursos_gridpanel = new Ext.grid.GridPanel({
	id:'gestionar_cursos_gridpanel',
	title:'Lista de cursos',
	columnLines:true,
	//width:800,
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
				
				codigo_curso = rec.get('cur_codigo');
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
						gestionar_cursos_window.show();
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
