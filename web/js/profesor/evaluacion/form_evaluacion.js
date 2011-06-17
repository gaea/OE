/*

Campos de la DB

eva_codigo
eva_codigo_profesor lo saca de la seccion
eva_codigo_tema_materia
eva_nombre
eva_hora_inicio
eva_hora_fin
eva_numero_personas_grupo
eva_publico //b
eva_fecha 

eva_numero_intentos
eva_mostrar_solucion
eva_barajar_preguntas
*/

var formpanel_evaluacion_datastore = new Ext.data.GroupingStore({
	proxy:new Ext.data.HttpProxy({
		url:get_absolute_url('evaluacion', 'consultar_evaluacion'),
		method:'POST',
		limit:20,
		start:0
	}),
	baseParams:{}, 
	reader:new Ext.data.JsonReader({
		root:'results',
		totalProperty:'total'
		},[
			{name:'eva_codigo'},
			{name:'eva_codigo_profesor'},
			{name:'pro_nombre'},
			{name:'eva_codigo_tema_materia'},
			{name:'eva_nombre'},
			{name:'eva_hora_inicio'},
			{name:'eva_hora_fin'},
			{name:'eva_numero_personas_grupo'},
			{name:'eva_publico'},
			{name:'eva_fecha'},
			{name:'eva_numero_intentos'},
			{name:'eva_mostrar_solucion'},
			{name:'eva_barajar_preguntas'}
		]),
	sortInfo:{field: 'eva_codigo', direction: "ASC"}
});
formpanel_evaluacion_datastore.load({params:{limit:20, start:0}});

var formpanel_evaluacion_seleccionar_tema_datastore = new Ext.data.GroupingStore({
	proxy:new Ext.data.HttpProxy({
		url:get_absolute_url('evaluacion', 'consultar_tema_materia'),
		method:'POST',
		limit:20,
		start:0
	}),
	baseParams:{}, 
	reader:new Ext.data.JsonReader({
		root:'results',
		totalProperty:'total'
		},[
			{name:'tom_codigo'},
			{name:'tom_nombre'}
		]),
	sortInfo:{field: 'tom_nombre', direction: "ASC"}
});
formpanel_evaluacion_seleccionar_tema_datastore.load();

var formpanel_evaluacion_seleccionar_tema_gridpanel = new Ext.grid.GridPanel({
	columnLines:true,
	id:'formpanel_evaluacion_seleccionar_tema_gridpanel',
	width:650,
	height:400,
	region:'center',
	collapseMode:'mini',
	stripeRows:true,
	monitorResize:true,
	frame:true,
	ds:formpanel_evaluacion_seleccionar_tema_datastore,
	cm:new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true, align:'center'},
		columns:[
			{header: "<b>C&oacute;digo</b>", width: 100, dataIndex: 'tom_codigo'},
			{header: "<b>Nombre</b>", width: 200, dataIndex: 'tom_nombre'},
		]
	}),
	sm:new Ext.grid.RowSelectionModel({
		singleSelect:true,
		listeners:{
			rowselect: function(sm, row, rec) {
				Ext.getCmp('formpanel_evaluacion_tom_nombre_textfield').setValue(rec.get('tom_nombre'));
				Ext.getCmp('formpanel_evaluacion_tom_codigo_textfield').setValue(rec.get('tom_codigo'));
			}
		}
	}),
	autoExpandMin:200,
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
			id:'formpanel_evaluacion_seleccionar_tema_textfield'
		},
		{
			xtype:'button',
			text:'buscar',
			handler:function(){
				formpanel_evaluacion_seleccionar_tema_datastore.load({
					params: {busqueda:Ext.getCmp('formpanel_evaluacion_seleccionar_tema_textfield').getValue(), campo_busqueda:'todos', start: 0, limit: 20}
				});
			}
		}
	],
	bbar:new Ext.PagingToolbar({
		pageSize:20,
		store:formpanel_evaluacion_seleccionar_tema_datastore,
		displayInfo:true,
		displayMsg:'Temas {0} - {1} de {2}',
		emptyMsg:"No hay temas"
	}),
	view: new Ext.grid.GroupingView()
});

