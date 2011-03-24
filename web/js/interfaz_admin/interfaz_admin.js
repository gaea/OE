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
						autoLoad:{url: getAbsoluteUrl('gestion_profesores', 'index'), scripts: true, scope: this}
					},
					{
						title: 'Gestionar Estudiantes',
						tabTip: 'Gestionar Estudiantes',
						autoScroll: true,
						autoLoad: {url: getAbsoluteUrl('gestion_estudiantes', 'index'), scripts: true, scope: this}
					},
					{
						title: 'Gestionar Cursos',
						tabTip: 'Gestionar Cursos',
						autoScroll: true,
						autoLoad: {url: getAbsoluteUrl('gestion_cursos', 'index'), scripts: true, scope: this}
					},
					{
						title:'Gestionar Plugins',
						tabTip:'Gestionar Plugins',
						autoScroll:true,
						autoLoad:{url: getAbsoluteUrl('gestion_plugins', 'index'), scripts: true, scope: this}
					},
					{
						xtype:'panel',
						tabTip:'Temas',
						title:'Temas',
						autoScroll:true,
						height:600,
						autoLoad:{url: '../extjs/ex/themes/index.php', scripts: true}
						//html: '<iframe style="overflow:auto;width:100%;height:100%;" frameborder="0"  src="../extjs/ex/themes/index.html"></iframe>'
					},
					{
						xtype:'panel',
						tabTip:'Maestras',
						title:'Maestras',
						autoScroll:true,
						html: '<iframe style="overflow:auto;width:100%;height:100%;" frameborder="0"  src="' + urlPrefix + 'maestra_identificacion' + '"></iframe>'
					},
					{
						xtype:'panel',
						tabTip:'Ayuda',
						title:'Ayuda'
					},
				],
				listeners :{
					bodyresize:function(p,w,h){
						if(Ext.getCmp('gestionar_profesores_panel') != null){
							Ext.getCmp('gestionar_profesores_panel').setSize (w,h);
						}
					}
				}
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
