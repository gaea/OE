alto_border_center=screen.height-50;

var viewport = new Ext.Viewport({
        layout:'border',
        items:[
            {
				xtype:'panel',
                region:'north',
                html:'OE Administracion',
                bodyStyle : 'padding: 5px',
                margins:'5 5 5 5',
                frame:true,
                border:false,
                height:32
            },
            {
				xtype:'tabpanel',
                id:'administracion-tabs',
                margins:'0 5 0 5',
                activeTab:0,
                region:'center',
				//layout:'fit',
                resizeTabs:true,
                tabWidth:150,
				listeners:{
					beforeRender:function(){
						
					}
				},
                items: [
                    {
						title:'Gestionar Profesores',
						tabTip:'Gestionar Profesores',
						layout:'fit',
						autoScroll:true,
						autoLoad:{url: 'gestion_profesores/index', scripts: true, scope: this}
					},
					{
						title: 'Gestionar Estudiantes',
						tabTip: 'Gestionar Estudiantes',
						autoScroll: true,
						autoLoad: {url: 'gestion_estudiantes/index', scripts: true, scope: this}
					},
					{
						title:'Gestionar Plugins',
						tabTip:'Gestionar Plugins',
						autoScroll:true,
						autoLoad:{url: 'gestion_plugins/index', scripts: true, scope: this}
					},
					{
						xtype:'panel',
						tabTip:'Temas',
						title:'Temas'
					},
					{
						xtype:'panel',
						tabTip:'Ayuda',
						title:'Ayuda'
					},
				]
			},
			{
				xtype:'panel',
                region:'south',
                html:'Powered by gaea',
                bodyStyle : 'padding: 5px;',
                margins:'5 5 5 5',
                frame:true,
                border:false,
                height:32
            },
		]
});
