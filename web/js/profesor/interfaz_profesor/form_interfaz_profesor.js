
var viewport = new Ext.Viewport({
        layout:'border',
        items:[
            {
				xtype:'panel',
                region:'north',
                html:'OE Profesor',
                bodyStyle : 'padding: 5px',
                margins:'5 5 5 5',
                frame:true,
                border:false,
                height:32
            },
            {
			xtype:'panel',
			region:'center',
			margins:'0 5 0 5',	
            items:[{
				xtype:'tabpanel',
                id:'profesor-tabs',
                activeTab:0,
                region:'center',
                resizeTabs:true,
                tabWidth:100,
				listeners:{
					beforeRender:function(){
						
					}
				},
                items:[
                    {
						title:'Evaluaciones',
						tabTip:'Evaluaciones',
						//layout:'fit',
						//autoScroll:true,
						tbar:[
							{
								xtype:'buttongroup',
								title:"Evaluaciones",
								items:[
									{
										text:"Mis Evaluaciones",
										iconAlign:'top',
										iconCls:'agregar_estudiante24',
										scale:'medium',
										handler:function(){
											Ext.getCmp('formpanel_evaluacion').hide();
											Ext.getCmp('formpanel_evaluacion_gridpanel').show();
										}
									},
									{
										text:"Agregar",
										iconAlign:'top',
										iconCls:'agregar_estudiante24',
										scale:'medium',
										handler:function(){
											Ext.getCmp('formpanel_evaluacion_gridpanel').hide();
											Ext.getCmp('formpanel_evaluacion').show();
										}
									},
									{
										text:"Modificar",
										iconAlign:'top',
										iconCls:'agregar_estudiante24',
										scale:'medium',
										handler:function(){
											Ext.getCmp('formpanel_evaluacion_gridpanel').hide();
											Ext.getCmp('formpanel_evaluacion').show();
										}
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
										scale: 'medium',
										handler:function(){ 
										}
									},
									{
										text:"Exportar",
										iconAlign:'top',
										iconCls:'exportar24',
										scale: 'medium',
										handler:function(){ 
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
										scale: 'medium'
									}
								]
							}
						]
					},
					{
						title: 'Preguntas',
						tabTip: 'Preguntas',
						autoScroll: true,
						//autoLoad: {url: getAbsoluteUrl('gestion_estudiantes', 'index'), scripts: true, scope: this}
					},
					{
						title: 'Programaci&oacute;n',
						tabTip: 'Programaci&oacute;n',
						autoScroll: true,
						//autoLoad: {url: getAbsoluteUrl('gestion_estudiantes', 'index'), scripts: true, scope: this}
					},
					{
						title:'Multimedia',
						tabTip:'Multimedia',
						autoScroll:true,
						//autoLoad:{url: getAbsoluteUrl('gestion_plugins', 'index'), scripts: true, scope: this}
					},
					{
						tabTip:'Cursos',
						title:'Cursos',
						autoScroll:true,
						height:600,
						//autoLoad:{url: '../extjs/ex/themes/index.php', scripts: true}
						//html: '<iframe style="overflow:auto;width:100%;height:100%;" frameborder="0"  src="../extjs/ex/themes/index.html"></iframe>'
					},
					{
						tabTip:'Apariencia',
						title:'Apariencia',
						autoScroll:true,
						//html: '<iframe style="overflow:auto;width:100%;height:100%;" frameborder="0"  src="' + urlPrefix + 'maestra_identificacion' + '"></iframe>'
					},
					{
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
				title:'Area de Trabajo',
				height:550,
				//html:'hola'
				layout:'border',
				items:[
					{
						xtype:'panel',
						region:'center',
						items:[
							formpanel_evaluacion,
							formpanel_evaluacion_gridpanel
						]
					},
					{
						xtype:'panel',
						region:'east',
						width:300,
						layout:'accordion',
						items:[
							{
								xtype:'panel',
								html:'panel1'
							},
							{
								xtype:'panel',
								html:'panel2'
							},
							{
								xtype:'panel',
								html:'panel3'
							}
						]
					}
				]
			}]
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
            }
		]
});
