
//funciones genericas
//funciones de manejo de cookies*/	
	function guardarGalleta(cookieNombre,cookieValor) {
		var today = new Date();
		var expire = new Date();
		expire.setTime(today.getTime() + 3600000*24*30*12);
		document.cookie = cookieNombre+"="+escape(cookieValor)+ ";expires="+expire.toGMTString(); 
	}
			
	function leerGalleta(cookieNombre){
		if (document.cookie.length>0)
		{
			c_start=document.cookie.indexOf(cookieNombre + "=");
			if (c_start!=-1)
			{ 
				c_start=c_start + cookieNombre.length+1; 
				c_end=document.cookie.indexOf(";",c_start);
				
				if (c_end==-1)
				{
				c_end=document.cookie.length;
				}
				return unescape(document.cookie.substring(c_start,c_end));
			}
		}
	}
//end funciones de cokkies


	var usu_login=new Ext.form.TextField({
		name:'usu_login',
		fieldLabel:'Login',
		allowBlank:false,
		tooltip: {text:'Digite su login de usuario: ejemplo gustavoea', title:'Login', autoHide:true},
		value:leerGalleta('usuario_acceso')
	});
	
	var usu_password=new Ext.form.TextField({
		name:'usu_password',
		fieldLabel:'Password', 
		inputType:'password',
		allowBlank:false,
		tooltip: {text:'Digite su clave de acceso: ejemplo ****', title:'Password', autoHide:true}//,
		//value:leerGalleta('password_acceso')
	});
	
	var usu_recordarme=new Ext.form.Checkbox({
		xtype:'checkbox',
		name:'usu_recordarme',
		fieldLabel:'Recordarme',
		handler:function(){
			if(usu_recordarme.isDirty() && usu_login.getValue()!="" && usu_password.getValue()!="")
			{		
				guardarGalleta('usuario_acceso',usu_login.getValue());
			//	guardarGalleta('password_acceso',usu_password.getValue()); por seguridad no se hace
			}
		}
	});
	
	var form_autenticacion_profesor=new Ext.FormPanel({
		layout:'form',
		frame:true,
		title:'Iniciar sesi&oacute;n',
		monitorValid:true,
		stateful:true,
		labelWidth:80,
		width:320,
		bodyStyle:'padding:15px',
		defaults:{xtype: 'textfield',width:160,allowBlank:false},
		items:[
			usu_login,
			usu_password,
			usu_recordarme  
		],
		buttons:[
			{text:'registrarse', handler:registrarse},
			{text:'Acceder', formBind: true, handler:autenticar}
		],
		renderTo:'div_login'
	});

	//funciones
	function registrarse()
	{
	}
		
	function autenticar()
	{
		//realizamos las validaciones de cantidad de caracteres y formato de campos
	
		form_autenticacion_profesor.getForm().submit({
			method:'POST',
			timeout:60000,
			url:getAbsoluteUrl('login_profesor', 'autenticar'),
			params:{},
			waitTitle:'Autenticando',
			waitMsg:'Enviando datos...',
			success:function(response, action){
				var obj = Ext.util.JSON.decode(action.response.responseText);
			
				if (obj.success==true)
				{
					if(obj.mensaje=='profesor')
					{ window.location = getAbsoluteUrl('interfaz_profesor','index');}
					else{
						mostrar_mensaje_rapido('Error',obj.mensaje);
					}
				}
				if (obj.errors==false)
				{
					mostrar_mensaje_rapido('Error',obj.errors.reason);
				}
			},
			failure: function(form, action, response){
				mostrar_mensaje_rapido('Error','No se puede conectar con la base de datos intente mas tarde');
			}
		});
	}
