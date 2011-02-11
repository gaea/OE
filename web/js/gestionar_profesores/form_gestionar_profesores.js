
var form_gestionar_profesores = new Ext.Panel({
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
				},
				{
					text:'Eliminar',
					iconAlign:'top',
					with:100,
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
					with:100,
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
					with:100,
				}
			]
		}
	],
	items:[
		
	],
	renderTo:'div_form_gestionar_profesores'
});
