
var form_gestionar_profesores = new Ext.Panel({
	//region:'center',
	layout:'border',
	//layout:'column',
	/*layout:'hbox',
	layoutConfig : {
		flex: 1,
		align: 'stretch',
		pack: 'start'
	},*/
	//layout:'anchor',
	defaults: {
		collapsible: true,
		split: true,
		bodyStyle: 'padding:15px'
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
			xtype:'panel',
			title:'ppppp',
			region:'center'
			
		},
		{
			xtype:'panel',
			title:'bbbbbb',
			autoHeight: true,
			region:'west',
			html:'eeeee',
			anchor:'50%',
			//flex   : 1,
			//frame:true,
			split:true,
			collapsible:true,
			//columnWidth:0.5,
			margins: '5 0 0 0',
    cmargins: '5 5 0 0',
    width: 175,
    minSize: 100,
    maxSize: 250
		}
	],
	renderTo:'div_form_gestionar_profesores'
});
