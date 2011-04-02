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
					iconCls:'access',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-access.css');
					}
				},
				{
					text:"black",
					iconAlign:'top',
					iconCls:'black',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-black.css');
					}
				},
				{
					text:"blue",
					iconAlign:'top',
					iconCls:'blue',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-blue.css');
					}
				},
				{
					text:"chocolate",
					iconAlign:'top',
					iconCls:'chocolate',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-chocolate.css');
					}
				},
				{
					text:"gray",
					iconAlign:'top',
					iconCls:'gray',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-gray.css');
					}
				},
				{
					text:"green",
					iconAlign:'top',
					iconCls:'green',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-green.css');
					}
				},
				{
					text:"indigo",
					iconAlign:'top',
					iconCls:'indigo',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-indigo.css');
					}
				},
				{
					text:"midnight",
					iconAlign:'top',
					iconCls:'midnight',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-midnight.css');
					}
				},
				{
					text:"olive",
					iconAlign:'top',
					iconCls:'olive',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-olive.css');
					}
				},
				{
					text:"peppermint",
					iconAlign:'top',
					iconCls:'peppermint',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-peppermint.css');
					}
				},
				{
					text:"purple",
					iconAlign:'top',
					iconCls:'purple',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-purple.css');
					}
				},
				{
					text:"quizz",
					iconAlign:'top',
					iconCls:'quizz',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-quizz.css');
					}
				},
				{
					text:"red",
					iconAlign:'top',
					iconCls:'red',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-red.css');
					}
				},
				{
					text:"silverCherry",
					iconAlign:'top',
					iconCls:'silvercherry',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-silverCherry.css');
					}
				},
				{
					text:"slate",
					iconAlign:'top',
					iconCls:'slate',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-slate.css');
					}
				},
				{
					text:"slickness",
					iconAlign:'top',
					iconCls:'slickness',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-slickness.css');
					}
				},
				{
					text:"univalle",
					iconAlign:'top',
					iconCls:'univalle',
					scale:'medium',
					handler:function(){
						Ext.util.CSS.swapStyleSheet('theme', '../extjs/resources/css/xtheme-univalle.css');
					}
				},
				{
					text:"vista",
					iconAlign:'top',
					iconCls:'vista',
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