var formpanel_evaluacion_gridpanel = new Ext.grid.GridPanel({
	columnLines:true,
	id:'formpanel_evaluacion_gridpanel',
	autoWidth:true,
	height:500,
	region:'center',
	collapseMode:'mini',
	stripeRows:true,
	monitorResize:true,
	frame:true,
	ds:formpanel_evaluacion_datastore,
	cm:new Ext.grid.ColumnModel({
		defaults:{sortable: true, locked: false, resizable: true, align:'center'},
		columns:[
			{header:"<b>C&oacute;digo</b>", width:100, dataIndex:'eva_codigo'},
			{header:"<b>Nombre</b>", width:200, dataIndex:'eva_nombre'},
			{header:"<b>Fecha</b>", width:200, dataIndex:'eva_fecha'},
			{header:"<b>Hora de Inicio</b>", width:200, dataIndex:'eva_hora_inicio'},
			{header:"<b>Hora de Fin</b>", width:200, dataIndex:'eva_hora_fin'}
		]
	}),
	sm:new Ext.grid.RowSelectionModel({
		singleSelect:true,
		listeners:{
			rowselect: function(sm, row, rec) {
				formpanel_evaluacion.getForm().loadRecord(rec);
			}
		}
	}),
	autoExpandMin:200,
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
			id:'formpanel_evaluacion_textfield'
		},
		{
			xtype:'button',
			text:'buscar',
			handler:function(){
				/*formpanel_evaluacion_seleccionar_tema_datastore.load({
					params: {busqueda:Ext.getCmp('formpanel_evaluacion_seleccionar_tema_textfield').getValue(), campo_busqueda:'todos', start: 0, limit: 20}
				});*/
			}
		}
	],
	bbar:new Ext.PagingToolbar({
		pageSize:20,
		store:formpanel_evaluacion_datastore,
		displayInfo:true,
		displayMsg:'Temas {0} - {1} de {2}',
		emptyMsg:"No hay evaluaciones"
	}),
	view: new Ext.grid.GroupingView()
});

var formpanel_evaluacion_seleccionar_tema_window = new Ext.Window({
	title:'Seleccionar tema o materia',
	modal:true,
	closeAction:'hide',
	forceLayout:true,
	items:[formpanel_evaluacion_seleccionar_tema_gridpanel]
});
formpanel_evaluacion_seleccionar_tema_window.show();
formpanel_evaluacion_seleccionar_tema_window.hide();


/*el form de evaluacion*/
var formpanel_evaluacion = new Ext.FormPanel({
	title:'Nueva evaluaci&oacute;n',
	id:'formpanel_evaluacion',
	bodyStyle:'padding: 10px',
	labelWidth:150,
	hidden:true,
	defaults:{xtype:'textfield',anchor:'100%'},
	items:[
		{
			fieldLabel:'Profesor Codigo',
			name:'eva_codigo_profesor',
			value:'sacado de session'
		},
		{
			xtype: 'compositefield',
			fieldLabel:'Tema',
			items:[
				{
					xtype:'textfield',
					width:100,
					readOnly:true,
					id:'formpanel_evaluacion_tom_codigo_textfield',
					name:'eva_codigo_tema_materia'
				},{
					xtype:'textfield',
					width:300,
					readOnly:true,
					id:'formpanel_evaluacion_tom_nombre_textfield',
					name:'eva_nombre_tema_materia'
				},{
					xtype:'button',
					width:100,
					text:'Seleccionar tema',
					handler:function(){
						formpanel_evaluacion_seleccionar_tema_window.show();
					}
				}
			]
		},
		{
			fieldLabel: 'Nombre',
			name: 'eva_nombre',
			maskRe: /([a-zA-Z0-9\s]+)$/,
			allowBlank:false
		},
		{
			xtype: 'timefield',
			fieldLabel: 'Hora inicio',
			name: 'eva_hora_inicio',
            minValue: '5:00',
            maxValue: '18:00',
            allowBlank:false
		},
		{
			xtype: 'timefield',
			fieldLabel: 'Hora fin',
			name: 'eva_hora_fin',
            minValue: '5:00',
            maxValue: '18:00',
            allowBlank:false
		},
		{
			xtype: 'numberfield',
			fieldLabel: 'Numero personas grupo',
			name: 'eva_numero_personas_grupo',
            allowNegative: false,
            allowBlank:false,
            default:1 //cantidad de personas que conforman el grupo que hace la evaluacion, ejemplo grupos de 3 personas
		},
		{
			xtype:'checkbox',
			fieldLabel:'Publico ?',
			name:'eva_publico',
			inputValue:'true'
		},
		{
			xtype: 'datefield',
			fieldLabel   : 'Fecha',
			name: 'eva_fecha',
			allowBlank:false
		},
		{
			xtype: 'numberfield',
			fieldLabel: 'Numero de intentos',
			name: 'eva_numero_intentos',
            allowNegative: false,
            allowBlank:false
		},
		{
			xtype:'checkbox',
			fieldLabel:'Mostrar soluciones',
			name:'eva_mostrar_solucion',
			inputValue:'true',
			allowBlank:false
		},
		{
			xtype:'checkbox',
			fieldLabel:'Barajar preguntas',
			name:'eva_barajar_preguntas',
			inputValue:'true',
			allowBlank:false
		}
	],
	buttons:[
		{text:'Guardar',handler:function(){
				
				subir_datos(formpanel_evaluacion,
					getAbsoluteUrl('evaluacion','guardar_evaluacion'), 
					{}, 
					function(){}, 
					function(){}
				);

		}},
		{text:'Cancelar'}
	]
	//,renderTo:'div_login'
});


