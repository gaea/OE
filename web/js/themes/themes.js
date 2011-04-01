var gestionar_estudiantes_panel = new Ext.Panel({
	layout:'border',
	
	monitorResize: true,
	tbar:[
		{
			xtype:'buttongroup',
			title:"Apariencia",
			items:[
				{
					text:"access",
					iconAlign:'top',
					iconCls:'agregar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-access.css');
					}
				},
				{
					text:"black",
					iconAlign:'top',
					iconCls:'modificar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-black.css');
					}
				},
				{
					text:"blue",
					iconAlign:'top',
					iconCls:'habilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-blue.css');
					}
				},
				{
					text:"chocolate",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-chocolate.css');
					}
				},
				{
					text:"gray",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-gray.css');
					}
				},
				{
					text:"green",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-green.css');
					}
				},
				{
					text:"indigo",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-indigo.css');
					}
				},
				{
					text:"midnight",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-midnight.css');
					}
				},
				{
					text:"olive",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-olive.css');
					}
				},
				{
					text:"peppermint",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-peppermint.css');
					}
				},
				{
					text:"purple",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-purple.css');
					}
				},
				{
					text:"quizz",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-quizz.css');
					}
				},
				{
					text:"red",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-red.css');
					}
				},
				{
					text:"silverCherry",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-silverCherry.css');
					}
				},
				{
					text:"slate",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-slate.css');
					}
				},
				{
					text:"slickness",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-slickness.css');
					}
				},
				{
					text:"univalle",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-univalle.css');
					}
				},
				{
					text:"vista",
					iconAlign:'top',
					iconCls:'desabilitar_estudiante24',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-vista.css');
					}
				}
			]
		}
	],
	items:[
		{
			xtype:'panel',
			region:'center',
			html:'themes',
			height:window.innerHeight-112,
		}
	],
	renderTo:'div_form_themes'
});
